<?php

namespace Emutoday\Http\Controllers\Admin;


use Emutoday\Announcement;
use Illuminate\Http\Request;

use Emutoday\Http\Requests;
use Emutoday\Helpers\Interfaces\IBug;

use Illuminate\Support\Facades\View;

class AnnouncementController extends Controller
{

    protected $announcement;
    protected $bugService;

    public function __construct(Announcement $announcement, IBug $bugService)
    {
        $this->announcement = $announcement;
        $this->bugService = $bugService;
        
        View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
        View::share('bugEvents', $this->bugService->getUnapprovedEvents());
        View::share('bugStories', $this->bugService->getUnapprovedStories());
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {

    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $announcement = $this->announcement->findOrFail($id);
        $atype = $announcement->type;

        return view('admin.announcement.form', compact('announcement','atype'));
    }

    public function queue($atype = null) {
        if (is_null($atype)) {
            $atype = 'general';
        } else {
            $atype = $atype;
        }
        $announcement = $this->announcement;

        return view('admin.announcement.queue', compact('announcements', 'atype'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function form($atype = null)
    {
        if (is_null($atype)) {
            $atype = 'general';
        } 
        
        $announcement = $this->announcement;
        
        return view('admin.announcement.form', compact('announcement', 'atype'));
    }

}
