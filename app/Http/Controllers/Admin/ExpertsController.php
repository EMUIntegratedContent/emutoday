<?php

namespace Emutoday\Http\Controllers\Admin;


use Emutoday\Expert;
use Illuminate\Http\Request;

use Emutoday\Http\Requests;
use Emutoday\Helpers\Interfaces\IBug;

use Illuminate\Support\Facades\View;
use JavaScript;

class ExpertsController extends Controller
{

    protected $expert;
    protected $bugService;

    public function __construct(Expert $expert, IBug $bugService)
    {
        $this->expert = $expert;
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
      $expertsPaginated = Expert::orderBy('last_name', 'asc')->paginate(10);
      return view('admin.experts.index', compact('expertsPaginated'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $author = $this->author->findOrFail($id);

        return view('admin.authors.form', compact('author'));
    }

    public function queue($atype = null) {
        if (is_null($atype)) {
            $atype = 'general';
        } else {
            $atype = $atype;
        }
        $announcement = $this->announcement;

        //return view('admin.announcement.queue', compact('announcements', 'atype'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function form()
    {
        $expert = $this->expert;

        return view('admin.experts.form', compact('expert'));
    }

}
