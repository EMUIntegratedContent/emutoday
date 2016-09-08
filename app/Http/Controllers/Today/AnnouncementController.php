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
    $this->middleware('auth', ['except'=>'index']);
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

}
