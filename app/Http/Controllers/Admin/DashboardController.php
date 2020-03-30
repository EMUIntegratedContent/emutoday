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
use Analytics;

// For search
use Illuminate\Pagination\LengthAwarePaginator;
use Emutoday\Helpers\Interfaces\ISearch;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class DashboardController extends Controller
{
    protected $bugService;

    public function __construct(Announcement $announcement, IBug $bugService,  ISearch $searchProvider)
    {
      $this->middleware('auth', ['only'=>'index']);

        $this->searchProvider = $searchProvider; // for search
        $this->bugService = $bugService;
        View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
        View::share('bugEvents', $this->bugService->getUnapprovedEvents());
        View::share('bugStories', $this->bugService->getUnapprovedStories());
        View::share('bugExperts', $this->bugService->getUnapprovedExperts());
        View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
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

        $mostVisitedLast3Months = null;
        $topReferrersLast3Months = null;

        return view('admin.dashboard', compact('mostVisitedLast3Months', 'topReferrersLast3Months'));
    }

    public function search(Request $request, ISearch $searchProvider)
    {
        $referer = URL::previous();

        $searchTerm = $request->input('searchterm');
        $filter = $request->input('filter');

        //Pagination properties
        $page = Input::get('page', 1); // Get the current page or default to 1, this is what you miss!
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        $searchTermWild = '*' . str_replace(' ', '*', $searchTerm)  . '*'; // Astrix to search anywhere in string.

        // Story results
        if(!$filter || $filter == 'stories' || $filter == 'all'){
            $searchStoryResults = Story::search($searchTermWild, [
                'title' => 50,
                'content' => 35,
                'teaser' => 20,
                'subtitle' => 10,
            ], false)->select('title','subtitle','story_type','teaser','id')->get();
        } else {
            $searchStoryResults = array();
        }

        // Event results
        if(!$filter || $filter == 'events' || $filter == 'all'){
            $searchEventResults = Event::search($searchTermWild, [
                'title' => 10,
            ], false)->get();
        } else {
            $searchEventResults = array();
        }

        // Announcement results
        if(!$filter || $filter == 'announcements' || $filter == 'all'){
            $searchAnnouncementResults = Announcement::search($searchTermWild, [
                'title' => 50,
                'announcement' => 35
            ], false)->select('title','announcement','submitter','id')->get();
        } else {
            $searchAnnouncementResults = array();
        }

        // Magazine results (fetch ONLY if user is filtering by magazine OR the search originated from the EMU Magazine site)
        if( ($filter && $filter == 'magazine')){
            $allStoryResults = Story::search($searchTermWild, [
                'title' => 50,
                'content' => 35,
                'teaser' => 20,
                'subtitle' => 10,
            ], false)->select('title','subtitle','story_type','teaser','id')->get();

            $searchMagazineResults = array();

            foreach($allStoryResults as $article){
                if($article->story_type == 'article'){
                    $searchMagazineResults[] = $article;
                }
            }
        } else {
            $searchMagazineResults = array();
        }

        //$storiesPaginated = $this->searchRepo->search();
        // $numResults = count($storiesPaginated);

        //return view('public.searchresults2', compact('storiesPaginated', 'searchTerm', 'numResults'));


        $allStories = $this->searchProvider->condenseSearch(array($searchStoryResults, $searchEventResults, $searchAnnouncementResults, $searchMagazineResults));

        $numResults = count($allStories);

        $storiesPaginated = new LengthAwarePaginator(array_slice($allStories, $offset, $perPage, true), count($allStories), $perPage);
        $storiesPaginated->appends('searchterm', $searchTerm); // keep ?searchterm=term in URL
        $storiesPaginated->setPath('search');

        if($filter != null){
            $storiesPaginated->appends('filter', $filter);
        }

        // return view('admin.searchresults', compact('searchTerm', 'searchStorys','searchEvents','searchAnnouncements'));
        return view('admin.searchresults', compact('storiesPaginated', 'searchTermWild', 'searchTerm', 'numResults'));
    }

}
