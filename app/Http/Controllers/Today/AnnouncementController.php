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
  // protected $announcements; // Disabled because I wanted to use POST request

  public function __construct(Announcement $announcement)
  {
    $this->announcement = $announcement;
    // $this->middleware('auth', ['except'=>'index']);
  }

  // public function index($id = null)
  public function index($id = null)
  {
    $currentDate = Carbon::now();
    $announcements = $this->announcement->where([
      ['is_approved', 1],
      ['start_date', '<=', $currentDate],
      ['end_date', '>=', $currentDate]
      ])->paginate(8);
      return view('public.announcement.index', compact('announcements', 'id'));

    }

    public function announcementForm(Announcement $announcement)
    {

      if (\Auth::check()) {
        // The user is logged in...
        $user = \Auth::user();
      } else {
        // return 'Need to Connect to LDAP';
        //    return redirect()->route('emich-login');
        return redirect()->guest('/login');
      }


      $cdate = Carbon::now();
      $cdate_format = $cdate->format('m-d-Y');
      JavaScript::put([
        'jsis'=> 'hi',
        'currentDate' => $cdate_format
      ]);


      // $announcements = $user->announcements;//$this->announcement->where('is_approved', '0')->orderBy('start_date', 'dsc')->paginate(4);
      $approveditems = $user->announcements()->where('is_approved', '1')->get();;

      $submitteditems = $user->announcements()->where('is_approved', '0')->get();
      // dd($submitteditems);
      return view('public.announcement.form', compact('announcement','approveditems','submitteditems'));


      // return redirect(route('emu-today.announcement.edit',$announcement->id ));
      // return view('public.announcement.edit', compact('announcement'));
    }

    public function store(Announcement $announcement, Request $request)
    { // Method to validate and store announcements submission
      $this->validate($request, [ // validate takes rules to test against, see laravel documentation for rules
        // errors array is global. if validation fails, errors array will be populated
        'title' => 'required|min:10|max:50',
        'announcement' => 'required|min:20|max:255',
        'link_txt' => 'required',
        'link' => 'required',
        'email_link_txt' => 'required',
        'email_link' => 'required|email',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
      ]);

      $write = $announcement->create([ // Is there a less verbose method to drop values in db table?
        'is_approved' => '0',
        'is_promoted' => '0',
        'title' => $request->title,
        'announcement' => $request->announcement,
        'link_txt' => $request->link_txt,
        'link' => $request->link,
        'email_link_txt' => $request->email_link_txt,
        'email_link' => $request->email_link,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
      ]);

      if($write){
        // Did the database write happen successfully? Return success
        $success = true; return view('public.announcement.form', compact('success'));
      } else {
        // Laravel will display a SQL EXCEPTION error page. So this will naver return.
        return 'Write to database failed.';
      }
    }
  }
