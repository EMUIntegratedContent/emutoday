<?php

namespace Emutoday\Http\Controllers\Admin;

use Emutoday\Helpers\Interfaces\IBug;
use Emutoday\Http\Requests\StoreIntcommPostRequest;
use Emutoday\Http\Requests\UpdateIntcommPostRequest;
use Emutoday\Http\Controllers\Controller;
use Emutoday\IntcommPost;
use Illuminate\Support\Facades\View;

class IntcommController extends Controller
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
     * Display a listing of the resource.
     */
    public function dashboard()
    {
			return view('admin.intcomm.dashboard');
    }
}
