<?php

namespace Emutoday\Http\Controllers\Api;

use Emutoday\Http\Resources\IntcommPostResource;
use Emutoday\Imagetype;
use Emutoday\IntcommPost;
use Emutoday\Services\IntcommService;
use Emutoday\User;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Request as Input;
use Carbon\Carbon;

use Illuminate\Support\Facades\Validator;
use League\Fractal\Manager;
use League\Fractal;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

use Emutoday\Today\Transformers\FractalEventTransformerModelFull;

class IntcommPostController extends ApiController{
	protected $post;
	protected $validationRules;

	function __construct(IntcommPost $post){
		$this->post = $post;
		$this->validationRules = [
			'title' => 'required|max:255',
			'content' => 'required',
			'submitted_by' => 'required'
		];
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
			$posts = $this->post->with('idea')->where('start_date', '>=', $fromDate)->where('end_date', '<=', $toDate.' 23:59:59')->get();
		}
		else if($fromDate){
			$posts = $this->post->with('idea')->where('start_date', '>=', $fromDate)->get();
		}
		else if($toDate){
			$posts = $this->post->with('idea')->where('end_date', '<=', $toDate)->get();
		}
		else{
			$posts = $this->post->with('idea')->all();
		}

		// Paginate the results
//		$posts = $posts->paginate(10);
		// Respond with json data
		return response()->json(IntcommPostResource::collection($posts));
	}

	/**
	 * Display the specified resource.
	 */
	public function show($postId){
		$post = $this->post->with('images')->findOrFail($postId);
		return response()->json(IntcommPostResource::make($post));
	}

	/**
	 * Get the specified post
	 */
	public function edit(IntcommPost $post){
//    $fractal = new Manager();
//    $resource = new Fractal\Resource\Item($email, new FractalEmailTransformerModel);
//
//    return $this->setStatusCode(200)
//        ->respondUpdatedWithData('Got email.', $fractal->createData($resource)->toArray());
	}

	/**
	 * Store a new post
	 */
	public function store(Request $request, IntcommService $intcommService){
		$post = json_decode($request->get('post'), true);
		if (!$post) {
			return response()->json(['error' => 'Invalid parameters.'], 400);
		}

		$postId = isset($idea['postId']) ?: null;
		if($postId){
			$post = $this->post->findOrFail($postId);
			if($post) {
				return response()->json(['error' => 'Post already exists.'], 400);
			}
		}

		$data = [
			'title' => $post['title'],
			'teaser' => $post['teaser'],
			'content' => $post['content'],
			'start_date' => $post['start_date'],
			'end_date' => $post['end_date'],
			'admin_status' => $post['admin_status'],
			'submitted_by' => auth()->user(),
		];

		$validator = Validator::make($data, $this->validationRules);

		if($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 422);
		}

		$newPost = new IntcommPost();
		$newPost->fill($data);
		$newPost->save();

		$intcommService->handlePostImages($newPost, $post);

		return response()->json(IntcommPostResource::make($newPost));
	}

	/**
	 * Update the specified post
	 * @param Request $request
	 * @param int $postId
	 * @param IntcommService $intcommService
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, int $postId, IntcommService $intcommService) {
		$postArr = json_decode($request->get('post'), true);
		if (!$postArr) {
			return response()->json(['error' => $request->all()], 400);
		}

		$post = $this->post->findOrFail($postId);
		if(!$post){
			return response()->json(['error' => 'Post not found.'], 404);
		}

		$data = [
			'title' => $postArr['title'],
			'teaser' => $postArr['teaser'],
			'content' => $postArr['content'],
			'start_date' => $postArr['start_date'],
			'end_date' => $postArr['end_date'],
			'admin_status' => $postArr['admin_status'],
			'submitted_by' => $post->submitted_by,
		];

		$validator = Validator::make($data, $this->validationRules);

		if($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 422);
		}

		$post->fill($data);
		$post->save();

		$intcommService->handlePostImages($post, $postArr);

		$post = $this->post->findOrFail($postId); // get the entire updated post
		return response()->json(IntcommPostResource::make($post));
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


	/**
	 * Get the image types for the post images
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getPostImageTypes(){
		$types = Imagetype::where('group', 'intcommpost')->get(); // get email image types
		return response()->json($types);
	}
}
