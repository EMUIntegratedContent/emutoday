<?php

namespace Emutoday\Http\Controllers\Admin;

use Emutoday\Helpers\Interfaces\IBug;
use Emutoday\Http\Requests\StoreIntcommPostRequest;
use Emutoday\Http\Requests\UpdateIntcommPostRequest;
use Emutoday\Http\Controllers\Controller;
use Emutoday\IntcommPost;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class IntcommPostController extends Controller{
	protected IBug $bugService;

	public function __construct(IBug $bugService){

		$this->bugService = $bugService;
		View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
		View::share('bugEvents', $this->bugService->getUnapprovedEvents());
		View::share('bugStories', $this->bugService->getUnapprovedStories());
		View::share('bugExperts', $this->bugService->getUnapprovedExperts());
		View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index(){
		return view('admin.intcomm.posts.index');
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(){
		$user = \Auth::user();
		return view('admin.intcomm.posts.create', compact('user'));
	}
//
//    /**
//     * Store a newly created resource in storage.
//     */
//    public function store(StoreIntcommPostRequest $request)
//    {
//        //
//    }
//
//    /**
//     * Display the specified resource.
//     */
//    public function show(IntcommPost $intcommPost)
//    {
//        //
//    }
//
	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(IntcommPost $intcommPost){
		$user = \Auth::user();
		return view('admin.intcomm.posts.edit', compact('intcommPost', 'user'));
	}

	/**
	 * Update the specified resource in storage.
	 * NOTE: this route is used when updating from the preview.intcomm.post page. Everything else goes through the API controller.
	 */
	public function update(Request $request){
		$rules = [
			'content' => 'required',
		];

		$data = [
			'content' => $request->get('content'),
		];

		$postId = $request->get('id');
		$content = $request->get('content');

		$validator = Validator::make($data, $rules);
		if($validator->fails()) {
			return redirect()->route('preview_intcomm_post', ['postId' => $postId])->with('errors', $validator->errors());
		}
		$post = IntcommPost::find($postId);
		$post->content = $content;
		$post->save();

		// Proceed with redirection or further processing
		return redirect()->route('preview_intcomm_post', ['postId' => $postId])->with('success', 'Post updated successfully.');
	}
//
//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy(IntcommPost $intcommPost)
//    {
//        //
//    }
}
