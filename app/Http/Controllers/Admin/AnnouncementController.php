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
        View::share('bugExperts', $this->bugService->getUnapprovedExperts());
        View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
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
        $announcements = $this->announcement;

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

    public function archives($archivetype = 'general'){
      $announcements = $this->announcement->where('is_archived', 1)->paginate(10);

      return view('admin.announcement.archives', compact('announcements'));
    }

    public function unarchive($id){
        $announcement = $this->announcement->findOrFail($id);

        if($announcement){
            $announcement->is_archived = 0;
            $announcement->save();

            \Session::flash('success_message', 'Announcement has been unarchived.');
            \Session::flash('success_message_unarchived_id', $id);
            \Session::flash('alert-class', 'alert-success');
        } else {
            \Session::flash('failure_message', 'Announcement was not unarchived.');
            \Session::flash('alert-class', 'alert-danger');
        }
      $announcements = $this->announcement->where('is_archived', 1)->paginate(10);

      return redirect()->route('admin_announcement_archives');
    }

}
