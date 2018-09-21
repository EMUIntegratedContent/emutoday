<?php

namespace Emutoday\Http\Controllers\Admin;


use Emutoday\Page;
use Emutoday\Story;
use Emutoday\StoryImage;
use Emutoday\StoryType;

use Illuminate\Http\Request;
use JavaScript;
use Carbon\Carbon;

use Emutoday\Helpers\Interfaces\IBug;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{

    protected $page;
    protected $bugService;

    public function __construct(Page $page, Story $story, StoryImage $storyImage, IBug $bugService)
    {
        $this->page = $page;
        $this->story = $story;
        $this->storyImage = $storyImage;

        $this->bugService = $bugService;
        View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
        View::share('bugEvents', $this->bugService->getUnapprovedEvents());
        View::share('bugStories', $this->bugService->getUnapprovedStories());
        View::share('bugExperts', $this->bugService->getUnapprovedExperts());
        View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
    }

    public function index()
    {
        $currentDate = Carbon::now();

        $pages_notready_current = Page::where([
            ['is_ready', 0],
            ['end_date', '>=' ,$currentDate ]
            ])->orderBy('start_date', 'desc')->paginate(10, ["*"], 'notready_current');

        $pages_ready_current = Page::where([
            ['is_ready', 1],
            ['end_date', '>=' ,$currentDate ]
            ])->orderBy('start_date', 'desc')->paginate(10, ["*"], 'ready_current');

        $pages_ready_past = Page::where([
            ['is_ready', 1],
            ['end_date', '<' ,$currentDate ]
            ])->orderBy('start_date', 'desc')->paginate(10, ["*"], 'ready_past');

        $pages_notready_past = Page::where([
            ['is_ready', 0],
            ['end_date', '<' ,$currentDate ]
            ])->orderBy('start_date', 'desc')->paginate(10, ["*"], 'notready_past');
        $pgselect = Page::has('storys', '>=', 5)->select('id', 'template','start_date', 'end_date')->get();

        $pgs = collect($pgselect)->toJson();

        JavaScript::put([
            'pgselect' => $pgselect,
            'pgs' => $pgs

        ]);

        return view('admin.page.index',compact('pages_ready_current','pages_notready_current','pages_ready_past','pages_notready_past', 'pgs'));
    }

    public function form(Page $page)
    {
        $stypes  = collect(StoryType::select('name','shortname')->get());

        return view('admin.page.form', compact('page', 'stypes'));
    }

    public function store(Request $request)
    {

    }

    public function edit($id)
    {
        $page = $this->page->findOrFail($id);
        $stypes  = collect(StoryType::select('name','shortname')->get());
        return view('admin.page.form', compact('page', 'stypes'));
    }

    public function update(Request $request, $id)
    {
        
    }

    public function delete(Request $request)
    {
        $page = $this->page->findOrFail($request->get('id'));
        $page->delete();
        flash()->warning('Page has been deleted.');
        return redirect(route('admin_page_index'));//->with('status', 'Story has been deleted.');
    }

    public function destroy($id)
    {
        $page = $this->page->findOrFail($id);
        $page->delete();
        flash()->warning('Page has been deleted.');
        return redirect(route('admin_page_index'));//->with('status', 'Story has been deleted.');
    }
}
