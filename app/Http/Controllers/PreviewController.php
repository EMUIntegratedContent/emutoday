<?php

namespace Emutoday\Http\Controllers;

use Emutoday\InsideemuPost;
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

class PreviewController extends Controller{


	public function __construct(Page $page, Story $story, Magazine $magazine, Event $event, Announcement $announcement, Expert $expert, InsideemuPost $insideemuPost){
		$this->middleware('auth');
		$this->page = $page;
		$this->magazine = $magazine;
		$this->story = $story;
		$this->event = $event;
		$this->announcement = $announcement;
		$this->expert = $expert;
		$this->insideemuPost = $insideemuPost;
	}

	public function goBack($gtype, $stype, $qtype, $id = null){
		$val = 'form';
		$isqueue = strpos($qtype, $val);
		if($isqueue === false){
			$rurl = '/admin/'.$gtype.'/'.$stype.'/'.$qtype;

		}
		else{
			//it's from form
			$qtype = str_replace($val, '', $qtype);
			$rurl = '/admin/'.$qtype.'/'.$gtype.'/'.$stype.'/'.$id.'/edit';
		}

		return redirect($rurl);
	}

	public function story($qtype, $gtype, $stype, Story $story){
		$mainStoryImage = null;
		$mainStoryImages = $story->storyImages()->where('image_type', 'story')->get();
		$fullBannerImage = $story->storyImages()->where('image_type', 'full')->first(); // Added to EMU Today August 2018

		foreach($mainStoryImages as $mainimg){
			if($mainimg->imgtype->type == 'story'){
				$mainStoryImage = $mainimg;
				break;
			}
		}
		$sideFeaturedStorys = null;
		$sideStoryBlurbs = collect();

		$sideStudentStorys = null;
		$sideStudentBlurbs = collect();

		$sideNewsStorys = collect();

		if($story->author_id === 0){
			$authorInfo = $story->user;
		}
		else{
			$authorInfo = $story->author;
		}
		if($stype == 'story' || $stype == 'emutoday' || $stype == 'news' || $stype == 'advisory' || $stype == 'statement' || $stype == 'featurephoto'){
			$sideStoryBlurbs->push($story->storyImages()->where('image_type', 'small')->first());

			return view('preview.story.story', compact('story', 'gtype', 'qtype', 'stype', 'mainStoryImage', 'sideStoryBlurbs', 'sideStudentBlurbs', 'authorInfo', 'fullBannerImage'));

		}
		else if($stype == 'student'){
			$sideStudentBlurbs->push($story->storyImages()->where('image_type', 'small')->first());
			// $sroute = 'student';
			return view('preview.student.story', compact('story', 'gtype', 'qtype', 'stype', 'mainStoryImage', 'sideStoryBlurbs', 'sideStudentBlurbs', 'authorInfo'));


		}
		else if($stype == 'article'){
			$magazine = $story->magazines()->first();
			$mainImage = $story->storyImages()->where('image_type', 'story')->first();
			// dd($magazine);
			$sideStoryBlurbs->push($story->storyImages()->where('image_type', 'small')->first());
			// dd($sideStoryBlurbs);


			return view('preview.magazine.story', compact('magazine', 'story', 'gtype', 'qtype', 'stype', 'mainImage', 'sideStoryBlurbs', 'sideNewsStorys', 'authorInfo'));


		}
		else if($stype == 'external'){
			$currentStorysBasic = $this->story->where('story_type', 'news')->paginate(3);
			$currentAnnouncements = $this->announcement->where('is_approved', 1)->orderBy('priority', 'desc')->paginate(3);
			$events = $this->event->where([
				['is_approved', 1],
				['start_date', '>=', Carbon::now()->startOfDay()]
			])->orderBy('start_date', 'asc')
				->paginate(4);
			$currentStoryImageWithVideoTag = $story->storyImages()->where('image_type', 'small')->first();

			return view('preview.story.external', compact('story', 'gtype', 'qtype', 'stype', 'currentStorysBasic', 'currentAnnouncements', 'events', 'currentStoryImageWithVideoTag'));

		}
	}

