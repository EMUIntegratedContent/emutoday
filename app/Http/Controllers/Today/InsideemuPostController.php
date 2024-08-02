<?php

namespace Emutoday\Http\Controllers\Today;

use Emutoday\Http\Controllers\Controller;
use Emutoday\InsideemuPost;

class InsideemuPostController extends Controller
{
		protected $post;

		public function __construct(InsideemuPost $post){
			$this->post = $post;
//			$this->middleware('auth', []);
		}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//			$user = null;
//			if (\Auth::check()) {
//				$user = cas()->user();
//			}
//			return view('public.insideemu.ideas.index', compact('user'));
    }

    /**
     * Display the specified resource.
     */
    public function show(InsideemuPost $post)
    {
			// Make sure this post is live
			$live = $post->postIsLive();
			if(!$live) {
				return view('public.insideemu.posts.show', []);
			}

			$idea = $post->idea;
			$mainImg = $post->images()->where('imagetype_id', 29)->first();
			return view('public.insideemu.posts.show', compact('post', 'mainImg', 'idea'));
    }
}
