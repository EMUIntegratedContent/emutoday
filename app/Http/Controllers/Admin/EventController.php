<?php

namespace Emutoday\Http\Controllers\Admin;


use Emutoday\Event;
use Illuminate\Http\Request;

use Emutoday\Http\Requests;

use Emutoday\Helpers\Interfaces\IBug;
use Illuminate\Support\Facades\View;

class EventController extends Controller
{

    protected $event;
    protected $bugService;

    public function __construct(Event $event, IBug $bugService)
    {
        $this->event = $event;

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
    public function queue() {
        return view('admin.event.queue');
    }
    public function lbcqueue() {
        return view('admin.event.lbcqueue');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function form(Event $event)
    {
        return view('admin.event.form', compact('event'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $event = $this->event->findOrFail($id);
        // $categories = \emutoday\Category::pluck('category', 'id');

        return view('admin.event.form', compact('event'));
    }


}