	public function hub(Page $page){
		//Set current date to begining of day and end of day
		$currentDateStart = Carbon::now()->startOfDay();
		$currentDateEnd = Carbon::now()->endOfDay();

		$currentStorysBasic = $this->story->where('story_type', 'news')->paginate(3);
		$currentAnnouncements = $this->announcement->where('is_approved', 1)->orderBy('priority', 'desc')->paginate(3);
		$barImgs = collect();
		$heroImg = null;
		$storys = $page->storys()->get();
		foreach($storys as $story){
			if($story->story_type == 'article'){
				if($story->pivot->page_position === 0){
					$heroImg = $story->storyImages()->where('image_type', 'hero')->first();
				}
				else{
					$barImgs[$story->pivot->page_position] = $story->storyImages()->where('image_type', 'small')->first();
				}
			}
			else{
				if($story->pivot->page_position === 0){
					$heroImg = $story->storyImages()->where('image_type', 'front')->first();
				}
				else{
					$barImgs[$story->pivot->page_position] = $story->storyImages()->where('image_type', 'small')->first();
				}
			}
		}

		// Find a special announcement (value of 1000000), if there is one.
		$topAnnouncement = $this->announcement->where([
			['is_approved', 1],
			['is_archived', 0],
			['type', 'general'],
			['start_date', '<=', $currentDateStart],
			['end_date', '>=', $currentDateEnd],
			['priority', 1000000],
		])
			->orderBy('start_date', 'desc')
			->first();

		$allStorysWithVideoTag = Story::whereHas('tags', function ($query){
			$query->where('name', 'video');
		})->where([
			['is_approved', 1],
			['story_type', 'external'],
			['start_date', '>=', Carbon::now()->startOfDay()]
		])
			->with('storyImages')->get();

		if(count($allStorysWithVideoTag) > 0){
			$currentStoryWithVideoTag = $allStorysWithVideoTag->first();
			$currentStoryImageWithVideoTag = $currentStoryWithVideoTag->storyImages()->first();
		}
		else{
			$currentStoryImageWithVideoTag = null;
		}

		$events = $this->event->where([
			['is_approved', 1],
			['start_date', '>=', Carbon::now()->startOfDay()]
		])->orderBy('start_date', 'asc')
			->paginate(4);


		$storyImages = $page->storyImages;

		// Show up to 4 featured events on the front page
		$featuredevents = Event::where([
			['is_approved', 1],
			['mediafile_id', '>', 0],
			['end_date', '>=', date('Y-m-d')]
		])
			->orderBy('start_date', 'asc')
			->orderBy('start_time', 'asc')
			->take(4)->get();

		// EMU's 175th Anniversary Story (temporary for 2024-25)
		$emu175Story = Story::where('is_emu175_hub_story', 1)->first();
		$emu175StoryImg = null;
		if($emu175Story) {
			$emu175StoryImg = $emu175Story->storyImages()->where('image_type', 'emu175')->first();
		}
		// Open the file in resources/emu175_dyk.txt and get 3 random lines
		$emu175DykFile = file(resource_path('emu175_dyk.txt'));
		$emu175Dyk = [];
		if($emu175DykFile) {
			// Shuffle the lines
			shuffle($emu175DykFile);
			// Get the first three unique lines from the shuffled array
			$emu175Dyk = array_slice($emu175DykFile, 0, 3);
		}

		// Insideemu Hub Post (with small image)
		$insideemu = $this->insideemuPost->where('is_hub_post', 1)->with(['images' => function ($query) {
			// Only retrieve the required images for each post (in this case, the 'small' image)
			$query->where('imagetype_id', 28);
		}])->first();

		JavaScript::put([
			'jsis' => 'hi',
			'cdnow' => Carbon::now(),
			'cdstart' => Carbon::now()->subDays(7),
			'cdend' => Carbon::now()->addDays(7),
			'currentPage' => $page
		]);
		return view('preview.hub', compact('page', 'storyImages', 'heroImg', 'barImgs', 'currentStorysBasic', 'currentAnnouncements', 'topAnnouncement', 'events', 'currentStoryImageWithVideoTag', 'featuredevents', 'emu175StoryImg', 'emu175Dyk', 'insideemu'));

	}

	public function student(Story $story){

		$heroImg = $story->storyImages()->where('image_type', 'front')->first();
		$featureImg = $story->storyImages()->where('image_type', 'story')->first();
		$barImgs = collect();
		$barImgs->push($story->storyImages()->where('image_type', 'small')->first());

		return view('preview.student.index', compact('heroImg', 'featureImg', 'barImgs'));
	}

	public function expert($id){
		$expert = $this->expert->findOrFail($id);
		return view('preview.expert', compact('expert'));
	}

	public function magazine(Magazine $magazine){

		$storyImages = $magazine->storyImages();

		$missingArticles = 6;
		foreach($magazine->storys as $story){
			$position = $story->pivot->story_position;
			if($position <= 5){
				$missingArticles--;
			}
		}

		$barImgs = collect();
		$magazineCover = $magazine->mediafiles()->where('type', 'cover')->first();
		if(!$magazineCover || $magazineCover->filename == "" || $magazineCover->is_active == 0){
			flash()->warning('Need to Add Cover Image');
			return redirect()->back();
		}

		$magazineExtra = $magazine->mediafiles()->where('type', 'extra')->first();
		if($magazineExtra->filename == "" || $magazineExtra->is_active == 0){
			flash()->warning('Need to Add Extra  Magazine Image');
			return redirect()->back();
		}

		if($missingArticles > 0){
			flash()->warning('Need to Add '.$missingArticles.' more articles');
			return redirect()->back();
		}


		foreach($magazine->storys()->whereIn('story_position', [0, 1, 2, 3, 4, 5])->get() as $story){
			if($story->pivot->story_position === 0){
				$heroImg = $story->storyImages()->where('image_type', 'front')->first();
			}
			else{
				$barImgs[$story->pivot->story_position] = $story->storyImages()->where('image_type', 'small')->first();
				// $barImgs->push( $story->storyImages()->where('image_type', 'small')->first() );
			}

		}
		return view('preview.magazine.index', compact('magazine', 'storyImages', 'heroImg', 'barImgs', 'magazineCover', 'magazineExtra'));


	}

	public function insideemupost($postId){
		$post = $this->insideemuPost->findOrFail($postId);
		$idea = $post->idea;
		$mainImg = $post->images()->where('imagetype_id', 29)->first();
		return view('preview.insideemu.post', compact('post', 'mainImg', 'idea'));
	}
}
