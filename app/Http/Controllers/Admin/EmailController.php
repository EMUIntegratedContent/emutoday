<?php

namespace Emutoday\Http\Controllers\Admin;


use Emutoday\Email;
use Emutoday\StoryType;
use Emutoday\Imagetype;
use Illuminate\Http\Request;

use Emutoday\Http\Requests;
use Emutoday\Helpers\Interfaces\IBug;

use Illuminate\Support\Facades\View;
use JavaScript;
use Emutoday\User;

class EmailController extends Controller
{

    protected $email;
    protected $bugService;

    public function __construct(Email $email, IBug $bugService)
    {
        $this->email = $email;
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
    public function edit(Email $email)
    {
      $user = \Auth::user();

      // Get all story types for email story queue
      $stypes  = collect(StoryType::select('name','shortname')->get());
      return view('admin.email.form', compact('email', 'stypes'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function show()
    {
        $email = $this->email;

        $user = \Auth::user();

        // Get all story types for email story queue
        $stypes  = collect(StoryType::select('name','shortname')->get());
        JavaScript::put([
            'cuser' => $user,
        ]);

        return view('admin.email.form', compact('email', 'stypes'));
    }

}
