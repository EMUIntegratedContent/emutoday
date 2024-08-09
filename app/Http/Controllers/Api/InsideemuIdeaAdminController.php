<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\Http\Resources\InsideemuIdeaResource;
use Emutoday\InsideemuIdea;
use Emutoday\Services\InsideemuService;
use Illuminate\Http\Request;
use Emutoday\InsideemuPost;
use Illuminate\Support\Facades\Validator;

class InsideemuIdeaAdminController extends ApiController{
	protected $idea;

	function __construct(InsideemuIdea $idea){
		$this->idea = $idea;
	}

	/**
	 * Display a listing of the resource.
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(Request $request){
		$fromDate = $request->get('fromDate');
		$toDate = $request->get('toDate');
		if($fromDate && $toDate){
			$ideas = $this->idea
				->where('created_at', '>=', $fromDate)
				->where('created_at', '<=', $toDate.' 23:59:59')
				->whereNotNull('submitted_at')
				->where('archived', '=', 0)
				->orderBy('created_at', 'desc')
				->get();
		}
		else if($fromDate){
			$ideas = $this->idea
				->where('created_at', '>=', $fromDate)
				->whereNotNull('submitted_at')
				->where('archived', '=', 0)
				->orderBy('created_at', 'desc')
				->get();
		}
		else if($toDate){
			$ideas = $this->idea
				->where('created_at', '<=', $toDate)
				->whereNotNull('submitted_at')
				->where('archived', '=', 0)
				->orderBy('created_at', 'desc')
				->get();
		}
		else{
			$ideas = $this->idea
				->where('status', '!=', 'Draft')
				->whereNotNull('submitted_at')
				->where('archived', '=', 0)
				->orderBy('created_at', 'desc')
				->all();
		}

		// Paginate the results
//		$posts = $posts->paginate(10);
		// Respond with json data
		return response()->json(InsideemuIdeaResource::collection($ideas));
	}

	/**
	 * Display the specified resource.
	 */
	public function show($ideaId){
		$idea = $this->idea->with('images')->with('posts')->findOrFail($ideaId);
		return response()->json(InsideemuIdeaResource::make($idea));
	}

	/**
	 * Convert an idea to a post
	 * @param int $ideaId
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function makepost(int $ideaId, InsideemuService $insideemuService){
		$idea = $this->idea->findOrFail($ideaId);

		// Make validation rules for InsideemuPost
		$rules = [
			'title' => 'required|max:255',
			'content' => 'required',
			'created_by' => 'required',
			'insideemu_idea_id' => 'required|exists:insideemu_ideas,id'
		];

		$source = '';
		if($idea->use_other_source){
			$source = $idea->other_source;
		}
		else{
			$source = $idea->contributor_first . ' ' . $idea->contributor_last;
		}

		// Change all new lines to <p> tags
		$content = $insideemuService->replaceNewlinesWithPTags($idea->content);

		$data = [
			'title' => $idea->title,
			'teaser' => $idea->teaser,
			'content' => $content,
			'created_by' => auth()->user()->id,
			'source' => $source,
			'insideemu_idea_id' => $idea->id
		];

		$validator = Validator::make($data, $rules);

		if($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 400);
		}

		$post = new InsideemuPost();
		$post->fill($data);
		$post->save();

		// Return the IDEA, not the POST, because we want to show the user that the idea has been converted
		return response()->json(InsideemuIdeaResource::make($idea));
	}

	/**
	 * Archive an idea.
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function archive($id){
		$idea = $this->idea->findOrFail($id);
		$idea->archived = 1;
		$idea->save();
		return response()->json(InsideemuIdeaResource::make($idea));
	}

	/**
	 * Reinstate an archived idea.
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function unarchive(int $id){
		$idea = $this->idea->findOrFail($id);
		$idea->archived = 0;
		$idea->save();
		return response()->json(InsideemuIdeaResource::make($idea));
	}

	/**
	 * Change the admin_status of an idea.
	 * @param Request $request
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function status(Request $request, int $id){
		$status = $request->get('admin_status');
		$idea = $this->idea->findOrFail($id);
		$idea->admin_status = $status;
		$idea->save();
		return response()->json(InsideemuIdeaResource::make($idea));
	}

	/**
	 * Delete an idea.
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy(int $id){
    $idea = $this->idea->findOrFail($id);
    $idea->delete();
    return $this->setStatusCode(200)->respond('Idea successfully deleted!');
	}
}
