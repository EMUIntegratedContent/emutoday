<?php

namespace Emutoday\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Emutoday\Story;
use Emutoday\Event;
use Emutoday\Announcement;
use Emutoday\User;
use Emutoday\Tweet;

class DashboardController extends Controller
{
    public function index(Story $storys, User $user)
    {
    //    $tweets = Tweet::orderBy('created_at','desc')->paginate(5);
      //  $tweetsApproved = emutoday\Tweet::where('approved',1)->orderBy('created_at','desc')->take(5)->get();

        // $storys = $storys->orderBy('updated_at', 'desc')->take(5)->get();
        // $users = $users->whereNotNull('last_login_at')->orderBy('last_login_at', 'desc')->take(5)->get();
        //flash()->info("");
        //        return view('admin.dashboard', compact('tweets'));
        if (\Auth::check()) {
            // The user is logged in...
            $user = \Auth::user();
        } else {
        // return 'Need to Connect to LDAP';
            return redirect()->route('emich-login');
        }
        $cas_user = cas()->user();

        // dd($user->id . '------'.$cas_user);
        
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
