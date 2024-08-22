<?php

namespace Emutoday\Http\Controllers;

use Emutoday\Imagetype;
use Emutoday\InsideemuPost;
use Emutoday\Services\MailgunSubscribeService;
use Illuminate\Http\Request;

use Emutoday\Story;
use Emutoday\Page;
use Emutoday\Announcement;
use Emutoday\Event;
use Emutoday\Tweet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use JavaScript;
use Illuminate\Support\Facades\DB;
use Mailgun\Mailgun;

class MainController extends Controller
{
  protected $pages;
  //how many news stories and announcements to show on hub
  protected $recordLimitNews = 4;
  protected $recordLimitAnnouncements = 4;
  protected $recordLimitEvents = 4;
  protected $recordLimitHR = 4;
	protected $mailgunSvc;

  public function __construct(Page $page, Story $story, Announcement $announcement, Event $event, Tweet $tweets, InsideemuPost $insideemuPost, MailgunSubscribeService $mailgunSvc) {
    $this->page = $page;
    $this->story = $story;
    $this->announcement = $announcement;
    $this->event = $event;
    $this->tweets = $tweets;
		$this->insideemuPost = $insideemuPost;
		$this->mailgunSvc = $mailgunSvc;
  }

  public function index() {
    //Set current date to begining of day and end of day
    $currentDateStart = Carbon::now()->startOfDay();
    $currentDateEnd = Carbon::now()->endOfDay();

    $currentTime = Carbon::now();

    $page = $this->page->where([
        ['is_ready', 1],
        ['is_archived', 0],
        ['start_date', '<=', $currentTime],
        ['end_date', '>=', $currentTime]
    ])->orderBy('start_date', 'desc')->first();

    //in case no new page has been set
    //pull last one to expire
    if (is_null($page)) {
      $page = $this->page->where([
          ['is_ready', 1],
          ['is_archived', 0],
          ['start_date', '<=', $currentDateStart]
      ])->orderBy('start_date', 'desc')->first();
    }

    $currentStorysBasic = $this->story->where([
        ['is_approved', 1],
        ['is_archived', 0],
        ['start_date', '<=', $currentTime],
        ['priority', '>', 0]
    ])
        ->whereIn('story_type', ['story', 'news', 'statement', 'advisory', 'external'])
        ->orderBy('priority', 'desc')
        ->orderBy('start_date', 'asc')
        ->take($this->recordLimitNews)->with('storyImages')->get();

    $currentAnnouncements = $this->announcement->where([
        ['is_approved', 1],
        ['is_archived', 0],
        ['type', 'general'],
        ['start_date', '<=', $currentDateStart],
        ['end_date', '>=', $currentDateEnd],
        ['priority', '<', 1000000] // don't count special announcements.
    ])
        ->orderBy('priority', 'desc')
        ->orderBy('start_date', 'asc')
        ->take($this->recordLimitAnnouncements)->get();

    //make sure there are enough announcements with a priority over 0
    //if not requery with out priority limitation
    if ($currentAnnouncements->count() < $this->recordLimitAnnouncements) {
      $currentAnnouncements = $this->announcement->where([
          ['is_approved', 1],
          ['is_archived', 0],
          ['type', 'general'],
          ['start_date', '<=', $currentDateStart],
          ['end_date', '>=', $currentDateEnd],
      ])
          ->orderBy('priority', 'desc')
          ->orderBy('start_date', 'asc')
          ->take($this->recordLimitAnnouncements)->get();
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

    $events = $this->event->where([
        ['is_approved', 1],
        ['priority', '>', 0],
        ['end_date', '>=', $currentDateStart]
    ])
        ->orderBy('priority', 'desc')
        ->orderBy('start_date', 'desc')
        ->take($this->recordLimitEvents)->get();

    $currentHRAnnouncements = $this->announcement->where([
        ['is_approved', 1],
        ['is_archived', 0],
        ['type', 'hr'],
        ['start_date', '<=', $currentDateStart],
        ['end_date', '>=', $currentDateEnd],
        ['priority', '>', 0]
    ])
        ->orderBy('priority', 'desc')
        ->orderBy('start_date', 'asc')
        ->take($this->recordLimitHR)->get();

    //make sure there are enough announcements with a priority over 0
    //if not requery with out priority limitation
    if ($currentHRAnnouncements->count() < $this->recordLimitHR) {
      $currentHRAnnouncements = $this->announcement->where([
          ['is_approved', 1],
          ['is_archived', 0],
          ['type', 'hr'],
          ['start_date', '<=', $currentDateStart],
          ['end_date', '>=', $currentDateEnd]
      ])
          ->orderBy('priority', 'desc')
          ->orderBy('start_date', 'asc')
          ->take($this->recordLimitHR)->get();
    }

    $barImgs = collect();

    if (!is_null($page)) {
      $storys = $page->storys()->get();
      foreach ($storys as $story) {
        if ($story->pivot->page_position === 0) {
          // IMPORTANT TO HAVE 'emutoday_front' FOR 'article' TYPE STORY WITH HIGHER 'id' THAN 'article_front'
          if ($story->story_type == 'article') {
            $heroImg = $story->storyImages()->where('image_type', 'hero')->orderBy('id', 'desc')->first();
          } else {
            $heroImg = $story->storyImages()->where('image_type', 'front')->orderBy('id', 'desc')->first();
          }
        } else {
          $barImgs[$story->pivot->page_position] = $story->storyImages()->where('image_type', 'small')->first();
        }
      }
      $storyImages = $page->storyImages;
    } else {
      $storyImages = null;
    }

    $allStorysWithVideoTag = Story::whereHas('tags', function ($query) {
      $query->where('name', 'video');
    })->where([
        ['is_approved', 1],
        ['story_type', 'external'],
        ['start_date', '>=', Carbon::now()]
    ])
        ->with('storyImages')->get();

    if (count($allStorysWithVideoTag) > 0) {
      $currentStoryWithVideoTag = $allStorysWithVideoTag->first();
      $currentStoryImageWithVideoTag = $currentStoryWithVideoTag->storyImages()->first();
    } else {
      $currentStoryImageWithVideoTag = null;
    }

    $tweets = [];

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

    return view('public.hub', compact('page', 'storyImages', 'heroImg', 'barImgs', 'tweets', 'currentStorysBasic', 'currentAnnouncements', 'topAnnouncement', 'events', 'currentStoryImageWithVideoTag', 'currentHRAnnouncements', 'featuredevents', 'emu175StoryImg', 'emu175Dyk', 'insideemu'));

  }

  public function main($story_type, $id) {
    $story = $this->story->findOrFail($id);
    $mainStoryImage = $story->storyImages()->where('image_type', 'story')->first();

    $sideStorysFeatured = $this->story->where([
        ['story_type', 'story'],
        ['id', '<>', $id],
        ['is_approved', 1],
    ])
        ->orderBy('start_date', 'desc')
        ->orderBy('priority', 'desc')
        ->take(3)->get();

    // Remove All reference to Student until Further notice
    $sideStorysStudent = null;

    JavaScript::put([
        'jsis' => 'hi',
        'cdnow' => Carbon::now(),
        'cdstart' => Carbon::now()->subDays(7),
        'cdend' => Carbon::now()->addDays(7),
        'cstory' => $story
    ]);
    return view('public.story.story', compact('story', 'mainStoryImage', 'sideStorysFeatured', 'sideStorysStudent'));

  }


  public function search(Request $request) {
    $searchTerm = $request->input('searchterm');
    $searhTermWild = $searchTerm . '*';
    $searchStoryResults = Story::search($searhTermWild, false)->select('title', 'subtitle', 'story_type', 'teaser', 'id')->paginate(10);
    $searchEventResults = Event::search($searhTermWild, false)->select('title', 'description', 'submitter', 'id')->paginate(10);
    $searchAnnouncementResults = Announcement::search($searhTermWild, false)->select('title', 'announcement', 'submitter', 'id')->paginate(10);

    return view('public.searchresults', compact('searchTerm', 'searchStoryResults', 'searchEventResults', 'searchAnnouncementResults'));
  }

  public function forTheMediaIndex() {
    return view('public.forthemedia');
  }

  /**
   * Process Feedback form
   */
  public function feedbackForm(Request $request) {
    // Validate, return errors if not valid
    $this->validate($request, [
        'email' => 'required|email',
        'comments' => 'required'
    ]);

    // Who is sending feedback?
    $person = !empty($request->fname . $request->lname) ? $request->fname . ' ' . $request->lname : $request->email;

    // Send feeback to emu_today
    $to = "emu_today@emich.edu";
    $subject = $person . " has sent feedback:\n\n";
    $message = $person . " has sent feedback:\n\n" .
        $request->comments . "\n\n";
    $headers = 'From: ' . $request->email . "\r\n" .
        'Reply-To: ' . $request->email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    mail($to, $subject, $message, $headers);

    // Return success to view
    $data = 'Thank you, we apprieciate your feedback!';
    return view('public.feedback', compact('data'));
  }

	public function subscribeForm() {
		return view('public.subscribe');
	}

	/**
	 * Send an email via Mailgun to the user to confirm their subscription to EMU Today
	 * @param Request $request
	 */
  public function subscribe(Request $request) {
		$email = $request->input('email');
		$name = $request->input('name');
		$this->validate($request, [
			'email' => 'required|email',
		]);

		try{
			$this->mailgunSvc->sendConfirmationEmail($email, 'Please confirm your subscription to EMU Today', $name);
			$data = ['type' => 'success', 'msg' => 'Please check your email to confirm your subscription. If you do not see the email after a few minutes, please check your spam folder.'];
		} catch (\Exception $e){
			Log::error($e->getMessage());
			$data = ['type' => 'error', 'msg' => 'There was an error while trying to add you to the subscriber list. Please try again later.'];
		}

		return redirect()->route('subscribe')->with('data', $data);
  }

	/**
	 * Handle the confirmation of a subscription to EMU Today
	 */
	public function confirmSubscribe (Request $request) {
		$c = $request->get('c') !== null ? $this->mailgunSvc->sanitizeInputs($request->get('c')) : null;
		$e = $request->get('e') !== null ? $this->mailgunSvc->sanitizeEmail($request->get('e')) : null;
		$n = $request->get('n') !== null ? $this->mailgunSvc->sanitizeInputs($request->get('n')) : null;

		if (isset($c) && isset($e)&& isset($n) ){
			$a = $this->mailgunSvc->checkConfirmationHash($e, $c);
			if($a){
				$addToList = $this->mailgunSvc->addMemberToList($e, $n);
				if($addToList['success']){
					$data = ['type' => 'success', 'msg' => $addToList['message']];
				}
				else{
					$data = ['type' => 'error', 'msg' => $addToList['message']];
				}
			}
			else{
				$data = ['type' => 'error', 'msg' => 'There was an error while trying to add you to the subscriber list. Please try again later.'];
			}
		} else {
			$data = ['type' => 'error', 'msg' => 'There was an error while trying to add you to the subscriber list. Please try again later.'];
		}

		return redirect()->route('subscribe')->with('data', $data);
	}
}
