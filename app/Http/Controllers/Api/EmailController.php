<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\Email;
use Emutoday\Story;
use Emutoday\User;
use Emutoday\Event;
use Emutoday\Announcement;
use Emutoday\Imagetype;
use Emutoday\MailingList;
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
use Emutoday\Today\Transformers\FractalEmailTransformerModel;

class EmailController extends ApiController
{
  protected $email;

  function __construct(Email $email)
  {
    $this->email = $email;
  }

  /**
   * Get the specified email
   */
   public function edit(Email $email){
     $fractal = new Manager();
     $resource = new Fractal\Resource\Item($email, new FractalEmailTransformerModel);

     return $this->setStatusCode(200)
     ->respondUpdatedWithData('Got email.', $fractal->createData($resource)->toArray() );
   }

   /**
    * Store a new email
    */
    public function store(Request $request){
      $validation = \Validator::make( Input::all(), [
          'title'   => 'required|min:10',
          'send_at' => 'nullable|date_format:Y-m-d H:i:s'
         ]);

      if( $validation->fails() ){
          return $this->setStatusCode(422)
                      ->respondWithError($validation->errors()->getMessages());
      }

      if($validation->passes()){
          $email = new Email;

          $sendAt = null;
          if($request->get('send_at') != null){
            $sendAt = \Carbon\Carbon::parse($request->get('send_at'));
          }

          $email->title            = $request->get('title');
          $email->subheading       = $request->get('subheading', null);
          $email->is_approved      = $request->get('is_approved', 0);
          $email->send_at          = $sendAt;

          if($email->save()) {
            // Sync announcements
            // tutuorial: https://laravel.com/docs/5.5/eloquent-relationships#updating-many-to-many-relationships
            $announcemntCount = 0;
            $announcementIds = array();
            foreach($request->get('announcements') as $announcement){
              $announcementIds[$announcement['id']] = ['order' => $announcemntCount] ;
              $announcemntCount++;
            }
            $email->announcements()->sync($announcementIds);

            // Sync events
            $eventCount = 0;
            $eventIds = array();
            foreach($request->get('events') as $event){
              $eventIds[$event['id']] = ['order' => $eventCount];
              $eventCount++;
            }
            $email->events()->sync($eventIds);

            // Sync main stories
            $mainStoryCount = 0;
            $mainStoryIds = array();
            foreach($request->get('mainStories') as $mainStory){
              $mainStoryIds[$mainStory['id']] = ['order' => $mainStoryCount];
              $mainStoryCount++;
            }
            $email->mainstories()->sync($mainStoryIds);

            // Sync side stories
            $otherStoryCount = 0;
            $otherStoryIds = array();
            foreach($request->get('otherStories') as $otherStory){
              $otherStoryIds[$otherStory['id']] = ['order' => $otherStoryCount];
              $otherStoryCount++;
            }
            $email->stories()->sync($otherStoryIds);

            // Sync recipients
            $recipientIds = array();
            foreach($request->get('recipients') as $recipient){
              $recipientIds[] = $recipient['id'];
            }
            $email->recipients()->sync($recipientIds);

            // Analyze email for completeness and set send_at flag
            $this->isEmailReady($email);

            $fractal = new Manager();
            $resource = new Fractal\Resource\Item($email, new FractalEmailTransformerModel);

            return $this->setStatusCode(200)
             ->respondUpdatedWithData('Email has been created.', $fractal->createData($resource)->toArray() );
          }
      }
    }

