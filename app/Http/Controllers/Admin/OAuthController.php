<?php
/**
 * IMPORTANT! EMUToday uses Laravel Passport to manage most OAuth configuration.
 * Most routes are pre-configured by passport.
 * Documentation: https://laravel.com/docs/5.4/passport
 */
namespace Emutoday\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Emutoday\Helpers\Interfaces\IBug;
use Illuminate\Support\Facades\View;

class OAuthController extends Controller
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
    }

    /**
     * List all OAuth Clients of the currently logged-in user.
     */
    public function listClients() {
        return view('admin.oauth.list');
    }
}
