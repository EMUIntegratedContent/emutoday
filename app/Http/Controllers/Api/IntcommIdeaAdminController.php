<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\Http\Resources\IntcommIdeaResource;
use Emutoday\IntcommIdea;
use Emutoday\User;
use Illuminate\Http\Request;
use Emutoday\IntcommPost;
use Illuminate\Support\Facades\Validator;

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
		$idea = $this->idea->with('images')->with('posts')->findOrFail($ideaId);
		return response()->json(IntcommIdeaResource::make($idea));
	}

	/**
	 * Convert an idea to a post
	 * @param int $ideaId
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function makepost(int $ideaId){
		$idea = $this->idea->findOrFail($ideaId);

		// Make validation rules for IntcommPost
		$rules = [
			'title' => 'required|max:255',
			'teaser' => 'required|max:100',
			'content' => 'required',
			'submitted_by' => 'required',
			'intcomm_idea_id' => 'required|exists:intcomm_ideas,id'
		];

		$data = [
			'title' => $idea->title,
			'teaser' => $idea->teaser,
			'content' => $idea->content,
			'submitted_by' => $idea->submitted_by,
			'intcomm_idea_id' => $idea->id
		];

		$validator = Validator::make($data, $rules);

		if($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 400);
		}

		$post = new IntcommPost();
		$post->fill($data);
		$post->save();

		return response()->json(IntcommIdeaResource::make($idea));
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
		return response()->json(IntcommIdeaResource::make($idea));
	}

	/**
	 * Reinstate an archived idea.
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function unarchive($id){
		$idea = $this->idea->findOrFail($id);
		$idea->archived = 0;
		$idea->save();
		return response()->json(IntcommIdeaResource::make($idea));
	}

	/**
	 * Delete an idea.
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy($id){
    $idea = $this->idea->findOrFail($id);
    $idea->delete();
    return $this->setStatusCode(200)->respond('Idea successfully deleted!');
	}
}
