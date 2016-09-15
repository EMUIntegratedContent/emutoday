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
  protected $announcements;

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


}
