<?php

namespace Emutoday\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Input;
use Illuminate\Support\Facades\URL;
use Emutoday\Helpers\Interfaces\ISearch;

use Emutoday\Story;
use Emutoday\Announcement;
use Emutoday\Event;
use Emutoday\Expert;
use Emutoday\ExpertCategory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function __construct(Story $story, Announcement $announcement, Event $event, ISearch $searchProvider)
    {
        $this->story = $story;
        $this->announcement = $announcement;
        $this->event = $event;
        $this->searchProvider = $searchProvider;
    }


    /**
     * Execute the search function (uses "Laravel Searchable": https://softonsofa.com/laravel-searchable-the-best-package-for-eloquent/)
     * @param Request $request
     * @return View
     */
    public function search(Request $request)
    {
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
        if( ($filter && $filter == 'magazine') || $isSearchFromMagazine){
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

        return view('public.searchresults', compact('storiesPaginated', 'searchTerm', 'numResults', 'isSearchFromMagazine'));

    }

    /**
     * Eastern Experts Search
     */
    public function expertSearch(Request $request){
        $searchterm = $request->get('q');

        $searchCategory = $request->get('category');

        if($searchterm) {
            $experts = Expert::runSearch($searchterm, $searchCategory);
        } else {
            $experts = Expert::where('is_approved', 1)
                ->whereHas('expertCategories', function($query) use ($searchCategory){
                    $query->where('category', $searchCategory);
                })
                ->orderBy('last_name', 'ASC')
                ->paginate(10);
        }

        $expertCategories = ExpertCategory::orderBy('category', 'asc')->get();

        return view('public.experts.find', ['experts' => $experts, 'expertCategories' => $expertCategories, 'currentCategory' => $searchCategory]);
    }
}
