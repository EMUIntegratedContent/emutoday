<?php

namespace Emutoday\Http\Controllers\Admin;


use Emutoday\MediaHighlight;
use Illuminate\Http\Request;

use Emutoday\Http\Requests;
use Emutoday\Helpers\Interfaces\IBug;

use Illuminate\Support\Facades\View;

class MediaHighlightController extends Controller
{

    protected $highlight;
    protected $bugService;

    public function __construct(MediaHighlight $highlight, IBug $bugService)
    {
        $this->highlight = $highlight;
        $this->bugService = $bugService;

        View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
        View::share('bugEvents', $this->bugService->getUnapprovedEvents());
        View::share('bugStories', $this->bugService->getUnapprovedStories());
        View::share('bugExperts', $this->bugService->getUnapprovedExperts());
        View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index($atype = null)
    {
      $highlightsPaginated = MediaHighlight::orderBy('start_date', 'asc')->paginate(10);
      return view('admin.mediahighlight.index', compact('highlightsPaginated'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $user = \Auth::user();
        $highlight = $this->highlight->findOrFail($id);

        return view('admin.mediahighlight.form', compact('highlight'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function form()
    {
        $highlight = $this->highlight;

        return view('admin.mediahighlight.form', compact('highlight'));
    }

}
