<?php

namespace Emutoday\Http\Controllers\Admin;


use Emutoday\Author;
use Illuminate\Http\Request;

use Emutoday\Http\Requests;
use Emutoday\Helpers\Interfaces\IBug;

use Illuminate\Support\Facades\View;

class AuthorsController extends Controller
{

    protected $author;
    protected $bugService;

    public function __construct(Author $author, IBug $bugService)
    {
        $this->author = $author;
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
      $authorsPaginated = Author::orderBy('last_name', 'asc')->paginate(10);
      return view('admin.authors.index', compact('atype','authorsPaginated'));
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
        $author = $this->author;

        return view('admin.authors.form', compact('author'));
    }

}
