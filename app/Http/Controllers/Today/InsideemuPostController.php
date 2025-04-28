<?php

namespace Emutoday\Http\Controllers\Today;

use Emutoday\Http\Controllers\Controller;
use Emutoday\Http\Resources\InsideemuPostPublicResource;
use Emutoday\Http\Resources\InsideemuPostResource;
use Emutoday\Imagetype;
use Emutoday\InsideemuPost;

class InsideemuPostController extends Controller
{
		protected $post;

		public function __construct(InsideemuPost $post){
			$this->post = $post;
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

			$sidePostsRaw = InsideemuPost::all()->filter(function($p) use ($post){
				return $p->id !== $post->id && $p->postIsLive();
			})->take(-5);

			$sidePosts = InsideemuPostResource::collection($sidePostsRaw);
			$post = InsideemuPostResource::make($post);


			return view('public.insideemu.posts.show', compact('post', 'mainImg', 'idea', 'sidePosts'));
    }
}
