<?php

namespace Emutoday\Http\Controllers\Today;

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
                                  ->paginate(8);
                                  // dd($storys->count());
          return view('public.story.index', compact('storys'));

        } else {
            $story = $this->storys->findOrFail($id);
            // $mainStoryImage = $story->storyImages()->ofType('imagemain')->first();
            $mainStoryImage = null;
            $mainStoryImages = $story->storyImages()->where('image_type','story')->get();
            // dd($mainStoryImage);
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
                ])->orderBy('created_at', 'desc')->with(['storyImages'=> function($query) {
                    $query->where('image_type', 'small');
                }])->take(3)->get();
                $sideStoryBlurbs = collect();
                foreach ($sideFeaturedStorys as $sideFeaturedStory) {
                        $sideStoryBlurbs->push($sideFeaturedStory->storyImages()->where('image_type', 'small')->first());
                }


            //Removed Student Side Bar until firther notice
            $sideStudentBlurbs = null;

            //   $sideStudentStorys = $this->storys->where([
            // 		['story_type', 'student'],
            // 		['id', '<>', $id],
            // 		['is_approved', 1],
            // 		])->orderBy('created_at', 'desc')->with(['storyImages'=> function($query) {
            // 			$query->where('image_type', 'small');
            // 		}])->take(3)->get();
              //
            // 		$sideStudentBlurbs = collect();
            // 		foreach ($sideStudentStorys as $sideStudentStory) {
            // 		    $sideStudentBlurbs->push($sideStudentStory->storyImages()->where('image_type', 'small')->first());
            // 		}

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