  /**
   * Update the specified email
   */
   public function update(Request $request, $id){
     $email = $this->email->findOrFail($id);

     $validation = \Validator::make( Input::all(), [
         'title'   => 'required|min:10',
         'send_at' => 'nullable|date_format:Y-m-d H:i:s'
        ]);

     if( $validation->fails() ){
         return $this->setStatusCode(422)
                     ->respondWithError($validation->errors()->getMessages());
     }

     if($validation->passes()){
         $sendAt = null;
         if($request->get('send_at')){
           $sendAt = \Carbon\Carbon::parse($request->get('send_at'));
         }

         $email->title           	= $request->get('title');
         $email->subheading       = $request->get('subheading', null);
         $email->is_approved      = $request->get('is_approved', 0);
         $email->send_at          = $sendAt;

         // Sync announcements
         // tutuorial: https://laravel.com/docs/5.5/eloquent-relationships#updating-many-to-many-relationships
         $announcemntCount = 0;
         $announcementIds = array();
         foreach($request->get('announcements') as $announcement){
           $announcementIds[$announcement['id']] = ['order' => $announcemntCount] ;
           $announcemntCount++;
         }
         $email->announcements()->sync($announcementIds);

         // Sync events
         $eventCount = 0;
         $eventIds = array();
         foreach($request->get('events') as $event){
           $eventIds[$event['id']] = ['order' => $eventCount];
           $eventCount++;
         }
         $email->events()->sync($eventIds);

         // Sync main stories
         $mainStoryCount = 0;
         $mainStoryIds = array();
         foreach($request->get('mainStories') as $mainStory){
           $mainStoryIds[$mainStory['id']] = ['order' => $mainStoryCount];
           $mainStoryCount++;
         }
         $email->mainstories()->sync($mainStoryIds);

         // Sync side stories
         $otherStoryCount = 0;
         $otherStoryIds = array();
         foreach($request->get('otherStories') as $otherStory){
           $otherStoryIds[$otherStory['id']] = ['order' => $otherStoryCount];
           $otherStoryCount++;
         }
         $email->stories()->sync($otherStoryIds);

         // Sync recipients
         $recipientIds = array();
         foreach($request->get('recipients') as $recipient){
           $recipientIds[] = $recipient['id'];
         }
         $email->recipients()->sync($recipientIds);

         if($email->save()) {

           // Analyze email for completeness and set send_at flag
           $this->isEmailReady($email);

           $fractal = new Manager();
           $resource = new Fractal\Resource\Item($email, new FractalEmailTransformerModel);

           return $this->setStatusCode(200)
            ->respondUpdatedWithData('Email has been updated.', $fractal->createData($resource)->toArray() );
         }
     }
   }

   /**
    * Clone an existing email (same as store() except exclude recipients, send_at, approve, live. Include id of original email as clone_id)
    */
    public function cloneEmail(Request $request){
      $validation = \Validator::make( Input::all(), [
          'title'   => 'required|min:10',
          'send_at' => 'nullable|date_format:Y-m-d H:i:s'
         ]);

      if( $validation->fails() ){
          return $this->setStatusCode(422)
                      ->respondWithError($validation->errors()->getMessages());
      }

      if($validation->passes()){
          $email = new Email;

          $sendAt = null;
          if($request->get('send_at') != null){
            $sendAt = \Carbon\Carbon::parse($request->get('send_at'));
          }

          $email->title            = $request->get('title');
          $email->subheading       = $request->get('subheading', null);
          $email->clone_email_id   = $request->get('id'); // mark from which email this one was cloned

          if($email->save()) {
            // Sync announcements
            // tutuorial: https://laravel.com/docs/5.5/eloquent-relationships#updating-many-to-many-relationships
            $announcemntCount = 0;
            $announcementIds = array();
            foreach($request->get('announcements') as $announcement){
              $announcementIds[$announcement['id']] = ['order' => $announcemntCount] ;
              $announcemntCount++;
            }
            $email->announcements()->sync($announcementIds);

            // Sync events
            $eventCount = 0;
            $eventIds = array();
            foreach($request->get('events') as $event){
              $eventIds[$event['id']] = ['order' => $eventCount];
              $eventCount++;
            }
            $email->events()->sync($eventIds);

            // Sync main stories
            $mainStoryCount = 0;
            $mainStoryIds = array();
            foreach($request->get('mainStories') as $mainStory){
              $mainStoryIds[$mainStory['id']] = ['order' => $mainStoryCount];
              $mainStoryCount++;
            }
            $email->mainstories()->sync($mainStoryIds);

            // Sync side stories
            $otherStoryCount = 0;
            $otherStoryIds = array();
            foreach($request->get('otherStories') as $otherStory){
              $otherStoryIds[$otherStory['id']] = ['order' => $otherStoryCount];
              $otherStoryCount++;
            }
            $email->stories()->sync($otherStoryIds);

            $fractal = new Manager();
            $resource = new Fractal\Resource\Item($email, new FractalEmailTransformerModel);

            return $this->setStatusCode(201)
             ->respondUpdatedWithData('Email has been cloned.', $fractal->createData($resource)->toArray() );
          }
      }
    }

   /**
    * Delete an email.
    *
    * @param int $id
    * @return array
    */
   public function destroy($id)
   {
     $email = $this->email->findOrFail($id);
     $email->delete();
     return $this->setStatusCode(200)->respond('Email successfully deleted!');
   }

