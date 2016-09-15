<?php

namespace Emutoday\Http\Controllers;

use Illuminate\Http\Request;

use Emutoday\Http\Requests;

use Emutoday\Story;
use Emutoday\Page;
use Emutoday\Announcement;
use Emutoday\Event;
use Emutoday\Tweet;
use Carbon\Carbon;
use JavaScript;

class SearchController extends Controller
{


    public function __construct(Story $story, Announcement $announcement, Event $event)

    {

        $this->story = $story;
        $this->announcement = $announcement;
        $this->event = $event;

    }



    public function search(Request $request)
    {
        $searchTerm =  $request->input('searchterm');
        $searhTermWild = $searchTerm  . '*';
        $searchStoryResults = Story::search($searhTermWild, false)->select('title','subtitle','story_type','teaser','id')->paginate(10);
        $searchEventResults = Event::search($searhTermWild, false)->select('title','description','submitter','id')->paginate(10);
        $searchAnnouncementResults = Announcement::search($searhTermWild, false)->select('title','announcement','submitter','id')->paginate(10);

        return view('public.searchresults', compact('searchTerm', 'searchStoryResults','searchEventResults','searchAnnouncementResults'));
    }

    
}
