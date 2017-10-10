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
      /*
      $expertsPaginated = Expert::orderBy('last_name', 'asc')->paginate(10);
      return view('admin.experts.index', compact('expertsPaginated'));
      */
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id, Email $email)
    {
      return view('admin.email.form', compact('email'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function form()
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

    /**
     *  Update the expert from the admin/preview view (which uses CKEDITOR)
     */
    public function updateFromPreview(Request $request, $id)
    {
      /*
        $expert = $this->expert->findOrFail($id);
        $expert->biography = $request->get('biography');
        $expert->save();
        flash()->success('Expert biography has been updated.');
        return redirect()->back();
      */
    }

}
