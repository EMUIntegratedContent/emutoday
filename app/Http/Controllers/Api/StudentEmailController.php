<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\StudentEmail;
use Emutoday\StudentMailinglist;
use Emutoday\Http\Resources\StudentEmailResource;
use Emutoday\Http\Resources\InsideemuPostResource;
use Emutoday\InsideemuPost;
use Emutoday\Story;
use Emutoday\User;
use Emutoday\Event;
use Emutoday\Announcement;
use Emutoday\Imagetype;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as Input;

use League\Fractal\Manager;
use League\Fractal;

use Emutoday\Today\Transformers\FractalEventTransformerModelFull;
use Emutoday\Today\Transformers\FractalStoryTransformerModel;
use Emutoday\Today\Transformers\FractalAnnouncementTransformerModel;

class StudentEmailController extends ApiController
{
  protected $studentEmail;
  protected $insideemuPost;

  function __construct(StudentEmail $studentEmail, InsideemuPost $insideemuPost) {
    $this->studentEmail = $studentEmail;
    $this->insideemuPost = $insideemuPost;
  }

  /**
   * Get the specified student email
   */
  public function edit(StudentEmail $studentEmail) {
    return $this->setStatusCode(200)
      ->respondUpdatedWithData('Got student email.', StudentEmailResource::make($studentEmail));
  }

  /**
   * Store a new student email
   */
  public function store(Request $request) {
    $validationRules = [
        'title' => 'required|min:10',
        'send_at' => 'nullable|date_format:Y-m-d H:i:s'
    ];

    $validation = \Validator::make(Input::all(), $validationRules);

    if ($validation->fails()) {
      return $this->setStatusCode(422)
          ->respondWithError($validation->errors()->getMessages());
    }

    if ($validation->passes()) {
      $email = new StudentEmail;

      $sendAt = null;
      if ($request->get('send_at') != null) {
        $sendAt = \Carbon\Carbon::parse($request->get('send_at'));
      }

      $email->title = $request->get('title');
      $email->subheading = $request->get('subheading', null);
      $email->is_approved = $request->get('is_approved', 0);
      $email->send_at = $sendAt;
      $email->exclude_events = $request->get('exclude_events', 0);
      $email->exclude_insideemu = $request->get('exclude_insideemu', 0);

      if ($email->save()) {
        $this->syncRelationships($email, $request);

        // Sync recipients
        $recipientIds = array();
        foreach ($request->get('recipients') as $recipient) {
          $recipientIds[] = $recipient['id'];
        }
        $email->recipients()->sync($recipientIds);

        // Analyze email for completeness and set is_ready flag
        $this->isEmailReady($email);

        return $this->setStatusCode(200)
          ->respondUpdatedWithData('Student email has been created.', StudentEmailResource::make($email));
      }
    }
  }

  /**
   * Update the specified student email
   */
  public function update(Request $request, $id) {
    $email = $this->studentEmail->findOrFail($id);

    $validationRules = [
        'title' => 'required|min:10',
        'send_at' => 'nullable|date_format:Y-m-d H:i:s'
    ];

    $validation = \Validator::make(Input::all(), $validationRules);

    if ($validation->fails()) {
      return $this->setStatusCode(422)
          ->respondWithError($validation->errors()->getMessages());
    }

    if ($validation->passes()) {
      $sendAt = null;
      if ($request->get('send_at')) {
        $sendAt = \Carbon\Carbon::parse($request->get('send_at'));
      }

      $email->title = $request->get('title');
      $email->subheading = $request->get('subheading', null);
      $email->is_approved = $request->get('is_approved', 0);
      $email->send_at = $sendAt;
      $email->exclude_events = $request->get('exclude_events', 0);
      $email->exclude_insideemu = $request->get('exclude_insideemu', 0);

      $this->syncRelationships($email, $request);

      // Sync recipients
      $recipientIds = array();
      foreach ($request->get('recipients') as $recipient) {
        $recipientIds[] = $recipient['id'];
      }
      $email->recipients()->sync($recipientIds);

      if ($email->save()) {
        // Analyze email for completeness and set is_ready flag
        $this->isEmailReady($email);

        return $this->setStatusCode(200)
          ->respondUpdatedWithData('Student email has been updated.', StudentEmailResource::make($email));
      }
    }
  }

