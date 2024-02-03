<?php

namespace Emutoday\Http\Controllers\Admin;
use Emutoday\Helpers\Interfaces\IBug;
use Illuminate\Support\Facades\View;

class EMU175Controller extends Controller
{
    protected IBug $bugService;

    public function __construct(IBug $bugService)
    {

        $this->bugService = $bugService;
        View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
        View::share('bugEvents', $this->bugService->getUnapprovedEvents());
        View::share('bugStories', $this->bugService->getUnapprovedStories());
        View::share('bugExperts', $this->bugService->getUnapprovedExperts());
        View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
    }

    /**
    	* @return \Illuminate\Contracts\View\View
		 */
    public function index()
    {
			return view('admin.emu175.index');
    }
}
