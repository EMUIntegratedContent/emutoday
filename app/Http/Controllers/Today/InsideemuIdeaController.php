<?php

namespace Emutoday\Http\Controllers\Today;

use Emutoday\Http\Controllers\Controller;
use Emutoday\InsideemuIdea;

class InsideemuIdeaController extends Controller
{
		protected $idea;

		public function __construct(InsideemuIdea $idea){
			$this->idea = $idea;
			$this->middleware('auth', []);
		}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
			$user = null;
			if (\Auth::check()) {
				$user = cas()->user();
			}
			return view('public.insideemu.ideas.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
			$user = null;
			if (\Auth::check()) {
				$user = cas()->user();
			}

			return view('public.insideemu.ideas.new', compact('user'));
    }
//
//    /**
//     * Store a newly created resource in storage.
//     */
//    public function store(StoreInsideemuPostRequest $request)
//    {
//        //
//    }
//
//    /**
//     * Display the specified resource.
//     */
//    public function show(InsideemuPost $insideemuPost)
//    {
//        //
//    }
//
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InsideemuIdea $idea)
    {
			$ideaId  = $idea->id;
			$user = null;
			if (\Auth::check()) {
				$user = cas()->user();
			}

			return view('public.insideemu.ideas.edit', compact('ideaId', 'user'));
    }
//
//    /**
//     * Update the specified resource in storage.
//     */
//    public function update(UpdateInsideemuPostRequest $request, InsideemuPost $insideemuPost)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy(InsideemuPost $insideemuPost)
//    {
//        //
//    }
}
