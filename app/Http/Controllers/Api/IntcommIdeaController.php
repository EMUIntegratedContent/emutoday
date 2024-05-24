<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\Http\Resources\IntcommIdeaResource;
use Emutoday\IntcommIdea;
use Emutoday\User;
use Illuminate\Http\Request;

class IntcommIdeaController extends ApiController{
	protected $idea;

	function __construct(IntcommIdea $idea){
		$this->idea = $idea;
	}

	/**
	 * Display a listing of the resource.
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function index(Request $request){
//		$fromDate = $request->get('fromDate');
//		$toDate = $request->get('toDate');
//		if($fromDate && $toDate){
//			$posts = $this->post->where('start_date', '>=', $fromDate)->where('end_date', '<=', $toDate.' 23:59:59')->get();
//		}
//		else if($fromDate){
//			$posts = $this->post->where('start_date', '>=', $fromDate)->get();
//		}
//		else if($toDate){
//			$posts = $this->post->where('end_date', '<=', $toDate)->get();
//		}
//		else{
//			$posts = $this->post->all();
//		}

		$netid = $request->get('netid');
		if(!$netid){
			return response()->json(['error' => 'Netid is required.'], 400);
		}

		$ideas = $this->idea->where('submitted_by', $netid)->get();

		// Paginate the results
//		$posts = $posts->paginate(10);
		// Respond with json data
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
	 * Store a new post
	 */
	public function store(Request $request){
//		$validationRules = [
//			'title' => 'required|min:10',
//			'send_at' => 'nullable|date_format:Y-m-d H:i:s'
//		];
//		// The validator if there is a presidential message being included in the email, a valid URL must be passed
//		if($request->get('is_president_included')){
//			$validationRules['president_teaser'] = 'required';
//			$validationRules['president_url'] = 'required|regex:/^(https?:\/\/)([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
//		}
//
//		$validation = \Validator::make(Input::all(), $validationRules);
//
//		if($validation->fails()){
//			return $this->setStatusCode(422)
//				->respondWithError($validation->errors()->getMessages());
//		}
//
//		if($validation->passes()){
//
//			$fractal = new Manager();
//			$resource = new Fractal\Resource\Item($email, new FractalEmailTransformerModel);
//
//			return $this->setStatusCode(200)
//				->respondUpdatedWithData('Email has been created.', $fractal->createData($resource)->toArray());
//		}
	}

	/**
	 * Update the specified post
	 */
	public function update(Request $request, $id){
//		$post = $this->post->findOrFail($id);
//
//		$validationRules = [
//			'title' => 'required|min:10',
//			'send_at' => 'nullable|date_format:Y-m-d H:i:s'
//		];
//
//		$validation = \Validator::make(Input::all(), $validationRules);
//
//		if($validation->fails()){
//			return $this->setStatusCode(422)
//				->respondWithError($validation->errors()->getMessages());
//		}
//
//		if($validation->passes()){
//
//		}
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
