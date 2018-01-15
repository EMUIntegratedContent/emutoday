<?php

namespace Emutoday\Http\Controllers;

use Illuminate\Http\Request;

use Emutoday\Http\Requests;
use Emutoday\Story;
use Emutoday\User;
use Emutoday\Author;
use Emutoday\Event;
use Emutoday\Expert;
use Emutoday\ExpertCategory;
use Emutoday\Page;
use Emutoday\Magazine;
use Emutoday\Tweet;
use Emutoday\Announcement;
use Emutoday\StoryImage;

use Carbon\Carbon;
use JavaScript;


/*

Route::get('{stype}/{story}', ['as' => 'preview_story', 'uses' => 'PreviewController@story']);
Route::get('hub/{page}', ['as' => 'preview_hub', 'uses' => 'PreviewController@hub']);
Route::get('magazine/{magazine}', ['as' => 'preview_magazine', 'uses' => 'PreviewController@magazine']);



*/
class PreviewController extends Controller
{


  public function __construct(Page $page, Story $story, Magazine $magazine, Event $event, Announcement $announcement, Expert $expert)
  {
      $this->page = $page;
      $this->magazine = $magazine;
      $this->story = $story;
      $this->event = $event;
      $this->announcement = $announcement;
      $this->expert = $expert;
  }

  public function goBack($gtype, $stype,$qtype, $id = null){
      $val = 'form';
      $isqueue = strpos($qtype,$val);
      if($isqueue === false){
          $rurl = '/admin/'.$gtype.'/'.$stype.'/'.$qtype;

      } else {
          //it's from form
          $qtype = str_replace($val, '', $qtype);
          $rurl = '/admin/'.$qtype.'/'.$gtype.'/'.$stype.'/'.$id.'/edit';
      }

      return redirect($rurl);
  }

          public function story($qtype,$gtype, $stype, Story $story)
          {
          $mainStoryImage = null;
          $mainStoryImages = $story->storyImages()->where('image_type','story')->get();

          foreach($mainStoryImages as $mainimg){
              if($mainimg->imgtype->type == 'story') {
                  $mainStoryImage = $mainimg;
                  break;
              }
          }
          $sideFeaturedStorys = null;
          $sideStoryBlurbs = collect();

          $sideStudentStorys = null;
          $sideStudentBlurbs = collect();

          $sideNewsStorys = collect();

          if ($story->author_id === 0) {
              $authorInfo = $story->user;
          } else {
              $authorInfo = $story->author;
          }
          if($stype == 'story' || $stype == 'emutoday' || $stype == 'news' || $stype == 'advisory' || $stype == 'statement' || $stype == 'featurephoto'){
              $sideStoryBlurbs->push($story->storyImages()->where('image_type', 'small')->first());

              return view('preview.story.story', compact('story','gtype', 'qtype', 'stype', 'mainStoryImage', 'sideStoryBlurbs','sideStudentBlurbs', 'authorInfo'));

          } else if($stype == 'student'){
              $sideStudentBlurbs->push($story->storyImages()->where('image_type', 'small')->first());
              // $sroute = 'student';
              return view('preview.student.story', compact('story', 'gtype', 'qtype', 'stype','mainStoryImage', 'sideStoryBlurbs','sideStudentBlurbs', 'authorInfo'));


          } else if($stype == 'article'){
              $magazine = $story->magazines()->first();
              $mainImage = $story->storyImages()->where('image_type','story')->first();
              // dd($magazine);
              $sideStoryBlurbs->push($story->storyImages()->where('image_type', 'small')->first());
              // dd($sideStoryBlurbs);



          return view('preview.magazine.story', compact('magazine','story', 'gtype', 'qtype', 'stype', 'mainImage','sideStoryBlurbs','sideNewsStorys', 'authorInfo'));


          } else if($stype == 'external') {
              $currentStorysBasic = $this->story->where('story_type', 'news')->paginate(3);
              $currentAnnouncements = $this->announcement->where('is_approved', 1)->orderBy('priority','desc')->paginate(3);
              $events = $this->event->where([
                      ['is_approved',1],
                      ['start_date', '>=', Carbon::now()->startOfDay()]
                      ])->orderBy('start_date', 'asc')
                      ->paginate(4);
              $tweets = Tweet::where('approved',1)->orderBy('created_at','desc')->take(4)->get();
              $currentStoryImageWithVideoTag = $story->storyImages()->where('image_type','small')->first();

              return view('preview.story.external', compact('story', 'gtype', 'qtype', 'stype','currentStorysBasic', 'currentAnnouncements', 'events','tweets','currentStoryImageWithVideoTag'));

          } else {

          }
      }