  /**
   * Main Stories require an image with type 'emutoday_email' to be present with the story.
   */
   public function getMainEmailReadyStories(Request $request, $fromDate = null, $toDate = null){
      $email_imagetypes = Imagetype::select('id')->where('type', 'email')->get(); //get email imagetype

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
          $stories  = Story::where([['start_date', '>=', $fromDate], ['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->orderBy('start_date', 'desc')->get();
      } elseif($fromDate && $toDate){
          $stories  = Story::where([['start_date', '>=', $fromDate], ['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->whereBetween('start_date', array($fromDate, $toDate))->orderBy('start_date', 'desc')->get();
      } else {
          $stories  = Story::where([['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->orderBy('start_date', 'desc')->get();
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
          $events  = Event::where([['start_date', '>=', $fromDate], ['is_approved', 1]])->orderBy('start_date', 'desc')->get();
      } elseif($fromDate && $toDate){
          $events  = Event::where([['start_date', '>=', $fromDate], ['is_approved', 1]])->whereBetween('start_date', array($fromDate, $toDate))->orderBy('start_date', 'desc')->get();
      } else {
          // By default, only get future events
          $events  = Event::where([['start_date', '>=', date('Y-m-d')], ['is_approved', 1]])->orderBy('start_date', 'desc')->get();
      }

      $fractal = new Manager();
      $resource = new Fractal\Resource\Collection($events->all(), new FractalEventTransformerModelFull);

      return $this->setStatusCode(200)
      ->respondUpdatedWithData('Got events.', $fractal->createData($resource)->toArray() );
  }

  /**
   * Announcements.
   */
  public function getAllEmailReadyAnnouncements(Request $request, $fromDate = null, $toDate = null){
      if($fromDate && !$toDate){
          $announcements  = Announcement::where([['start_date', '>=', $fromDate], ['is_approved', 1]])->orderBy('start_date', 'desc')->get();
      } elseif($fromDate && $toDate){
          $announcements  = Announcement::where([['start_date', '>=', $fromDate], ['is_approved', 1]])->whereBetween('start_date', array($fromDate, $toDate))->orderBy('start_date', 'desc')->get();
      } else {
          // By default, only get future announcements
          $announcements  = Announcement::where([['start_date', '>=', date('Y-m-d')], ['is_approved', 1]])->orderBy('start_date', 'desc')->get();
      }

      $fractal = new Manager();
      $resource = new Fractal\Resource\Collection($announcements->all(), new FractalAnnouncementTransformerModel);

      return $this->setStatusCode(200)
      ->respondUpdatedWithData('Got announcements.', $fractal->createData($resource)->toArray() );
  }

  /**
   * Get all email recipients.
   */
  public function getAllRecipients(Request $request){

      $recipients  = MailingList::where('show', 1)->orderBy('email_address', 'asc')->get();

      return $this->setStatusCode(200)
      ->respondUpdatedWithData('Got announcements.', $recipients );
  }

  /**
   * Save a previously-unlisted email recipient.
   */
  public function saveRecipient(Request $request){
    $validation = \Validator::make( Input::all(), [
        'email_address'   => 'required|email|unique:mailinglists,email_address' ]);

    if( $validation->fails() ){
        return $this->setStatusCode(422)
                    ->respondWithError($validation->errors()->getMessages());
    }

    if($validation->passes()){
        $recipient = new MailingList;
        $recipient->email_address    = $request->get('email_address');
        if($request->get('description')){
          $recipient->description = $request->get('description');
        }
        $recipient->show = 1;
        if($recipient->save()) {
            return $this->setStatusCode(201)
            ->respondSavedWithData('Recipient has been created.', ['recipient' => $recipient] );
        }
    }
  }

  /**
   * Takes an Email object and analyzes it to see if it should be marked as "READY".
   * Requirements: Must have main story, at least 1 side story, announcement, event, send date set in the future, at least one recipient
   */
  private function isEmailReady(Email $email){
    $email->is_ready = 0;

    if($email->mainstories()->first() &&
       ($email->mainstories()->count() == 1 || $email->mainstories()->count() == 3) &&
       $email->announcements()->first() &&
       $email->events()->first() &&
       $email->stories()->first() &&
       $email->recipients()->first() &&
       \Carbon\Carbon::parse($email->send_at) >= date('Y-m-d H:i:s')
     ){
      $email->is_ready = 1;
    }

    $email->save();
    return;
  }
}
