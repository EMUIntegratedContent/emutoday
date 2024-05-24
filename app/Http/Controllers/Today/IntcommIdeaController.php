<?php

namespace Emutoday\Http\Controllers\Today;

use Emutoday\Http\Controllers\Controller;
use Emutoday\IntcommIdea;

class IntcommIdeaController extends Controller
{
		protected $idea;

		public function __construct(IntcommIdea $idea){
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
			return view('public.intcomm.ideas.index', compact('user'));
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

			return view('public.intcomm.ideas.new', compact('user'));
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
    public function edit(IntcommIdea $idea)
    {
			$ideaId  = $idea->id;
			$user = null;
			if (\Auth::check()) {
				$user = cas()->user();
			}

			return view('public.intcomm.ideas.edit', compact('ideaId', 'user'));
    }
//
//    /**
//     * Update the specified resource in storage.
//     */
//    public function update(UpdateIntcommPostRequest $request, IntcommPost $intcommPost)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy(IntcommPost $intcommPost)
//    {
//        //
//    }
}
