<?php

namespace Emutoday\Http\Controllers\Admin;

use Emutoday\Expert;
use Illuminate\Http\Request;

use Emutoday\Story;
use Emutoday\Event;
use Emutoday\Announcement;
use Emutoday\User;
use Emutoday\Tweet;
use Emutoday\Helpers\Interfaces\IBug;
use Illuminate\Support\Facades\View;

//use Analytics;

// For search
use Illuminate\Pagination\LengthAwarePaginator;
use Emutoday\Helpers\Interfaces\ISearch;
use Illuminate\Support\Facades\Request as Input;
use Illuminate\Support\Facades\URL;

class DashboardController extends Controller{
	protected $bugService;

	public function __construct(Announcement $announcement, IBug $bugService, ISearch $searchProvider){
		$this->middleware('auth', ['only' => 'index']);

		$this->searchProvider = $searchProvider; // for search
		$this->bugService = $bugService;
		View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
		View::share('bugEvents', $this->bugService->getUnapprovedEvents());
		View::share('bugStories', $this->bugService->getUnapprovedStories());
		View::share('bugExperts', $this->bugService->getUnapprovedExperts());
		View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
		View::share('bugInsideemuIdeas', $this->bugService->getNewInsideemuIdeas());
	}

	public function index(Request $request, Story $storys, User $user){
		if(\Auth::check()){
			// The user is logged in...
			$user = \Auth::user();
		}
		else{
			if(cas()->isAuthenticated()){
				abort(403, 'You do not have administrative privileges.');
			}
			else{
				cas()->authenticate();
			}
		}

		$mostVisitedLast3Months = null;
		$topReferrersLast3Months = null;

		return view('admin.dashboard', compact('mostVisitedLast3Months', 'topReferrersLast3Months'));
	}

	public function search(Request $request, ISearch $searchProvider){
		$referer = URL::previous();

		$searchTerm = $request->input('searchterm');
		$filter = $request->input('filter');

		$isSearchFromMagazine = strpos($referer, '/magazine');  //determine if the search originates from the EMU Magazine page

		//Pagination properties
		$page = Input::get('page', 1); // Get the current page or default to 1, this is what you miss!
		$perPage = 10;
		$offset = ($page * $perPage) - $perPage;

		// Story results
		$searchStoryResults = array();
		if(!$filter || $filter == 'stories' || $filter == 'all'){
			$searchStoryResultsNonMagazine = Story::runSearchNonMagazine($searchTerm);

			foreach($searchStoryResultsNonMagazine as $nm_story){
				$searchStoryResults[] = $nm_story;
			}
		}

		// Event results
		$searchEventResults = array();
		if(!$filter || $filter == 'events' || $filter == 'all'){
			$searchEventResults = Event::runSearch($searchTerm);
		}

		// Announcement results
		$searchAnnouncementResults = array();
		if(!$filter || $filter == 'announcements' || $filter == 'all'){
			$searchAnnouncementResults = Announcement::runSearch($searchTerm);
		}

		// Magazine results (fetch ONLY if user is filtering by magazine OR the search originated from the EMU Magazine site)
		$searchMagazineResults = array();
		if(($filter && $filter == 'magazine') || $isSearchFromMagazine){
			// Magazine stories should be filtered by is_approved AND a start date before or on the current date
			$searchMagazineResults = Story::runSearchMagazine($searchTerm);
		}

		// Expert results
		$searchExpertsResults = array();
		if(!$filter || $filter == 'experts' || $filter == 'all'){
			$searchExpertsResults = Expert::runSearch($searchTerm);
		}

		$allStories = $this->searchProvider->condenseSearch(array($searchStoryResults, $searchEventResults, $searchAnnouncementResults, $searchMagazineResults, $searchExpertsResults));

		$numResults = count($allStories);

		$storiesPaginated = new LengthAwarePaginator(array_slice($allStories, $offset, $perPage, true), count($allStories), $perPage);
		$storiesPaginated->appends('searchterm', $searchTerm); // keep ?searchterm=term in URL
		$storiesPaginated->setPath('search');

		if($filter != null){
			$storiesPaginated->appends('filter', $filter);
		}

		return view('admin.searchresults', compact('storiesPaginated', 'searchTerm', 'numResults', 'isSearchFromMagazine', 'filter'));
	}

}