  /**
   * Clone an existing student email (same as store() except exclude recipients, send_at, approve.
   * Include id of original email as clone_student_email_id).
   */
  public function cloneEmail(Request $request) {
    $validationRules = [
        'title' => 'required|min:10',
        'send_at' => 'nullable|date_format:Y-m-d H:i:s'
    ];

    $validation = \Validator::make(Input::all(), $validationRules);

    if ($validation->fails()) {
      return $this->setStatusCode(422)
          ->respondWithError($validation->errors()->getMessages());
    }

    if ($validation->passes()) {
      $email = new StudentEmail;

      $email->title = $request->input('title');
      $email->subheading = $request->input('subheading', null);
      $email->exclude_events = $request->input('exclude_events', 0);
      $email->exclude_insideemu = $request->input('exclude_insideemu', 0);
      $email->clone_student_email_id = $request->input('id'); // mark from which email this one was cloned

      if ($email->save()) {
        $this->syncRelationships($email, $request);

        return $this->setStatusCode(200)
          ->respondUpdatedWithData('Student email successfully cloned.', StudentEmailResource::make($email));
      }
    }
  }

  /**
   * Sync the content sections (featured, more news, announcements, events, campus life) of a student email.
   */
  private function syncRelationships(StudentEmail $email, Request $request) {
    // Sync announcements
    $announcementCount = 0;
    $announcementIds = array();
    foreach ($request->input('announcements') as $announcement) {
      $announcementIds[$announcement['id']] = ['order' => $announcementCount];
      $announcementCount++;
    }
    $email->announcements()->sync($announcementIds);

    // Sync events (What's Happening)
    $eventCount = 0;
    $eventIds = array();
    foreach ($request->input('events') as $event) {
      $eventIds[$event['id']] = ['order' => $eventCount];
      $eventCount++;
    }
    $email->events()->sync($eventIds);

    // Sync the single featured story (a Story OR a Campus Life post)
    $email->mainstories()->detach(); // removes the single featured pivot row (shared table)
    $mainStories = $request->input('mainStories', []);
    if (!empty($mainStories)) {
      $featured = $mainStories[0]; // student emails have exactly one featured item
      if (($featured['group'] ?? null) == 'insideemu_post') {
        $email->maininsideemuposts()->attach($featured['id']);
      } else {
        $email->mainstories()->attach($featured['id']);
      }
    }

    // Sync More News (side stories)
    $otherStoryCount = 0;
    $otherStoryIds = array();
    foreach ($request->input('otherStories') as $otherStory) {
      $otherStoryIds[$otherStory['id']] = ['order' => $otherStoryCount];
      $otherStoryCount++;
    }
    $email->stories()->sync($otherStoryIds);

    // Sync Campus Life (Inside EMU posts)
    $insideemuPostCount = 0;
    $postIds = array();
    foreach ($request->input('insideemuPosts') as $insidePost) {
      $postIds[$insidePost['postId']] = ['order' => $insideemuPostCount];
      $insideemuPostCount++;
    }
    $email->insideemuPosts()->sync($postIds);
  }

  /**
   * Delete a student email.
   *
   * @param int $id
   * @return array
   */
  public function destroy($id) {
    $email = $this->studentEmail->findOrFail($id);
    $email->delete();
    return $this->setStatusCode(200)->respond('Student email successfully deleted!');
  }

