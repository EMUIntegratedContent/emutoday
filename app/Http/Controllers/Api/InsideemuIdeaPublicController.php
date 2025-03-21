<?php

namespace Emutoday\Http\Controllers\Api;

use Emutoday\Http\Resources\InsideemuIdeaPublicResource;
use Emutoday\Http\Resources\InsideemuIdeaResource;
use Emutoday\InsideemuIdea;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Emutoday\Rules\MaxWords;
use Emutoday\Services\InsideemuService;

class InsideemuIdeaPublicController extends ApiController{
	protected $idea;

	protected $draftValidationRules;
	protected $validationRules;
	function __construct(InsideemuIdea $idea){
		$this->idea = $idea;
		$this->validationRules = [
			'title' => 'required|max:255',
			'content' => ['required', new MaxWords(500)],
			'contributor_netid' => 'required',
			'contributor_first' => 'required',
			'contributor_last' => 'required',
			'other_source' => 'required_if:use_other_source,1'
		];
		$this->draftValidationRules = [
			'title' => 'required|max:255',
			'content' => new MaxWords(500),
			'contributor_netid' => 'required',
			'contributor_first' => 'required',
			'contributor_last' => 'required',
		];
	}

	/**
	 * Get the ideas for a specific netid.
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(Request $request){
		$netid = $request->get('netid');
		if(!$netid){
			return response()->json(['error' => 'Netid is required.'], 400);
		}

		$ideas = $this->idea->where('contributor_netid', $netid)->orderBy('created_at', 'desc')->get();

		return response()->json(InsideemuIdeaPublicResource::collection($ideas));
	}

	/**
	 * Display the specified resource.
	 */
	public function show($ideaId){
		$idea = $this->idea->with('images')->findOrFail($ideaId);
		return response()->json(InsideemuIdeaResource::make($idea));
	}

	/**
	 * Get the specified post
	 */
	public function edit(InsideemuIdea $idea){

	}

	/**
	 * Store a new idea
	 */
	public function store(Request $request, InsideemuService $insideemuService){
		$idea = json_decode($request->get('idea'), true);
		$saveType = $request->get('saveType');
		if (!$idea || !$saveType) {
			return response()->json(['error' => 'Invalid parameters.'], 400);
		}

		$ideaId = isset($idea['ideaId']) ?: null;
		if($ideaId){
			$idea = $this->idea->findOrFail($ideaId);
			if($idea) {
				return response()->json(['error' => 'Idea already exists.'], 400);
			}
		}

		$data = [
			'title' => $idea['title'],
			'teaser' => $idea['teaser'],
			'content' => $idea['content'],
			'contributor_netid' => $idea['contributor_netid'],
			'contributor_first' => $idea['contributor_first'],
			'contributor_last' => $idea['contributor_last'],
			'use_other_source' => $idea['use_other_source'],
			'other_source' => $idea['other_source']
		];

		if($saveType == 'draft'){
			$validator = Validator::make($data, $this->draftValidationRules);
		} else {
			$validator = Validator::make($data, $this->validationRules);
		}

		if($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 422);
		}

		$newIdea = new InsideemuIdea();
		$newIdea->fill($data);
		if($saveType == 'draft') {
			$newIdea->submitted_at = null;
		} else {
			$newIdea->submitted_at = now();
		}
		$newIdea->save();

		$insideemuService->handleIdeaImages($newIdea, $idea);

		return response()->json(InsideemuIdeaResource::make($newIdea));
	}

	/**
	 * Update the specified idea
	 * @param Request $request
	 * @param int $ideaId
	 * @param InsideemuService $insideemuService
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, int $ideaId, InsideemuService $insideemuService) {
		$ideaArr = json_decode($request->get('idea'), true);
		$saveType = $request->get('saveType');
		if (!$ideaArr || !$saveType) {
			return response()->json(['error' => $request->all()], 400);
		}

		$idea = $this->idea->findOrFail($ideaId);
		if(!$idea){
			return response()->json(['error' => 'Idea not found.'], 404);
		}

		$data = [
			'title' => $ideaArr['title'],
			'teaser' => $ideaArr['teaser'],
			'content' => $ideaArr['content'],
			'contributor_netid' => $idea->contributor_netid, // use existing netid
			'contributor_first' => $ideaArr['contributor_first'],
			'contributor_last' => $ideaArr['contributor_last'],
			'use_other_source' => $ideaArr['use_other_source'],
			'other_source' => $ideaArr['other_source']
		];

		if($saveType == 'draft'){
			$validator = Validator::make($data, $this->draftValidationRules);
		} else {
			$validator = Validator::make($data, $this->validationRules);
		}

		if($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 422);
		}

		$idea->fill($data);
		if($saveType == 'draft') {
			$idea->submitted_at = null;
		} else {
			$idea->submitted_at = now();
		}
		$idea->save();

		$insideemuService->handleIdeaImages($idea, $ideaArr);

		$idea = $this->idea->findOrFail($ideaId); // get the entire updated idea
		return response()->json(InsideemuIdeaResource::make($idea));
	}

	/**
	 * Delete a post.
	 * @param int $id
	 * @return array
	 */
	public function destroy($id){
//    $email = $this->email->findOrFail($id);
//    $email->delete();
//    return $this->setStatusCode(200)->respond('Email successfully deleted!');
	}
}
