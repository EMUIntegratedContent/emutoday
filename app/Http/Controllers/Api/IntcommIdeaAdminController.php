<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\Http\Resources\IntcommIdeaResource;
use Emutoday\IntcommIdea;
use Emutoday\User;
use Illuminate\Http\Request;

class IntcommIdeaAdminController extends ApiController{
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
