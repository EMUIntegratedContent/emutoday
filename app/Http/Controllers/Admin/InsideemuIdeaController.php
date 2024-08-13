<?php

namespace Emutoday\Http\Controllers\Admin;

use Emutoday\Helpers\Interfaces\IBug;
use Emutoday\Http\Requests\StoreInsideemuPostRequest;
use Emutoday\Http\Requests\UpdateInsideemuPostRequest;
use Emutoday\Http\Controllers\Controller;
use Emutoday\InsideemuIdea;
use Illuminate\Support\Facades\View;

class InsideemuIdeaController extends Controller
{
		protected IBug $bugService;

		public function __construct(IBug $bugService)
		{

			$this->bugService = $bugService;
			View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
			View::share('bugEvents', $this->bugService->getUnapprovedEvents());
			View::share('bugStories', $this->bugService->getUnapprovedStories());
			View::share('bugExperts', $this->bugService->getUnapprovedExperts());
			View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
			View::share('bugInsideemuIdeas', $this->bugService->getNewInsideemuIdeas());
		}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
			return view('admin.insideemu.ideas.index');
    }

//    /**
//     * Show the form for creating a new resource.
//     */
//    public function create()
//    {
//        //
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     */
//    public function store(StoreInsideemuPostRequest $request)
//    {
//        //
//    }
//
    /**
     * Display the specified resource.
     */
    public function show(InsideemuIdea $idea)
    {
        return view('admin.insideemu.ideas.show');
    }
//
//    /**
//     * Show the form for editing the specified resource.
//     */
    public function edit(InsideemuIdea $idea)
    {

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
