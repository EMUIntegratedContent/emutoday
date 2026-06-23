<?php

namespace Emutoday\Http\Controllers\Admin;


use Emutoday\StudentEmail;
use Emutoday\StoryType;
use Illuminate\Http\Request;

use Emutoday\Http\Requests;
use Emutoday\Helpers\Interfaces\IBug;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\View;
use JavaScript;
use Emutoday\User;
use Carbon\Carbon;

class StudentEmailController extends Controller
{

    protected $studentEmail;
    protected $bugService;

    public function __construct(StudentEmail $studentEmail, IBug $bugService)
    {
        $this->studentEmail = $studentEmail;
        $this->bugService = $bugService;

        View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
        View::share('bugEvents', $this->bugService->getUnapprovedEvents());
        View::share('bugStories', $this->bugService->getUnapprovedStories());
        View::share('bugExperts', $this->bugService->getUnapprovedExperts());
        View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
        View::share('bugInsideemuIdeas', $this->bugService->getNewInsideemuIdeas());
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
      $emails_notready_current = $this->studentEmail
        ->whereNull('send_at')
        ->orWhere([ ['send_at', '>=' ,$currentDate], ['is_sent', 0] ])
        ->where(function($query){
            $query->where('is_approved', 0)
                  ->orWhere('is_ready', 0);
          })
          ->orderBy('send_at', 'desc')->paginate(10, ["*"], 'notready_current');

      $emails_ready_current = $this->studentEmail->where([
          ['is_ready', 1],
          ['is_approved', 1],
          ['is_sent', 0],
          ['send_at', '>=' ,$currentDate ]
          ])->orderBy('send_at', 'desc')->paginate(10, ["*"], 'ready_current');

      $emails_sent = $this->studentEmail->where([
          ['is_sent', 1],
          ['send_at', '<' ,$currentDate ]
          ])->orderBy('send_at', 'desc')->paginate(10, ["*"], 'sent');

      $emails_notsent_past = $this->studentEmail->where([
          ['is_sent', 0],
          ['send_at', '<' ,$currentDate ]
          ])->orderBy('send_at', 'desc')->paginate(10, ["*"], 'notsent_past');

      return view('admin.studentemail.index',compact('emails_ready_current','emails_notready_current','emails_sent','emails_notsent_past'));
    }

    /**
    * Show the form for editing the specified student email.
    *
    * @param  StudentEmail  $studentEmail
    * @return \Illuminate\Http\Response
    */
    public function edit(StudentEmail $studentEmail)
    {
      $user = \Auth::user();

      // Get all story types for the story queues
      $stypes  = collect(StoryType::select('name','shortname')->get());
      return view('admin.studentemail.form', ['email' => $studentEmail, 'stypes' => $stypes]);
    }

    /**
    * Show the form for creating a new student email.
    *
    * @return \Illuminate\Http\Response
    */
    public function show()
    {
        $studentEmail = $this->studentEmail;

        $user = \Auth::user();

        // Get all story types for the story queues
        $stypes  = collect(StoryType::select('name','shortname')->get());
        JavaScript::put([
            'cuser' => $user,
        ]);

        return view('admin.studentemail.form', ['email' => $studentEmail, 'stypes' => $stypes]);
    }

    /**
     * Delete a student email.
     * NOTE: mirrors the original Email builder, which exposes a GET delete in addition to the
     * resource DELETE (the GET avoids the CAS/CSRF token interaction on the admin path).
     *
     * @param int $id
     * @return array
     */
    public function delete($id)
    {
      $studentEmail = $this->studentEmail->findOrFail($id);
      $title = $studentEmail->title;
      $studentEmail->delete();

      return back()->with('email_deleted', 'Student email "' . $title . '" was successfully deleted.');
    }

}
