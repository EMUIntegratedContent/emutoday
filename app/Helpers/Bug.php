<?php
/**
 *  Functions for the search service. Create by Chris Puzzuoli on 11/16/16.
 */
namespace Emutoday\Helpers;

use Emutoday\Helpers\Interfaces\IBug;
use Emutoday\Announcement;
use Emutoday\Event;
use Emutoday\InsideemuIdea;
use Emutoday\Story;
use Emutoday\Expert;
use Emutoday\ExpertMediaRequest;

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

    public function getUnapprovedExperts() {
        $bugExperts = Expert::where('is_approved', 0)->whereRaw('created_at = updated_at')->orderBy('created_at', 'desc')->get();

        return $bugExperts;
    }

    public function getNewExpertMediaRequests() {
        $bugExpertMediaRequests = ExpertMediaRequest::where('is_acknowledged', 0)->orderBy('created_at', 'desc')->get();

        return $bugExpertMediaRequests;
    }

		public function getNewInsideemuIdeas() {
				$bugInsideemuIdeas = InsideemuIdea::where('admin_status', 'New')->whereNotNull('submitted_at')->where('archived', 0)->orderBy('submitted_at', 'desc')->get();

				return $bugInsideemuIdeas;
		}

}
