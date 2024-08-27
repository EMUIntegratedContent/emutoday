<?php

namespace Emutoday\Http\Controllers\Today;

use Emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Emutoday\Announcement;
use Illuminate\Http\Request;
// use Emutoday\Http\Requests\StoreAnnouncementRequest;

use Carbon\Carbon;
use JavaScript;


class AnnouncementController extends Controller
{

  public function __construct(Announcement $announcement)
  {
    $this->announcement = $announcement;
    $this->middleware('auth', ['only'=>['announcementForm','userAnnouncements']]);
  }

  // public function index($id = null)
  public function index($id = null)
  {
    $currentDate = Carbon::now();
    $announcements = $this->announcement->where([
        ['type', '!=', 'hr'],
        ['start_date', '<=', $currentDate],
        ['end_date', '>=', $currentDate],
        ['is_approved', 1],
        ['is_archived', 0 ]
      ])
      ->orderBy('priority','desc')
      ->orderBy('start_date', 'asc')
      ->paginate(12);

      return view('public.announcement.index', compact('announcements', 'id'));
    }

    public function announcementForm(Request $request, Announcement $announcement)
    {
      if (\Auth::check()) {
        // The user is logged in...forward them to the admin form
        return redirect()->action('Admin\AnnouncementController@form');
      } else {
        $user = cas()->user();

        $approveditems = $this->announcement->where([
            ['is_approved', 1],
            ['type', '!=', 'hr'],
            ['submitter', $user]
            ])->get();

        $submitteditems = $this->announcement->where([
            ['is_approved', 0],
            ['type', '!=', 'hr'],
            ['submitter', $user]
            ])->get();

        return view('public.announcement.form', compact('announcement','approveditems','submitteditems'));
      }
    }

    public function userAnnouncements(Announcement $announcement)
    {
      $user = cas()->user();

      if($user){
        $approveditems = $this->announcement->where([
          ['is_approved', 1],
          ['type', '!=', 'hr'],
          ['submitter', $user]
          ])->get();

        $submitteditems = $this->announcement->where([
          ['is_approved', 0],
          ['type', '!=', 'hr'],
          ['submitter', $user]
          ])->get();
      } else {
        return "There was an error. Announcements table could not be loaded";
      }

      if(\Request::ajax()) {
        $view = \View::make('public.announcement.form', compact('announcement', 'approveditems','submitteditems'));
        $view = $view->renderSections();
        return json_encode($view['content-middle']);
      }
    }
  }
