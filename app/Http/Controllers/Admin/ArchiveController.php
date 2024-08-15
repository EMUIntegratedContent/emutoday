<?php

namespace Emutoday\Http\Controllers\Admin;


use Emutoday\Event;
use Emutoday\Announcement;

use Illuminate\Http\Request;

use Emutoday\Http\Requests;
use Emutoday\StoryType;

use Emutoday\Helpers\Interfaces\IBug;
use Illuminate\Support\Facades\View;

class ArchiveController extends Controller
{
    protected $bugService;

    public function __construct(IBug $bugService)
    {
        $this->bugService = $bugService;
        View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
        View::share('bugEvents', $this->bugService->getUnapprovedEvents());
        View::share('bugStories', $this->bugService->getUnapprovedStories());
        View::share('bugExperts', $this->bugService->getUnapprovedExperts());
        View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
				View::share('bugInsideemuIdeas', $this->bugService->getNewInsideemuIdeas());
    }

    public function queue($entityType) {
        $storyTypes  = collect(StoryType::select('name','shortname')->orderBy('display_order', 'asc')->get());
        return view('admin.archive.queue', compact('entityType', 'storyTypes'));
    }

    /**
    * Process deletion of an archived item.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function delete($id)
    {
        return view('admin.archive.queue');
    }


}