  /**
   * Featured stories require an image with type 'email' to be present with the story.
   * (Reuses the same content pool as the staff email builder.)
   */
  public function getMainEmailReadyStories(Request $request, $fromDate = null, $toDate = null) {
    $email_imagetypes = Imagetype::select('id')->where('type', 'email')->get(); //get email imagetype

    if ($fromDate && !$toDate) {
      $storyQuery = Story::whereHas('storyImages', function ($query) use ($email_imagetypes) {
        $query->whereIn('imagetype_id', $email_imagetypes);
      })
        ->where([['start_date', '>=', $fromDate], ['is_archived', 0], ['is_approved', 1], ['is_ready', 1]]);

      $postsQuery = InsideemuPost::whereHas('images', function($query) use ($email_imagetypes) {
        $query->whereIn('imagetype_id', $email_imagetypes);
      })
        ->where([['start_date', '>=', $fromDate]]);
    } else if ($fromDate && $toDate) {
      $storyQuery = Story::whereHas('storyImages', function ($query) use ($email_imagetypes) {
        $query->whereIn('imagetype_id', $email_imagetypes);
      })
        ->where([['start_date', '>=', $fromDate], ['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->whereBetween('start_date', array($fromDate, $toDate));

      $postsQuery = InsideemuPost::whereHas('images', function($query) use ($email_imagetypes) {
        $query->whereIn('imagetype_id', $email_imagetypes);
      })
        ->where([['start_date', '>=', $fromDate]])->whereBetween('start_date', array($fromDate, $toDate));
    } else {
      $storyQuery = Story::whereHas('storyImages', function ($query) use ($email_imagetypes) {
        $query->whereIn('imagetype_id', $email_imagetypes);
      })->where([['is_archived', 0], ['is_approved', 1], ['is_ready', 1]]);

      $postsQuery = InsideemuPost::whereHas('images', function($query) use ($email_imagetypes) {
        $query->whereIn('imagetype_id', $email_imagetypes);
      })
        ->where([['start_date', '>=', date('Y-m-d')]]);
    }

    $stories = $storyQuery->orderBy('start_date', 'desc')->get();
    $posts = $postsQuery->orderBy('start_date', 'desc')->get();

    // Combine the collections
    $combined = $stories->merge($posts);

    // Sort the merged collection by start_date
    $sortedCombined = $combined->sortByDesc('start_date');

    // Reset the keys on the sorted collection
    $sortedCombined = $sortedCombined->values()->all();

    return $this->setStatusCode(200)
      ->respondUpdatedWithData('Got stories with email photo', \Emutoday\Http\Resources\EmailPostStoryResource::collection($sortedCombined));
  }

  /**
   * More News stories do not require an email image.
   */
  public function getAllEmailReadyStories(Request $request, $fromDate = null, $toDate = null) {
    if ($fromDate && !$toDate) {
      $stories = Story::where([['start_date', '>=', $fromDate], ['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->orderBy('start_date', 'desc')->get();
    } else if ($fromDate && $toDate) {
      $stories = Story::where([['start_date', '>=', $fromDate], ['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->whereBetween('start_date', array($fromDate, $toDate))->orderBy('start_date', 'desc')->get();
    } else {
      $stories = Story::where([['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->orderBy('start_date', 'desc')->get();
    }

    $fractal = new Manager();
    $resource = new Fractal\Resource\Collection($stories->all(), new FractalStoryTransformerModel);

    return $this->setStatusCode(200)
        ->respondUpdatedWithData('Got stories.', $fractal->createData($resource)->toArray());
  }

  /**
   * Events (What's Happening at EMU).
   */
  public function getAllEmailReadyEvents(Request $request, $fromDate = null, $toDate = null) {
    if ($fromDate && !$toDate) {
      $events = Event::where([['start_date', '>=', $fromDate], ['is_approved', 1]])->orderBy('start_date', 'desc')->get();
    } elseif ($fromDate && $toDate) {
      $events = Event::where([['start_date', '>=', $fromDate], ['is_approved', 1]])->whereBetween('start_date', array($fromDate, $toDate))->orderBy('start_date', 'desc')->get();
    } else {
      // By default, only get future events
      $events = Event::where([['start_date', '>=', date('Y-m-d')], ['is_approved', 1]])->orderBy('start_date', 'desc')->get();
    }

    $fractal = new Manager();
    $resource = new Fractal\Resource\Collection($events->all(), new FractalEventTransformerModelFull);

    return $this->setStatusCode(200)
        ->respondUpdatedWithData('Got events.', $fractal->createData($resource)->toArray());
  }

  /**
   * Campus Life posts (Inside EMU).
   */
  public function getAllEmailReadyInsideemuPosts(Request $request, $fromDate = null, $toDate = null): \Illuminate\Http\JsonResponse {
    // Only want posts that are live
    if ($fromDate && !$toDate) {
      $posts = $this->insideemuPost->where([['start_date', '>=', $fromDate]])->orderBy('start_date', 'desc')->get();
    } elseif ($fromDate && $toDate) {
      $posts = $this->insideemuPost->where([['start_date', '>=', $fromDate]])->whereBetween('start_date', array($fromDate, $toDate))->orderBy('start_date', 'desc')->get();
    } else {
      // By default, only get future posts
      $posts = $this->insideemuPost->where([['start_date', '>=', date('Y-m-d')]])->orderBy('start_date', 'desc')->get();
    }

    $resource = InsideemuPostResource::collection($posts);

    return $this->setStatusCode(200)
      ->respondUpdatedWithData('Got Campus Life posts.', $resource);
  }

  /**
   * Announcements.
   */
  public function getAllEmailReadyAnnouncements(Request $request, $fromDate = null, $toDate = null) {
    if ($fromDate && !$toDate) {
      $announcements = Announcement::where([['start_date', '>=', $fromDate], ['is_approved', 1]])->orderBy('start_date', 'desc')->get();
    } elseif ($fromDate && $toDate) {
      $announcements = Announcement::where([['start_date', '>=', $fromDate], ['is_approved', 1]])->whereBetween('start_date', array($fromDate, $toDate))->orderBy('start_date', 'desc')->get();
    } else {
      // By default, only get future announcements
      $announcements = Announcement::where([['start_date', '>=', date('Y-m-d')], ['is_approved', 1]])->orderBy('start_date', 'desc')->get();
    }

    $fractal = new Manager();
    $resource = new Fractal\Resource\Collection($announcements->all(), new FractalAnnouncementTransformerModel);

    return $this->setStatusCode(200)
        ->respondUpdatedWithData('Got announcements.', $fractal->createData($resource)->toArray());
  }

  /**
   * Get all student email recipients.
   */
  public function getAllRecipients(Request $request) {
    $recipients = StudentMailinglist::where('show', 1)->orderBy('email_address', 'asc')->get();

    return $this->setStatusCode(200)
        ->respondUpdatedWithData('Got recipients.', $recipients);
  }

  /**
   * Save a previously-unlisted student email recipient.
   */
  public function saveRecipient(Request $request) {
    $validation = \Validator::make(Input::all(), [
        'email_address' => 'required|email|unique:student_mailinglists,email_address']);

    if ($validation->fails()) {
      return $this->setStatusCode(422)
          ->respondWithError($validation->errors()->getMessages());
    }

    if ($validation->passes()) {
      $recipient = new StudentMailinglist;
      $recipient->email_address = $request->input('email_address');
      if ($request->input('description')) {
        $recipient->description = $request->input('description');
      }
      $recipient->show = 1;
      if ($recipient->save()) {
        return $this->setStatusCode(201)
            ->respondSavedWithData('Recipient has been created.', ['recipient' => $recipient]);
      }
    }
  }

  /**
   * Takes a StudentEmail and analyzes it to see if it should be marked as "READY".
   * Requirements: exactly 1 featured item, at least 1 More News story, 1 announcement,
   * events (or excluded), Campus Life posts (or excluded), at least one recipient,
   * and a send date set in the future.
   */
  private function isEmailReady(StudentEmail $email) {
    $email->is_ready = 0;

    $featuredCount = $email->mainstories()->count() + $email->maininsideemuposts()->count();
    $featuredReady = $featuredCount === 1;

    if ($featuredReady &&
        $email->announcements()->first() &&
        ($email->events()->first() || $email->exclude_events) &&
        ($email->insideemuPosts()->first() || $email->exclude_insideemu) &&
        $email->stories()->first() &&
        $email->recipients()->first() &&
        \Carbon\Carbon::parse($email->send_at) >= date('Y-m-d H:i:s')
    ) {
      $email->is_ready = 1;
    }

    $email->save();
  }
}
