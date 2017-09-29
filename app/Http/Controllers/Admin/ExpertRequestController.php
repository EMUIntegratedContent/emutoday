<?php

namespace Emutoday\Http\Controllers\Admin;


use Emutoday\Expert;
use Emutoday\ExpertMediaRequest;
use Illuminate\Http\Request;

use Emutoday\Http\Requests;
use Emutoday\Helpers\Interfaces\IBug;

use Illuminate\Support\Facades\View;
use JavaScript;

class ExpertRequestController extends Controller
{

    protected $expertMediaRequest;
    protected $bugService;

    public function __construct(ExpertMediaRequest $expertMediaRequest, IBug $bugService)
    {
        $this->expertMediaRequest = $expertMediaRequest;
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
        $expertRequestsPaginated = ExpertMediaRequest::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.expertrequest.index', compact('expertRequestsPaginated'));
    }


    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id, ExpertMediaRequest $request)
    {
        $request = $this->expertMediaRequest->findOrFail($id);

        return view('admin.expertrequest.form', compact('request'));
    }

}