  public function hub(Page $page)
  {

      $currentStorysBasic = $this->story->where('story_type', 'news')->paginate(3);
      $currentAnnouncements = $this->announcement->where('is_approved', 1)->orderBy('priority','desc')->paginate(3);
      $barImgs = collect();
      $storys = $page->storys()->get();
      foreach ($storys as $story) {

          if($story->story_type == 'article'){
              if ($story->pivot->page_position === 0) {
                  $heroImg = $story->storyImages()->where('image_type', 'hero')->first();
              } else {
                  $barImgs[$story->pivot->page_position] = $story->storyImages()->where('image_type', 'small')->first();
              }
          } else {
              if ($story->pivot->page_position === 0) {
                  $heroImg = $story->storyImages()->where('image_type', 'front')->first();
              } else {
                  $barImgs[$story->pivot->page_position] = $story->storyImages()->where('image_type', 'small')->first();
              }
          }
      }

      $allStorysWithVideoTag = Story::whereHas('tags', function ($query) {
          $query->where('name', 'video');
      })->where([
          ['is_approved',1],
          ['story_type', 'external'],
          ['start_date', '>=', Carbon::now()->startOfDay()]
      ])
      ->with('storyImages')->get();

      if(count($allStorysWithVideoTag)> 0) {
          $currentStoryWithVideoTag = $allStorysWithVideoTag->first();
          $currentStoryImageWithVideoTag = $currentStoryWithVideoTag->storyImages()->first();
      } else {
          $currentStoryImageWithVideoTag = null;
      }

      $events = $this->event->where([
              ['is_approved',1],
              ['start_date', '>=', Carbon::now()->startOfDay()]
              ])->orderBy('start_date', 'asc')
              ->paginate(4);


      $storyImages = $page->storyImages;
      $tweets = Tweet::where('approved',1)->orderBy('created_at','desc')->take(4)->get();

      JavaScript::put([
          'jsis' => 'hi',
          'cdnow' => Carbon::now(),
          'cdstart' => Carbon::now()->subDays(7),
          'cdend' => Carbon::now()->addDays(7),
          'currentPage' => $page
      ]);
      return view('preview.hub', compact('page', 'storyImages', 'heroImg', 'barImgs', 'currentStorysBasic', 'currentAnnouncements', 'events','tweets','currentStoryImageWithVideoTag'));

  }

  public function student(Story $story)
      {

              $heroImg = $story->storyImages()->where('image_type', 'front')->first();
              $featureImg = $story->storyImages()->where('image_type', 'story')->first();
              $barImgs = collect();
              $barImgs->push( $story->storyImages()->where('image_type', 'small')->first() );

          return view('preview.student.index', compact('heroImg', 'featureImg','barImgs'));
      }

      public function expert($id)
      {
        $expert = $this->expert->findOrFail($id);
        return view('preview.expert', compact('expert'));
      }

      public function magazine(Magazine $magazine)
      {

          $storyImages = $magazine->storyImages();

          $articleTotal = 6;
          $articleCount = count($magazine->storys);

          $barImgs = collect();
          $magazineCover = $magazine->mediafiles()->where('type','cover')->first();
          if(!$magazineCover || $magazineCover->filename == "" || $magazineCover->is_active == 0)
          {
              flash()->warning('Need to Add Cover Image');
              return redirect()->back();
          }

          $magazineExtra = $magazine->mediafiles()->where('type','extra')->first();
          if($magazineExtra->filename == "" || $magazineExtra->is_active == 0)
          {
              flash()->warning('Need to Add Extra  Magazine Image');
              return redirect()->back();
          }

          if ($articleCount < $articleTotal){
              $articlesNeeded = $articleTotal - $articleCount;
              flash()->warning('Need to Add '. $articlesNeeded .' more articles');
              return redirect()->back();
          }


          foreach ($magazine->storys as $story) {
                      if ($story->pivot->story_position === 0) {
                              $heroImg = $story->storyImages()->where('image_type', 'front')->first();
                      } else {
                          $barImgs[$story->pivot->story_position] = $story->storyImages()->where('image_type', 'small')->first();
                          // $barImgs->push( $story->storyImages()->where('image_type', 'small')->first() );
                      }

              }
          return view('preview.magazine.index', compact('magazine', 'storyImages', 'heroImg', 'barImgs', 'magazineCover','magazineExtra'));


      }
}
