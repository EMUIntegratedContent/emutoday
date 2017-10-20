<?php

namespace Emutoday\Http\Controllers\Admin;


use Emutoday\Email;
use Emutoday\StoryType;
use Illuminate\Http\Request;

use Emutoday\Http\Requests;
use Emutoday\Helpers\Interfaces\IBug;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\View;
use JavaScript;
use Emutoday\User;
use Carbon\Carbon;

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
    public function index(Request $request)
    {
      $currentDate = Carbon::now();
      // MULTIPLE PAGINATION TUTORIAL: https://stackoverflow.com/questions/24086269/laravel-multiple-pagination-in-one-page/25553245#25553245
      $emails_notready_current = $this->email
        ->where([ ['send_at', '>=' ,$currentDate], ['is_sent', 0] ])
        ->where(function($query){
            $query->where('is_approved', 0)
                  ->orWhere('is_ready', 0);
          })
          ->orderBy('send_at', 'asc')->paginate(10, ["*"], 'notready_current');

      $emails_ready_current = $this->email->where([
          ['is_ready', 1],
          ['is_approved', 1],
          ['is_sent', 0],
          ['send_at', '>=' ,$currentDate ]
          ])->orderBy('send_at', 'asc')->paginate(10, ["*"], 'ready_current');

      $emails_sent = $this->email->where([
          ['is_sent', 1],
          ['send_at', '<' ,$currentDate ]
          ])->orderBy('send_at', 'asc')->paginate(10, ["*"], 'sent');

      $emails_notsent_past = $this->email->where([
          ['is_sent', 0],
          ['send_at', '<' ,$currentDate ]
          ])->orderBy('send_at', 'asc')->paginate(10, ["*"], 'notsent_past');

      return view('admin.email.index',compact('emails_ready_current','emails_notready_current','emails_sent','emails_notsent_past'));
    }

    /**
    * Show the form for editing the specified email.
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
    * Show the form for creating a new email.
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

    /**
     * Delete an email.
     * NOTE: there is a DELETE HTTP verb that performs this automatically when this controller is defined as a resource in the router file, but GET verb is also needed.
     *
     * @param int $id
     * @return array
     */
    public function delete($id)
    {
      $email = $this->email->findOrFail($id);
      $title = $email->title;
      $email->delete();

      return back()->with('email_deleted', 'Email "' . $title . '" was successfully deleted.');
    }

}
