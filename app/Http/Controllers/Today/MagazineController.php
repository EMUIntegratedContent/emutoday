<?php

namespace Emutoday\Http\Controllers\Today;

use Emutoday\Http\Controllers\Controller;

use Illuminate\Support\Collection;
use Emutoday\Magazine;
use Emutoday\Story;
use Carbon\Carbon;
use JavaScript;

class MagazineController extends Controller
{
    protected $magazine;

    public function __construct(Magazine $magazine, Story $story)
    {
        $this->magazine = $magazine;
        $this->story = $story;

    }
    public function index($year = null, $season = null)
    {
        $currentDateTime = Carbon::now();
        $currentIssue = false;

        if ($year == null) {

          $magazine = $this->magazine->where([
              ['is_published', 1],
              ['is_archived', 0],
          ])->whereDate('start_date', '<', $currentDateTime)->orderBy('start_date', 'DESC')->first();

            $currentIssue = true;
        } else {
          if ($season == null) {
            $magazine = $this->magazine->where([
                ['year', $year],
            ])->whereDate('start_date', '<', $currentDateTime)->orderBy('start_date', 'DESC')->first();
          } else {
            $magazine = $this->magazine->where([
                ['year', $year],
                ['season', $season],
            ])->whereDate('start_date', '<', $currentDateTime)->orderBy('start_date', 'DESC')->first();
          }

        }

        // If there are no magazines published and set to begin at a past date
        if(!$magazine){
            return $this->noCurrentIssue();
        }

        JavaScript::put([
            'jsis' => 'hi',
        ]);
        // $magazine = $this->magazines->findOrFail($id);
        // $storyImages = $this->magazines->storyImages();

        $storyImages = $this->magazine->storyImages();
        $barImgs = collect();
                $magazineCover = $magazine->mediafiles()->where('type','cover')->first();
                $magazineExtra = $magazine->mediafiles()->where('type','extra')->first();


        if ($currentIssue){

          foreach ($magazine->storys as $story) {
                if ($story->pivot->story_position === 0) {
                    $heroImg = $story->storyImages()->where('image_type', 'front')->first();
                } else {
                    $barImgs->push( $story->storyImages()->where('image_type', 'small')->first() );
                }

            }
          return view('public.magazine.index', compact('magazine', 'storyImages', 'heroImg', 'barImgs', 'magazineCover','magazineExtra'));
        } else {
          foreach ($magazine->storys as $story) {
              if ($story->pivot->story_position === 0) {
                  $barImgs->push( $story->storyImages()->where('image_type', 'small')->first() );
              } else {
                  $barImgs->push( $story->storyImages()->where('image_type', 'small')->first() );
              }

          }


          return view('public.magazine.issue', compact('magazine', 'storyImages', 'barImgs','magazineCover','magazineExtra'));

        }
        //

    }


    public function issue($year = null, $season = null)
    {
        $currentDateTime = Carbon::now();
        if ($year == null) {
          $magazine = $this->magazine->where([
              ['is_published', 1],
              ['is_archived', 0],
          ])->whereDate('start_date', '<', $currentDateTime)->orderBy('start_date', 'DESC')->first();
        } else {
          $magazine = $this->magazine->where([
              ['year', $year],
              ['season', $season],
          ])->whereDate('start_date', '<', $currentDateTime)->orderBy('start_date', 'DESC')->first();
        }

        if(!$magazine){
            return $this->noCurrentIssue();
        }

        $storyImages = $this->magazine->storyImages();
        $barImgs = collect();


        foreach ($magazine->storys as $story) {
            if ($story->pivot->story_position === 0) {
                $barImgs->push( $story->storyImages()->where('image_type', 'small')->first() );
            } else {
                $barImgs->push( $story->storyImages()->where('image_type', 'small')->first() );
            }

        }
        JavaScript::put([
            'jsis' => 'hi',
        ]);

                $magazineCover = $magazine->mediafiles()->where('type','cover')->first();
                $magazineExtra = $magazine->mediafiles()->where('type','extra')->first();
        // $magazine = $this->magazines->findOrFail($id);
        // $storyImages = $this->magazines->storyImages();
        return view('public.magazine.issue', compact('magazine', 'storyImages', 'barImgs','magazineCover','magazineExtra'));

    }
    public function article($id)
    {
        $story = $this->story->findOrFail($id);

        if($story->magazines){
            $magazine = $story->magazines->first();
        }

        //$story = $magazine->storys()->where('id', $id)->first();
        $mainImage = $story->storyImages()->where('image_type', 'story')->first();
                // dd($mainImage);
        $sideFeaturedStorys = $this->story
                                  ->where([
                                    ['story_type', 'article'],
                                    ['id', '<>', $id],
                                                                        ['is_approved', 1],
                                  ])
                                  /*
                                  ->orWhere([
                                    ['story_type', 'student'],
                                    ['id', '<>', $id],
                                                                        ['is_approved', 1],
                                  ])
                                  */
                                  ->orderBy('created_at', 'desc')->with('storyImages')->take(3)->get();

        $sideStoryBlurbs = collect();
            foreach ($sideFeaturedStorys as $sideFeaturedStory) {
                $sideStoryBlurbs->push($sideFeaturedStory
                                                                ->storyImages()
                                                                ->where('image_type', 'small')
                                                                ->first());
            }


        $sideNewsStorys = $this->story
                            ->where([
                              ['story_type', 'news'],
                              ['id', '<>', $id],
                                                            ['is_approved', 1],
                                ])->orderBy('created_at', 'desc')->take(3)->get();

        return view('public.magazine.article', compact('magazine','story', 'mainImage','sideStoryBlurbs','sideNewsStorys'));

    }

    /**
     * Display this view when there are no current, unarchived issues found.
     *
     * @return view
     */
    private function noCurrentIssue(){
        return view('public.magazine.noissues');
    }

    public function archives(){
        return view('public.magazine.archives');
    }
}
