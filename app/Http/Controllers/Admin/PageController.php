<?php

namespace Emutoday\Http\Controllers\Admin;


use Emutoday\Page;
use Emutoday\Story;
use Emutoday\StoryImage;

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
            ])->orderBy('start_date', 'asc')->get();

        $pages_ready_current = Page::where([
            ['is_ready', 1],
            ['end_date', '>=' ,$currentDate ]
            ])->orderBy('start_date', 'asc')->get();

        $pages_ready_past = Page::where([
            ['is_ready', 1],
            ['end_date', '<' ,$currentDate ]
            ])->orderBy('start_date', 'asc')->get();

        $pages_notready_past = Page::where([
            ['is_ready', 0],
            ['end_date', '<' ,$currentDate ]
            ])->orderBy('start_date', 'asc')->get();
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

        return view('admin.page.form', compact('page'));
    }

    public function store(Request $request)
    {
      switch($request->template){
        case 'home-emutoday': $request->template_elements = 5; break;
        // case 'home-student': $request->template_elements = 5; break;
        // case 'home-news': $request->template_elements = 5; break;
        default: return "Could not identify page template: ( $request->template ) is not a known page template"; break;
      }

      $page = $this->page->create(
        [ 'user_id' => auth()->user()->id ] + ['template_elements' => $request->template_elements] + $request->only('template', 'uri', 'start_date', 'end_date')
      );

      flash()->success('Page has been created.');
      return redirect(route('admin_page_edit', $page->id));//->with('status', 'Story has been created.');
    }

    public function edit($id)
    {
        $page = $this->page->findOrFail($id);
            $storys = Story::where([
                                ['story_type','!=' ,'news'],
                                ['is_approved',1],
                    ])->with('images')->orderBy('id', 'desc')->get();
            $storyimgs = $this->storyImage->where([
                                                ['group','!=','news'],
                                                ['image_type', 'small'],
                                                ])
                                                ->orderBy('updated_at', 'desc')->get();
                $connectedStorys = $page->storys()->get();

                $original_story_ids = $connectedStorys->pluck('id');
        JavaScript::put([
            'mainrecordid' => $page->id,
            'original_story_ids'=> $original_story_ids,
            'storysonpage' => $connectedStorys->toArray(),
            'storyimgs' => $storyimgs->toArray(),
            'storys' => $storys->toArray()
        ]);
        return view('admin.page.edit', compact('page', 'storys','storyimgs'));
    }

    public function update(Request $request, $id)
    {
        $page = $this->page->findOrFail($id);

        $storyIDString =  $request->get('story_ids');
        $storyIDarray = explode(",", $storyIDString);
        $storyIDarrayCount = count($storyIDarray);
        $storyIDsForPivotArray = [];

         for ($x = 0; $x < $storyIDarrayCount; $x++) {
            // $attributes = array()
             //$pushval = $storyIDarray[$x] . " => ['page_position' => " . intval($x) . "]";
             $namedKey = $storyIDarray[$x];
             if($namedKey != 0) {
                 $attributeArray = array();
                 $attributeArray["page_position"] = intval($x);
                 $attributeArray["note"] = 'some notes';
                 $storyIDsForPivotArray[intval($namedKey)] = $attributeArray;
             }
             //array_push($storyIDsForPivotArray, $pushval);
            }
             if (empty($storyIDsForPivotArray)) {
                 $page->is_ready = 0;
             } else {
                 if(count($storyIDsForPivotArray) < $page->template_elements){
                     $page->is_ready = 0;
                 } else {
                     $page->is_ready = 1;
                 }
             $page->storys()->sync($storyIDsForPivotArray);
            }

        $page->uri = $request->uri;
        $page->start_date = \Carbon\Carbon::parse($request->start_date);
        $page->end_date = \Carbon\Carbon::parse($request->end_date);

        $page->save();

        flash()->success('Page has been updated.');
        return redirect(route('admin_page_edit', $page->id));
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
