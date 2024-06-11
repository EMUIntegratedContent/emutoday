<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\Http\Resources\IntcommIdeaResource;
use Emutoday\IntcommIdea;
use Emutoday\IntcommPost;
use Emutoday\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IntcommIdeaPublicController extends ApiController{
	protected $idea;
	protected $validationRules = [
		'title' => 'required|max:255',
		'content' => 'required',
		'contributor_netid' => 'required',
		'contributor_first' => 'required',
		'contributor_last' => 'required',
	];
	protected $draftValidationRules = [
		'title' => 'required|max:255',
		'contributor_netid' => 'required',
		'contributor_first' => 'required',
		'contributor_last' => 'required',
	];

	function __construct(IntcommIdea $idea){
		$this->idea = $idea;
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

		return response()->json(IntcommIdeaResource::collection($ideas));
	}

	/**
	 * Display the specified resource.
	 */
	public function show($ideaId){
		$idea = $this->idea->with('images')->findOrFail($ideaId);
		return response()->json(IntcommIdeaResource::make($idea));
	}

	/**
	 * Get the specified post
	 */
	public function edit(IntcommIdea $idea){
//    $fractal = new Manager();
//    $resource = new Fractal\Resource\Item($email, new FractalEmailTransformerModel);
//
//    return $this->setStatusCode(200)
//        ->respondUpdatedWithData('Got email.', $fractal->createData($resource)->toArray());
	}

	/**
	 * Store a new idea
	 */
	public function store(Request $request){
//		$idea = json_decode($request->get('idea'), true);
//		$saveType = $request->get('saveType');
//		if (!$idea || !$saveType) {
//			return response()->json(['error' => 'Invalid parameters.'], 400);
//		}
//
//		$ideaId = isset($idea['ideaId']) ?: null;
//		if($ideaId){
//			$idea = $this->idea->findOrFail($ideaId);
//			if($idea) {
//				return response()->json(['error' => 'Idea already exists.'], 400);
//			}
//		}
//
//		$data = [
//			'title' => $idea['title'],
//			'teaser' => $idea['teaser'],
//			'content' => $idea['content'],
//			'contributor_netid' => $idea['contributor_netid'],
//			'contributor_first' => $idea['contributor_first'],
//			'contributor_last' => $idea['contributor_last']
//		];
//
//		if($saveType == 'draft'){
//			$validator = Validator::make($data, $this->draftValidationRules);
//		} else {
//			$validator = Validator::make($data, $this->validationRules);
//		}
//
//		if($validator->fails()) {
//			return response()->json(['error' => $validator->errors()], 400);
//		}
//
//		$idea = new IntcommIdea();
//		$idea->fill($data);
//		$idea->save();

		// Get any attached images files from the request
		$images = $request->file('images');

		return response()->json($images);
//		return response()->json(IntcommIdeaResource::make($idea));
	}

	/**
	 * Update the specified post
	 * @param Request $request
	 * @param int $ideaId
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, int $ideaId){
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
			'contributor_last' => $ideaArr['contributor_last']
		];

		if($saveType == 'draft'){
			$validator = Validator::make($data, $this->draftValidationRules);
		} else {
			$validator = Validator::make($data, $this->validationRules);
		}

		if($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 400);
		}

		$idea->fill($data);
		$idea->is_submitted = $saveType == 'draft' ? 0 : 1;
		$idea->save();

		$idea = $this->idea->findOrFail($ideaId); // get the entire updated idea
		return response()->json(IntcommIdeaResource::make($idea));
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
