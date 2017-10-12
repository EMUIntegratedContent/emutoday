<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\Email;
use Emutoday\Story;
use Emutoday\User;
use Emutoday\Event;
use Emutoday\Announcement;
use Emutoday\ImageType;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Input as Input;
use Carbon\Carbon;

use League\Fractal\Manager;
use League\Fractal;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

use Emutoday\Today\Transformers\FractalEventTransformerModelFull;
use Emutoday\Today\Transformers\FractalStoryTransformerModel;
use Emutoday\Today\Transformers\FractalAnnouncementTransformerModel;

class EmailController extends ApiController
{
  function __construct()
  { //
  }

  /**
   * Main Stories require an image with type 'emutoday_email' to be present with the story.
   */
  public function getMainEmailReadyStories(Request $request, $fromDate = null, $toDate = null){
      $email_imagetypes = ImageType::select('id')->where('type', 'email')->get(); //get email imagetype

      if($fromDate && !$toDate){
          $stories  = Story::whereHas('storyImages', function($query) use ($email_imagetypes){
                        $query->whereIn('imagetype_id', $email_imagetypes);
                      })
                      ->where([['start_date', '>=', $fromDate], ['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->orderBy('start_date', 'desc')->get();
      } elseif($fromDate && $toDate){
          $stories  = Story::whereHas('storyImages', function($query) use ($email_imagetypes){
                        $query->whereIn('imagetype_id', $email_imagetypes);
                      })
                      ->where([['start_date', '>=', $fromDate], ['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->whereBetween('start_date', array($fromDate, $toDate))->orderBy('start_date', 'desc')->get();
      } else {
          $stories  = Story::whereHas('storyImages', function($query) use ($email_imagetypes){
                        $query->whereIn('imagetype_id', $email_imagetypes);
                      })->where([['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->orderBy('start_date', 'desc')->get();
      }

      $fractal = new Manager();
      $resource = new Fractal\Resource\Collection($stories->all(), new FractalStoryTransformerModel);

      return $this->setStatusCode(200)
      ->respondUpdatedWithData('Got stories with email photo', $fractal->createData($resource)->toArray() );
  }

  /**
   * Non-main Stories do not require an image with type 'emutoday_email' to be present with the story.
   */
  public function getAllEmailReadyStories(Request $request, $fromDate = null, $toDate = null){
      if($fromDate && !$toDate){
          $stories  = Story::where([['start_date', '>=', $fromDate], ['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->orderBy('start_date', 'asc')->get();
      } elseif($fromDate && $toDate){
          $stories  = Story::where([['start_date', '>=', $fromDate], ['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->whereBetween('start_date', array($fromDate, $toDate))->orderBy('start_date', 'asc')->get();
      } else {
          $stories  = Story::where([['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->orderBy('start_date', 'asc')->get();
      }

      $fractal = new Manager();
      $resource = new Fractal\Resource\Collection($stories->all(), new FractalStoryTransformerModel);

      return $this->setStatusCode(200)
      ->respondUpdatedWithData('Got stories.', $fractal->createData($resource)->toArray() );
  }

  /**
   * Events.
   */
  public function getAllEmailReadyEvents(Request $request, $fromDate = null, $toDate = null){
      if($fromDate && !$toDate){
          $events  = Event::where([['start_date', '>=', $fromDate], ['is_approved', 1]])->orderBy('start_date', 'asc')->get();
      } elseif($fromDate && $toDate){
          $events  = Event::where([['start_date', '>=', $fromDate], ['is_approved', 1]])->whereBetween('start_date', array($fromDate, $toDate))->orderBy('start_date', 'asc')->get();
      } else {
          // By default, only get future events
          $events  = Event::where([['start_date', '>=', date('Y-m-d')], ['is_approved', 1]])->orderBy('start_date', 'asc')->get();
      }

      $fractal = new Manager();
      $resource = new Fractal\Resource\Collection($events->all(), new FractalEventTransformerModelFull);

      return $this->setStatusCode(200)
      ->respondUpdatedWithData('Got events.', $fractal->createData($resource)->toArray() );
  }

  /**
   * Events.
   */
  public function getAllEmailReadyAnnouncements(Request $request, $fromDate = null, $toDate = null){
      if($fromDate && !$toDate){
          $announcements  = Announcement::where([['start_date', '>=', $fromDate], ['is_approved', 1]])->orderBy('start_date', 'asc')->get();
      } elseif($fromDate && $toDate){
          $announcements  = Announcement::where([['start_date', '>=', $fromDate], ['is_approved', 1]])->whereBetween('start_date', array($fromDate, $toDate))->orderBy('start_date', 'asc')->get();
      } else {
          // By default, only get future announcements
          $announcements  = Announcement::where([['start_date', '>=', date('Y-m-d')], ['is_approved', 1]])->orderBy('start_date', 'asc')->get();
      }

      $fractal = new Manager();
      $resource = new Fractal\Resource\Collection($announcements->all(), new FractalAnnouncementTransformerModel);

      return $this->setStatusCode(200)
      ->respondUpdatedWithData('Got announcements.', $fractal->createData($resource)->toArray() );
  }

  /**
   * Delete an email.
   *
   * @param int $id
   * @return array
   */
  public function delete($id)
  {
    $expert = Email::findOrFail($id);
    $expert->delete();
    return $this->setStatusCode(200)->respond('Email successfully deleted!');
  }
}
