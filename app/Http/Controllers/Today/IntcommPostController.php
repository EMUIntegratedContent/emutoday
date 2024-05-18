<?php

namespace Emutoday\Http\Controllers\Today;

use Emutoday\Helpers\Interfaces\IBug;
use Emutoday\Http\Requests\StoreIntcommPostRequest;
use Emutoday\Http\Requests\UpdateIntcommPostRequest;
use Emutoday\Http\Controllers\Controller;
use Emutoday\IntcommPost;
use Illuminate\Support\Facades\View;

class IntcommPostController extends Controller
{

		public function __construct()
		{

		}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
			return view('public.intcomm.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('public.intcomm.posts.new');
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
    public function edit(IntcommPost $intcommPost)
    {
			return view('intcomm.edit', compact('intcommPost'));
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
