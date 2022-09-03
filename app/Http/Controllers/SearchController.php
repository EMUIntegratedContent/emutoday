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
        if(!$filter || $filter == 'stories' || $filter == 'all'){
//            // Magazine stories should be filtered by is_approved AND a start date before or on the current date
//            $searchStoryResultsMagazine = Story::search($searchTermWild, [
//                'title' => 50,
//                'content' => 35,
//                'teaser' => 20,
//                'subtitle' => 10,
//            ], false)->select('title','subtitle','story_type','teaser','id','start_date')->where('is_approved', 1)->where('start_date', '<=', date('Y-m-d'))->whereIn('story_type', ['article'])->orderBy('start_date', 'DESC')->get();
//
//            foreach($searchStoryResultsMagazine as $m_story){
//                $searchStoryResults[] = $m_story;
//            }
            $searchStoryResults = array();
            $searchStoryResultsNonMagazine = Story::runSearchNonMagazine($searchTerm);

            foreach($searchStoryResultsNonMagazine as $nm_story){
                $searchStoryResults[] = $nm_story;
            }
        } else {
            $searchStoryResults = array();
        }

        // Event results
        if(!$filter || $filter == 'events' || $filter == 'all'){
//            $searchEventResults = Event::search($searchTermWild, [
//                'title' => 10,
//            ], false)->where('is_approved', 1)->get();
            $searchEventResults = Event::runSearch($searchTerm);
        } else {
            $searchEventResults = array();
        }

//        // Announcement results
        if(!$filter || $filter == 'announcements' || $filter == 'all'){
//            $searchAnnouncementResults = Announcement::search($searchTermWild, [
//                'title' => 50,
//                'announcement' => 35
//            ], false)->where('is_approved', 1)->select('title','announcement','submitter','id')->get();
            $searchAnnouncementResults = Announcement::runSearch($searchTerm);
        } else {
            $searchAnnouncementResults = array();
        }

        // Magazine results (fetch ONLY if user is filtering by magazine OR the search originated from the EMU Magazine site)
        if( ($filter && $filter == 'magazine') || $isSearchFromMagazine){
//            // Magazine stories should be filtered by is_approved AND a start date before or on the current date
//            $searchMagazineResults = Story::search($searchTermWild, [
//                'title' => 50,
//                'content' => 35,
//                'teaser' => 20,
//                'subtitle' => 10,
//            ], false)->select('title','subtitle','story_type','teaser','id','start_date')->where('is_approved', 1)->where('start_date', '<=', date('Y-m-d'))->whereIn('story_type', ['article'])->orderBy('start_date', 'DESC')->get();
            $searchMagazineResults = Story::runSearchMagazine($searchTerm);

        } else {
            $searchMagazineResults = array();
        }

        // Expert results
        if(!$filter || $filter == 'experts' || $filter == 'all'){
//            $searchExpertsResults = Expert::search($searchTermWild, [
//                'first_name' => 50,
//                'last_name' => 50,
//                'display_name' => 50,
//                'title' => 30,
//            ], false)->where('is_approved', 1)->select('id','first_name','last_name','display_name','title')->get();
            $searchExpertsResults = Expert::runSearch($searchTerm);
        } else {
            $searchExpertsResults = array();
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
        // Fields and scores set in Emutoday/Expert model class
        if($searchCategory){
            // Expert::search creates some odd alphebetizing when used with an empty search
            if($searchterm){
              $experts = Expert::search($searchterm)
                              ->where('is_approved', 1)
                              ->whereHas('expertCategories', function($query) use ($searchCategory){
                                  $query->where('category', $searchCategory);
                              })
                              ->orderBy('last_name', 'ASC')
                              ->paginate(10);
            } else {
              $experts = Expert::where('is_approved', 1)
                              ->whereHas('expertCategories', function($query) use ($searchCategory){
                                  $query->where('category', $searchCategory);
                              })
                              ->orderBy('last_name', 'ASC')
                              ->paginate(10);
            }
        } else {
          // Expert::search creates some odd alphebetizing when used with an empty search
          if($searchterm){
            $experts = Expert::search($searchterm)->where('is_approved', 1)->orderBy('last_name', 'ASC')->paginate(10);
          } else {
            $experts = Expert::where('is_approved', 1)->orderBy('last_name', 'ASC')->paginate(10);
          }
        }

        $expertCategories = ExpertCategory::orderBy('category', 'asc')->get();

        return view('public.experts.find', ['experts' => $experts, 'expertCategories' => $expertCategories, 'currentCategory' => $searchCategory]);
    }


}
