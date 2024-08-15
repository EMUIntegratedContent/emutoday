<?php

namespace Emutoday\Http\Controllers\Api;

use Emutoday\Http\Resources\InsideemuPostResource;
use Emutoday\Imagetype;
use Emutoday\InsideemuPost;
use Emutoday\Services\InsideemuService;
use Emutoday\User;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as Input;
use Carbon\Carbon;

use Illuminate\Support\Facades\Validator;
use League\Fractal\Manager;
use League\Fractal;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

use Emutoday\Today\Transformers\FractalEventTransformerModelFull;

class InsideemuPostController extends ApiController{
	protected $post;
	protected $validationRules;

	function __construct(InsideemuPost $post){
		$this->post = $post;
		$this->validationRules = [
			'title' => 'required|max:255',
			'content' => 'required',
			'created_by' => 'required'
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
			$posts = $this->post
				->with('idea')
				->where(function($query) use ($fromDate) {
					$query->where('start_date', '>=', $fromDate)
						->orWhereNull('start_date');
				})
				->where(function($query) use ($toDate) {
					$query->where('end_date', '<=', $toDate . ' 23:59:59')
						->orWhereNull('end_date');
				})
				->orderBy('start_date', 'desc')
				->get();
		}
		else if($fromDate){
			$posts = $this->post
				->with('idea')
				->where(function($query) use ($fromDate) {
					$query->where('start_date', '>=', $fromDate)
						->orWhereNull('start_date');
				})
				->orderBy('start_date', 'desc')
				->get();
		}
		else if($toDate){
			$posts = $this->post
				->with('idea')
				->where(function($query) use ($toDate) {
					$query->where('end_date', '<=', $toDate . ' 23:59:59')
						->orWhereNull('end_date');
				})
				->orderBy('start_date', 'desc')
				->get();
		}
		else{
			$posts = $this->post
				->with('idea')
				->orderBy('start_date', 'desc')
				->get();
		}

		// Paginate the results
//		$posts = $posts->paginate(10);
		// Respond with json data
		return response()->json(InsideemuPostResource::collection($posts));
	}

	/**
	 * Display the specified resource.
	 */
	public function show($postId){
		$post = $this->post->with('images')->findOrFail($postId);
		return response()->json(InsideemuPostResource::make($post));
	}

	/**
	 * Store a new post
	 */
	public function store(Request $request, InsideemuService $insideemuService){
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

		// Non-admins creating posts need to have the post approved by an admin
		$user = auth()->user();
		if ($user->canApproveInsideemuPosts()) {
			$adminStatus = $post['admin_status'];
			if($adminStatus === 'Approved'){
				$isHubPost = $post['is_hub_post'];
			} else {
				$isHubPost = 0;
			}
			if($isHubPost) {
				// Remove hub status from all other posts
				$hubPosts = $this->post->where('id', '<>', $postId)->where('is_hub_post', 1)->get();
				foreach($hubPosts as $hubPost){
					$hubPost->is_hub_post = 0;
					$hubPost->save();
				}
			}
		} else {
			$adminStatus = 'Pending';
			$isHubPost = 0;
		}

		$data = [
			'title' => $post['title'],
			'teaser' => $post['teaser'],
			'content' => $post['content'],
			'start_date' => $post['start_date'],
			'end_date' => $post['end_date'],
			'admin_status' => $adminStatus,
			'seq' => 0,
			'is_hub_post' => $isHubPost,
			'created_by' => Auth::user()->id,
			'source' => $post['source'],
		];

		$validator = Validator::make($data, $this->validationRules);

		if($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 422);
		}

		$newPost = new InsideemuPost();
		$newPost->fill($data);
		$newPost->save();

		$insideemuService->handlePostImages($newPost, $post);

