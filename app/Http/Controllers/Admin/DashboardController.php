<?php

namespace Emutoday\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Emutoday\Story;
use Emutoday\Event;
use Emutoday\Announcement;
use Emutoday\User;
use Emutoday\Tweet;
use Emutoday\Helpers\Interfaces\IBug;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    protected $bugService; 
    
    public function __construct(Announcement $announcement, IBug $bugService)
    {
      $this->middleware('auth', ['only'=>'index']);
      
        $this->bugService = $bugService;
        View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
        View::share('bugEvents', $this->bugService->getUnapprovedEvents());
        View::share('bugStories', $this->bugService->getUnapprovedStories());
    }
    
    public function index(Request $request, Story $storys, User $user)
    {
        if (\Auth::check()) {
            // The user is logged in...
            $user = \Auth::user();
        } else {
            if(cas()->isAuthenticated()){
                abort(403, 'You do not have administrative privileges.');
            } else {
                cas()->authenticate();
            }
        }
        
        return view('admin.dashboard');

    }

    public function search(Request $request)
    {
        $searchTerm =  $request->input('searchterm');
        $searchStorys = Story::search($searchTerm)
        ->select('title','subtitle','teaser','id')->paginate(5);
        $searchEvents = Event::search($searchTerm)
        ->select('title','description','location','id')->paginate(5);
        $searchAnnouncements = Announcement::search($searchTerm)
        ->select('title','announcement','id')->paginate(5);

        return view('admin.searchresults', compact('searchTerm', 'searchStorys','searchEvents','searchAnnouncements'));
    }

}
