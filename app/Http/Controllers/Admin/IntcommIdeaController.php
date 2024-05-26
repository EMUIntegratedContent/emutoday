<?php

namespace Emutoday\Http\Controllers\Admin;

use Emutoday\Helpers\Interfaces\IBug;
use Emutoday\Http\Requests\StoreIntcommPostRequest;
use Emutoday\Http\Requests\UpdateIntcommPostRequest;
use Emutoday\Http\Controllers\Controller;
use Emutoday\IntcommIdea;
use Illuminate\Support\Facades\View;

class IntcommIdeaController extends Controller
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
		}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
			return view('admin.intcomm.ideas.index');
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
//    public function store(StoreIntcommPostRequest $request)
//    {
//        //
//    }
//
    /**
     * Display the specified resource.
     */
    public function show(IntcommIdea $idea)
    {
        return view('admin.intcomm.ideas.show');
    }
//
//    /**
//     * Show the form for editing the specified resource.
//     */
    public function edit(IntcommIdea $idea)
    {

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