		return response()->json(InsideemuPostResource::make($newPost));
	}

	/**
	 * Update the specified post
	 * @param Request $request
	 * @param int $postId
	 * @param InsideemuService $insideemuService
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(Request $request, int $postId, InsideemuService $insideemuService) {
		$postArr = json_decode($request->get('post'), true);
		if (!$postArr) {
			return response()->json(['error' => $request->all()], 400);
		}

		$post = $this->post->findOrFail($postId);
		if(!$post){
			return response()->json(['error' => 'Post not found.'], 404);
		}

		// People without insideemu making changes need to have the post re-approved
		$user = auth()->user();
		if ($user->canApproveInsideemuPosts()) {
			$adminStatus = $postArr['admin_status'];
			if($adminStatus === 'Approved'){
				$isHubPost = $postArr['is_hub_post'];
			} else {
				$isHubPost = 0;
			}
			if($isHubPost) {
				// Remove hub status from all other posts
				$hubPosts = $this->post->where('id', '<>', $postId)->where('is_hub_post', 1)->get();
				foreach($hubPosts as $hubPost){
					$hubPost->is_hub_post = 0;
					$hubPost->save();
				}
			}
		} else {
			$adminStatus = 'Pending';
			$isHubPost = 0;
		}

		$data = [
			'title' => $postArr['title'],
			'teaser' => $postArr['teaser'],
			'content' => $postArr['content'],
			'start_date' => $postArr['start_date'],
			'end_date' => $postArr['end_date'],
			'admin_status' => $adminStatus,
			'source' => $postArr['source'],
			'is_hub_post' => $isHubPost,
			'created_by' => $post->created_by
		];

		$validator = Validator::make($data, $this->validationRules);

		if($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 422);
		}

		$post->fill($data);
		$post->save();

		$insideemuService->handlePostImages($post, $postArr);

		$post = $this->post->findOrFail($postId); // get the entire updated post
		return response()->json(InsideemuPostResource::make($post));
	}

	/**
	 * Add post to the bottom of the rankings
	 * @param Request $request
	 * @param $postId
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function addRank(Request $request, $postId){
		$post = $this->post->findOrFail($postId);
		if(!$post){
			return response()->json(['error' => 'Post not found.'], 404);
		}

		$highestSeq = $this->post->max('seq'); // get the highest seq of all posts
		$post->seq = $highestSeq + 1;
		$post->save();

		$post = $this->post->findOrFail($postId); // get the entire updated post
		return response()->json(InsideemuPostResource::make($post));
	}

	/**
	 * Update the rankings of the posts (use order of the array to set the seq of the posts)
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function updateRanks(Request $request){
		$postIds = json_decode($request->get('postIds'), true);
		if (!isset($postIds)) {
			return response()->json(['error' => 'Invalid parameters.'], 400);
		}

		$seq = 1;
		foreach($postIds as $pid){
			$post = $this->post->findOrFail($pid);
			if(!$post){
				return response()->json(['error' => 'Post not found.'], 404);
			}
			$post->seq = $seq;
			$post->save();
			$seq++;
		}

		// Set seq = 0 for all other posts
		$posts = $this->post->whereNotIn('id', $postIds)->get();
		foreach($posts as $post){
			$post->seq = 0;
			$post->save();
		}

		return response()->json(['success' => 'Posts updated.']);
	}

	/**
	 * Make this post the hub post and remove the hub status from all other posts
	 * @param Request $request
	 * @param $postId
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function makeHubPost(Request $request, $postId){
		$post = $this->post->findOrFail($postId);
		if(!$post){
			return response()->json(['error' => 'Post not found.'], 404);
		}

		// Remove hub status from all other posts
		$posts = $this->post->where('is_hub_post', 1)->get();
		foreach($posts as $post){
			$post->is_hub_post = 0;
			$post->save();
		}

		$post = $this->post->findOrFail($postId);
		// Set this post as the hub post
		$post->is_hub_post = 1;
		$post->save();

		return response()->json(InsideemuPostResource::make($post));
	}

	/**
	 * Get the image types for the post images
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getPostImageTypes(){
		$types = Imagetype::where('group', 'insideemu')->get(); // get email image types
		return response()->json($types);
	}

	/**
	 * Delete a post and any images.
	 * @param int $id
	 * @param InsideemuService $insideemuService
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function destroy($id, InsideemuService $insideemuService){
		$post = $this->post->findOrFail($id);
		$post->delete();
		$insideemuService->deletePostImages($id);
		return $this->setStatusCode(200)->respond('Post successfully deleted!');
	}
}
