<?php
/**
 *  Functions for the search service. Create by Chris Puzzuoli on 11/16/16.
 */
namespace Emutoday\Helpers;

use Emutoday\Helpers\Interfaces\IBug;
use Emutoday\Announcement;
use Emutoday\Event;
use Emutoday\Story;

class Bug implements IBug{

    public function getUnapprovedAnnouncements() {
        $bugAnnouncements = Announcement::where('is_approved', 0)->orderBy('created_at', 'desc')->get();
        
        return $bugAnnouncements;
    }

    public function getUnapprovedEvents() {
        $bugEvents = Event::where('is_approved', 0)->orderBy('created_at', 'desc')->get();
        
        return $bugEvents;
    }

    public function getUnapprovedStories() {
        $bugStories = Story::where('is_approved', 0)->orderBy('created_at', 'desc')->get();
        
        return $bugStories;
    }

}
