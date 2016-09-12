<?php

namespace Emutoday\Http\Controllers\Admin;


use Emutoday\Announcement;
use Illuminate\Http\Request;

use Emutoday\Http\Requests;

class AnnouncementController extends Controller
{

    protected $announcement;

    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
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

        return view('admin.announcement.form', compact('announcement'));
    }
    
    public function queue(Announcement $announcement) {
        return view('admin.announcement.queue', compact('announcements'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function form(Announcement $announcement)
    {
        return view('admin.announcement.form', compact('announcement'));
    }

}
