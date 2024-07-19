<?php

namespace Emutoday\Http\Controllers;

use Emutoday\Imagetype;
use Emutoday\IntcommPost;
use Illuminate\Http\Request;

use Emutoday\Story;
use Emutoday\Page;
use Emutoday\Announcement;
use Emutoday\Event;
use Emutoday\Tweet;
use Carbon\Carbon;
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

  public function __construct(Page $page, Story $story, Announcement $announcement, Event $event, Tweet $tweets, IntcommPost $intcommPost) {
    $this->page = $page;
    $this->story = $story;
    $this->announcement = $announcement;
    $this->event = $event;
    $this->tweets = $tweets;
		$this->intcommPost = $intcommPost;
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

		// Intcomm Hub Post (with small image)
		$intcomm = $this->intcommPost->where('is_hub_post', 1)->with(['images' => function ($query) {
			// Only retrieve the required images for each post (in this case, the 'small' image)
			$query->where('imagetype_id', 27);
		}])->first();

    JavaScript::put([
        'jsis' => 'hi',
        'cdnow' => Carbon::now(),
        'cdstart' => Carbon::now()->subDays(7),
        'cdend' => Carbon::now()->addDays(7),
        'currentPage' => $page
    ]);

    return view('public.hub', compact('page', 'storyImages', 'heroImg', 'barImgs', 'tweets', 'currentStorysBasic', 'currentAnnouncements', 'topAnnouncement', 'events', 'currentStoryImageWithVideoTag', 'currentHRAnnouncements', 'featuredevents', 'emu175StoryImg', 'emu175Dyk', 'intcomm'));

  }

  // Testing mysql procedures 7/18/18
  protected function getSqlProcedureTestByChris() {
    DB::select("CALL get_stories_by_id(1, @emutoday_stories, @news_stories)");
    return DB::select("SELECT @emutoday_stories, @news_stories");

    // SAMPLE OUTPUT
    // array (size=1)
    // 0 =>
    // object(stdClass)[3125]
    //   public '@emutoday_stories' => int 4
    //   public '@news_stories' => int 988
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

  /**
   * Process subscribe form.
   * As of 4/9/23, automatically add the subscriber to the Mailgun list
   */
  public function subscribeForm(Request $request) {
    // Validate, return errors if not valid
    $this->validate($request, [
        'email' => 'required|email',
    ]);

    # Instantiate the client.
    $mgClient = Mailgun::create(env('MAILGUN_SECRET'));
    $mailing_list = 'livemailersubscribers@today.emich.edu';
    $address = $request->email;
    $name = ' ';
    $vars = [];
    $subscribed = 'yes';
    $upsert = 'yes';

    # Issue the call to the client.
    $mgClient->mailingList()->member()->create(
        $mailing_list,
        $address,
        $name,
        $vars,
        $subscribed,
        $upsert
    );

    // Return success to view
    $data = "Thank you, you have subscribed to EMU Today.";
    return view('public.subscribe', compact('data'));
  }
}
