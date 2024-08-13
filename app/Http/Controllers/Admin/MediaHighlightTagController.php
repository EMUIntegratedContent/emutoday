<?php

namespace Emutoday\Http\Controllers\Admin;

use Emutoday\MediaHighlightTag;
use Illuminate\Http\Request;

use Emutoday\Http\Requests;
use Emutoday\Helpers\Interfaces\IBug;

use Illuminate\Support\Facades\View;


class MediaHighlightTagController extends Controller
{

    protected $highlight;
    protected $bugService;

    public function __construct(MediaHighlightTag $tag, IBug $bugService)
    {
        $this->tag = $tag;
        $this->bugService = $bugService;

        View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
        View::share('bugEvents', $this->bugService->getUnapprovedEvents());
        View::share('bugStories', $this->bugService->getUnapprovedStories());
        View::share('bugExperts', $this->bugService->getUnapprovedExperts());
        View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
				View::share('bugInsideemuIdeas', $this->bugService->getNewInsideemuIdeas());
    }

    /**
    * Delete the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $tag = $this->tag->findOrFail($id);
        $tagname = $tag->name;
        $tag->delete();
        return back()->with('tag_deleted', 'Tag "' . $tagname . '" was successfully deleted.');
    }

}
