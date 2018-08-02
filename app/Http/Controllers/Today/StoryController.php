<?php

namespace Emutoday\Http\Controllers\Today;

use Illuminate\Http\Request;
use Emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Emutoday\Story;
use Emutoday\StoryImage;
use Emutoday\Imagetype;
use Carbon\Carbon;
use JavaScript;


class StoryController extends Controller
{
    protected $storys;

    public function __construct(Story $storys, StoryImage $storyImage, Imagetype $imagetype)
    {

        $this->storys = $storys;
                $this->storyImage = $storyImage;
                $this->imagetype = $imagetype;
    }


    public function story(Request $request, $stype, $id = null)
    {
      $newsAdvisoryStatementFilter = $request->get('filter');
      $currentDate = Carbon::now();
        if ($id == null) {
          if(!$newsAdvisoryStatementFilter){
            $storys = $this->storys->where('story_type', 'story')
                                    ->where([
                                        ['start_date', '<=', $currentDate], // start_date has past
                                        ['is_approved', 1],
                                        ['is_archived', 0]
                                    ])
                                    ->orWhere('story_type', 'news')
                                    ->where([
                                        ['start_date', '<=', $currentDate], // start_date has past
                                        ['is_approved', 1],
                                        ['is_archived', 0]
                                    ])
                                    ->orWhere('story_type', 'advisory')
                                    ->where([
                                        ['start_date', '<=', $currentDate], // start_date has past
                                        ['is_approved', 1],
                                        ['is_archived', 0]
                                    ])
                                    ->orWhere('story_type', 'statement')
                                    ->where([
                                        ['start_date', '<=', $currentDate], // start_date has past
                                        ['is_approved', 1],
                                        ['is_archived', 0]
                                    ])
                                    ->orderBy('start_date', 'desc')
                                    ->paginate(12);
          } else {
            $storys = $this->storys->where([
                                        ['story_type', $newsAdvisoryStatementFilter],
                                        ['start_date', '<=', $currentDate], // start_date has past
                                        ['is_approved', 1],
                                        ['is_archived', 0]
                                    ])
                                    ->orderBy('start_date', 'desc')
                                    ->paginate(12);
          }
          return view('public.story.index', compact('storys', 'newsAdvisoryStatementFilter'));

        } else {
        // dd($stype . 'story==== '.$id );
        if ($stype == 'article'){

            $rurl = '/magazine/article/'.$id;
            return redirect($rurl);
        } else {
            $story = $this->storys->findOrFail($id);

            $mainStoryImage = null;
            $mainStoryImages = $story->storyImages()->where('image_type','story')->get();
            $addThisImage = $story->storyImages()->where('image_type','social')->first();

            foreach($mainStoryImages as $mainimg){
                if($mainimg->imgtype->type == 'story') {
                    $mainStoryImage = $mainimg;
                    break;
                }
            }
            $sideFeaturedStorys = $this->storys->where([
              ['story_type', 'story'],
              ['id', '<>', $id],
              ['is_approved', 1],
              ['start_date', '<=', $currentDate],
              ])->orderBy('created_at', 'desc')->whereHas('storyImages', function($query){
                  $query->where('image_type', '=', 'small');
              })->limit(5)->get();
              $sideStoryBlurbs = collect();
              foreach ($sideFeaturedStorys as $sideFeaturedStory) {
                      if ($sideFeaturedStory->storyImages()->where('image_type', 'small')->first()){ // redundant if
                              $sideStoryBlurbs->push($sideFeaturedStory->storyImages()->where('image_type', 'small')->first());
                      }
              }

            //Removed Student Side Bar until firther notice
            $sideStudentBlurbs = null;

            $viewfolder = ($stype == 'news' || $stype == 'statement' || $stype == 'advisory')? 'story': $stype;
            JavaScript::put([
                    'jsis' => 'hi',
                    'mainStoryImage' => $mainStoryImage,
                    'addThisImage' => $addThisImage,
                    'sidestudentblurbs' => $sideStudentBlurbs,
                    'sideStoryBlurbs' => $sideStoryBlurbs,
                    ]);
                $storyview = 'public.'.$viewfolder.'.story';

          // This news story view
          return view($storyview, compact('story', 'addThisImage', 'mainStoryImage', 'sideStoryBlurbs','sideStudentBlurbs'));
        }
    }

    }
    public function index($id = null)
    {
        if ($id == null) {
          $storys = $this->storys->where('story_type', 'story')
                                  ->orWhere('story_type', 'news')
                                  ->where([
                                      ['is_approved', 1],
                                      ['is_archived', 0]
                                  ])
                                  ->orderBy('start_date', 'desc')
                                  ->paginate(12);
                                  // dd($storys->count());
          return view('public.story.index', compact('storys'));

        } else {
            $story = $this->storys->findOrFail($id);

            $mainStoryImage = null;
            $mainStoryImages = $story->storyImages()->where('image_type','story')->get();

            foreach($mainStoryImages as $mainimg){
                if($mainimg->imgtype->type == 'story') {
                    $mainStoryImage = $mainimg;
                    break;
                }
            }
            $sideFeaturedStorys = $this->storys->where([
              ['story_type', 'story'],
              ['id', '<>', $id],
              ['is_approved', 1],
              ['start_date', '<=', date('Y-m-d')],
              ])->orderBy('created_at', 'desc')->whereHas('storyImages', function($query){
                  $query->where('image_type', '=', 'small');
              })->limit(3)->get();
              $sideStoryBlurbs = collect();
              foreach ($sideFeaturedStorys as $sideFeaturedStory) {
                      if ($sideFeaturedStory->storyImages()->where('image_type', 'small')->first()){ // redundant if
                              $sideStoryBlurbs->push($sideFeaturedStory->storyImages()->where('image_type', 'small')->first());
                      }
              }

            //Removed Student Side Bar until firther notice
            $sideStudentBlurbs = null;

            JavaScript::put([
                    'jsis' => 'hi',
                    'mainStoryImage' => $mainStoryImage,
                    'sidestudentblurbs' => $sideStudentBlurbs,
                    'sideStoryBlurbs' => $sideStoryBlurbs,
                    ]);
          return view('public.story.story', compact('story', 'mainStoryImage', 'sideStoryBlurbs','sideStudentBlurbs'));
        }

    }

}
