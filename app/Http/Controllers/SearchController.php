<?php

namespace Emutoday\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Emutoday\Http\Requests;
use Emutoday\Helpers\Interfaces\ISearch;

use Emutoday\Story;
use Emutoday\Page;
use Emutoday\Announcement;
use Emutoday\Event;
use Emutoday\Tweet;
use Carbon\Carbon;
use JavaScript;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * @return view
     */
    public function search(Request $request)
    {
        $searchTerm =  $request->input('searchterm');
        $filter = $request->input('filter');
        
        //Pagination properties
        $page = Input::get('page', 1); // Get the current page or default to 1, this is what you miss!
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;
        
        $searhTermWild = $searchTerm  . '*';
        
        if(!$filter || $filter == 'stories' || $filter == 'all'){
            $searchStoryResults = Story::search($searhTermWild, [
                'title' => 50,
                'content' => 35,
                'teaser' => 20, 
                'subtitle' => 10,
            ])->select('title','subtitle','story_type','teaser','id')->get();
        } else {
            $searchStoryResults = array();
        }
        
        if(!$filter || $filter == 'events' || $filter == 'all'){
            $searchEventResults = Event::search($searhTermWild, [
                'title' => 50,
                'description' => 25,
                'location' => 20, 
                'contact_person' => 10,
            ])->select('title','description','submitter','id')->get();
        } else {
            $searchEventResults = array();
        }
        
        if(!$filter || $filter == 'announcements' || $filter == 'all'){
            $searchAnnouncementResults = Announcement::search($searhTermWild, [
                'title' => 50,
                'announcement' => 35
            ])->select('title','announcement','submitter','id')->get();
        } else {
            $searchAnnouncementResults = array();
        }
        
        $allStories = $this->searchProvider->condenseSearch(array($searchStoryResults, $searchEventResults, $searchAnnouncementResults)); 
        
        $numResults = count($allStories);
                
        $storiesPaginated = new LengthAwarePaginator(array_slice($allStories, $offset, $perPage, true), count($allStories), $perPage);
        $storiesPaginated->appends('searchterm', $searchTerm); // keep ?searchterm=term in URL
        $storiesPaginated->setPath('search');
        
        if($filter != null){
            $storiesPaginated->appends('filter', $filter);
        }
        
        return view('public.searchresults', compact('storiesPaginated', 'searchTerm', 'numResults'));
    }

    
}
