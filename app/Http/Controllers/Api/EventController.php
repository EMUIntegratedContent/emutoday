<?php

namespace Emutoday\Http\Controllers\Api;



use Illuminate\Support\Facades\Input;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use League\Fractal\Manager;
use League\Fractal;

use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\JsonApiSerializer;

use Emutoday\Event;
use Emutoday\Category;
use Emutoday\Building;
use Emutoday\Mediafile;
use Emutoday\Mediatype;
use Emutoday\User;

use Carbon\Carbon;
use Mail;


use Emutoday\Today\Transformers\FractalEventTransformerModelFull;

use Illuminate\Http\Request;

class EventController extends ApiController
{

  function __construct()
  {
    // $this->middleware('auth');
    $this->middleware('web', ['only' => [
      'queueLoad',
      'lbcQueueLoad',
      'hscQueueLoad'
      ]]);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
      $currentDate = Carbon::now();
      $DateMinus2 =  $currentDate->subYears(2);
      $fractal = new Manager();

      $events = Event::orderBy('start_date', 'desc')->take(500);
      $resource = new Collection($events->get(), new FractalEventTransformerModelFull);
      // Turn all of that into a JSON string
      return $fractal->createData($resource)->toJson();


    }

    public function queueLoad($fromDate = null, $toDate = null)
    {
      $currentDate = Carbon::now();

      if (\Auth::check()) {
        $user = \Auth::user();

        if ($user->hasRole('contributor_1')){
            if($fromDate && !$toDate){
                $events = $user->events()->where('start_date', '>=', $fromDate)->get();
            } elseif($fromDate && $toDate){
                $events = $user->events()->whereBetween('start_date', array($fromDate, $toDate))->get();
            } else {
                $events = $user->events()->get();
            }
        } else {
              if($fromDate && !$toDate){
                  $events  = Event::where('start_date', '>=', $fromDate)->get();
              } elseif($fromDate && $toDate){
                  $events  = Event::whereBetween('start_date', array($fromDate, $toDate))->get();
              } else {
                  $events  = Event::get();
              }
        }

          $fractal = new Manager();
          $resource = new Fractal\Resource\Collection($events->all(), new FractalEventTransformerModelFull);
          return $fractal->createData($resource)->toArray();
      } else {
        return $this->setStatusCode(501)->respondWithError('Error');
      }
    }

    public function lbcQueueLoad($fromDate = null, $toDate = null)
    { // Return LBC approved or reviewed events
      $currentDate = Carbon::now();

      if (\Auth::check()) {
        $user = \Auth::user();

        if ($user->hasRole('lbc_approver')){
            if($fromDate && !$toDate){
                $events  = Event::where([['start_date', '>=', $fromDate], ['lbc_approved', '1'], ['lbc_reviewed', '0']])->get();
            } elseif($fromDate && $toDate){
                $events  = Event::where([['lbc_approved', '1'], ['lbc_reviewed', '0']])->whereBetween('start_date', array($fromDate, $toDate))->get();
            } else {
                $events  = Event::where([['lbc_approved', '1'], ['lbc_reviewed', '0']])->get();
            }
        }

        $fractal = new Manager();
        $resource = new Fractal\Resource\Collection($events->all(), new FractalEventTransformerModelFull);
        return $fractal->createData($resource)->toArray();
      } else {
        return $this->setStatusCode(501)->respondWithError('Error');
      }
    }

    public function hscQueueLoad($fromDate = null, $toDate = null)
    { // Return all events for HSC rewards program
      $currentDate = Carbon::now();

      if (\Auth::check()) {
        $user = \Auth::user();

        if ($user->hasRole('hsc_rewards')){
          if($fromDate && !$toDate){
            $events  = Event::where([['is_approved','=','1'],['start_date', '>=', $fromDate]])->get();
          } elseif($fromDate && $toDate){
            $events  = Event::where('is_approved','=','1')->whereBetween('start_date', array($fromDate, $toDate))->get();
          } else {
            $events  = Event::where('is_approved','=','1')->get();
          }
        }

        $fractal = new Manager();
        $resource = new Fractal\Resource\Collection($events->all(), new FractalEventTransformerModelFull);
        return $fractal->createData($resource)->toArray();
      } else {
        return $this->setStatusCode(501)->respondWithError('Error');
      }
    }

      /**
      * Retrieve resource for editing
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      public function edit($id)
      {
        // Authenticate user
        cas()->authenticate();

        // Retrieve the event with id of $id
        $event = Event::findOrFail($id);

        $fractal = new Manager();
        $resource = new Fractal\Resource\Item($event, new FractalEventTransformerModelFull);

        // Turn all of that into a JSON string
        return $fractal->createData($resource)->toArray();
      }


      /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
      public function store(Request $request)
      {
        // Conditional validation of related link text
        if($request->get('related_link_1') != ''){
            $related_text_rules_1 = 'required';
        } else {
            $related_text_rules_1 = '';
        }

        if($request->get('related_link_2') != ''){
            $related_text_rules_2 = 'required';
        } else {
            $related_text_rules_2 = '';
        }

        if($request->get('related_link_3') != ''){
            $related_text_rules_3 = 'required';
        } else {
            $related_text_rules_3 = '';
        }

        if($request->get('all_day') != '1' || $request->get('all_day') != 1){
            $start_time_rules = 'required';
        } else {
            $start_time_rules = '';
        }

        // Validation rules
        $validation = \Validator::make( Input::all(), [
          'title'           => 'required',
          'location'        => 'required',
          'on_campus'				=> 'required',
          'start_date'      => 'required|date',
          'end_date'        => 'required|date',
          'start_time'      => $start_time_rules,
          'categories'      => 'required',
          'cost'			      => 'required',
          'description'     => 'required',
          'contact_person'  => 'required',
          'contact_phone'   => 'required',
          'contact_email'   => 'required|email',
          'related_link_1_txt'  => $related_text_rules_1,
          'related_link_2_txt'  => $related_text_rules_2,
          'related_link_3_txt'  => $related_text_rules_3,
        ]);

        // Check against Validation rules
        if( $validation->fails() )
        {
          return $this->setStatusCode(422)
          ->respondWithError($validation->errors()->getMessages());
        }

        // Build record if Valid
        if($validation->passes())
        {
          cas()->authenticate(); //run authentication before calling cas->user

          $event = new Event;

          // If the user's email is present in the User table, save the user's id in the cea_events.user_id field
          $userInUserTable = User::where('email', cas()->user() . '@emich.edu')->first();
          if($userInUserTable){
            $event->user_id = $userInUserTable->id;
          }

          // General & Location info
          $event->submitter             	= cas()->user();
          $event->title                 	= $request->get('title');
          $event->short_title           	= $request->get('short_title');
          $event->description           	= $request->get('description');
          $event->on_campus				      	= $request->get('on_campus');
          //($request->get('building') !== null) ? $event->building = str_replace(' ', '-', strtolower($request->get('building'))) : $event->building = null;
          ($request->get('building') !== null) ? $event->building = preg_replace(["/[\s\\/]/","/[^A-Za-z0-9-\\/]/"], ["-",""], strtolower($request->get('building'))) : $event->building = null;
          $event->room						      	= $request->get('room');
          $event->location              	= $request->get('location');

          // Time & Date info
          $event->all_day					      	= $request->get('all_day');
          $event->no_end_time			      	= $request->get('no_end_time');
          $event->start_date             	= \Carbon\Carbon::parse($request->get('start_date'));
          $request->get('all_day') == 1 ? $event->start_time = '00:00:00' : $event->start_time = \Carbon\Carbon::parse($request->get('start_time'));
          $event->end_date      	      	= \Carbon\Carbon::parse($request->get('end_date'));
          ($request->get('no_end_time') == 1 || $request->get('all_day') == 1) ? $event->end_time = '23:59:59' : $event->end_time = \Carbon\Carbon::parse($request->get('end_time'));

          // Contact & Links
          $event->contact_person          = $request->get('contact_person');
          $event->contact_phone           = $request->get('contact_phone');
          $event->contact_email           = $request->get('contact_email');
          $event->contact_fax			      	= $request->get('contact_fax');
          $event->related_link_1					= trim($request->get('related_link_1'));
          $event->related_link_2					= trim($request->get('related_link_2'));
          $event->related_link_3					= trim($request->get('related_link_3'));
          $event->related_link_1_txt			= $request->get('related_link_1_txt');
          $event->related_link_2_txt			= $request->get('related_link_2_txt');
          $event->related_link_3_txt			= $request->get('related_link_3_txt');

          // Ticket info
          $event->reg_deadline						= $request->get('reg_deadline');
          $event->free 										= $request->get('free');
          $event->cost 										= $request->get('cost');
          $event->participants						= $request->get('participants');
          $event->tickets									= $request->get('tickets');
          $event->ticket_details_phone		= $request->get('ticket_details_phone');
          $event->ticket_details_online		= $request->get('ticket_details_online');
          $event->ticket_details_office		= $request->get('ticket_details_office');
          $event->ticket_details_other		= $request->get('ticket_details_other');

          // Misc
          $event->mini_calendar						= $request->get('mini_calendar');
          $event->lbc_approved						= $request->get('lbc_approved');
          $event->submission_date 				= \Carbon\Carbon::now();
          $event->is_hidden                 = $request->get('is_hidden');

          // Reset Approvals
          if($request->input('admin_pre_approved')){
            $event->is_approved       = 1;
            $createMessage = "Event successfully created and approved.";
          } else {
            $createMessage = "Event successfully created.";
          }

          if($event->save()) { // Record successfully stored
            // Send event has been submitted email
            $to      = "calendar_events@emich.edu";
            $subject = $event->submitter."@emich.edu has submitted the following new calendar event:\n\n";
            $message = $event->submitter."@emich.edu has submitted the following new calendar event:\n\n" .
                        "$event->title\nhttps://today.emich.edu/admin/event/$event->id/edit\n\n" .
                        "https://today.emich.edu/admin/event/queue";
            $headers = 'From: '.cas()->user().'@emich.edu'. "\r\n" .
            'Reply-To: '.cas()->user()."@emich.edu"."\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);

            // Make event categories and mini calendars
            $categoriesRequest = $request->input('categories') == null ? [] : array_pluck($request->input('categories'),'value');
            $minicalsRequestValue = $request->input('minicals') == null ? [] : array_pluck($request->input('minicals'),'value');
            $minicalsRequestParent = $request->input('minicals') == null ? [] : array_pluck($request->input('minicals'),'parent');
            $minicalsRequest = array_merge($minicalsRequestValue, array_filter($minicalsRequestParent));

            // Relate event categories and mini calendars
            $event->eventcategories()->sync($categoriesRequest);
            $event->minicalendars()->sync($minicalsRequest);

            // Save and return
            $event->save();
            return $this->setStatusCode(201)
            ->respondSavedWithData($createMessage,[ 'record_id' => $event->id ]);

          }
        }
      }

      public function removeMediaFile(Request $request)
      { // Removes events mediafile / featured status
        $event = Event::findOrFail($request->get('event_id'));
        $mediafile_record = Mediafile::findOrFail($event->mediafile_id);

        if(File::exists(public_path().$mediafile_record->getFullPath())){
          //delete the actual file
          File::delete(public_path().$mediafile_record->getFullPath());

          //delete the mediafile record
          $mediafile_record->delete();

          // Update event record
          $event->is_promoted = 0;
          $event->mediafile_id = 0;
          if($event->save()){
            $returnData = ['mediafile_id' => $event->mediafile_id, 'is_promoted' => $event->is_promoted,'is_approved' => $event->is_approved,'priority'=> $event->priority, 'home_priority'=> $event->home_priority, 'is_canceled'=> $event->is_canceled];
            return $this->setStatusCode(201)
            ->respondUpdatedWithData('Successfully removed event promotion',$returnData );
          }
        } else {
          flash()->warning('Image was not found and could not be deleted.');
        }
      }

      public function addMediaFile(Request $request)
      {

        $group = 'event';
        $type = 'small';
        $event_id = $request->input('event_id');
        $event = Event::findOrFail($event_id);

        if (empty(Input::file('eventimg'))) { // Just add/change caption and alt text to existing mediafile
          $mediafile_record = Mediafile::findOrFail($event->mediafile_id);
          $mediafile_record->caption = $request->input('caption');
          $mediafile_record->alt_text = $request->input('alt_text');
          $mediafile_record->save();
          if($event->save()) {
            $returnData = ['eventimage' => $mediafile_record->filename, 'is_promoted' => $event->is_promoted,'is_approved' => $event->is_approved,'priority'=> $event->priority, 'home_priority'=> $event->home_priority, 'is_canceled'=> $event->is_canceled];
            return $this->setStatusCode(201)
            ->respondUpdatedWithData('Image Caption and Alt Text Updated',$returnData );
          }
        } else {
          //define the image paths
          $destinationFolder = '/imgs/'.$group.'/';
          $mediafile = new Mediafile();
          //Find mediatype for this type of media file
          $mediatype = Mediatype::where([
            ['group',$group],
            ['type', $type]
            ])->first();
            //Define mediatype to mediafile relationship
            $mediafile->mediatype()->associate($mediatype);
            $mediafile->group = $group;
            $mediafile->type = $type;
            $mediafile->path = $destinationFolder;
            $imgFile = Input::file('eventimg');
            $imgFilePath = $imgFile->getRealPath();
            $imgFileOriginalExtension = strtolower($imgFile->getClientOriginalExtension());
            switch ($imgFileOriginalExtension) {
              case 'jpg':
              case 'jpeg':
              $imgFileExtension = 'jpg';
              break;
              default:
              $imgFileExtension = $imgFileOriginalExtension;
            }
            $mediafile->name = 'event'. '-' .$event->id . '-' . date('YmdHis');
            $mediafile->ext = $imgFileExtension;
            $imgFileName = $mediafile->name . '.' . $mediafile->ext;
            $image = Image::make($imgFilePath)
            ->save(public_path() . $destinationFolder . $imgFileName);
            $mediafile->filename = $imgFileName;
            $mediafile->caption = $request->input('caption');
            $mediafile->alt_text = $request->input('alt_text');
            $mediafile->save();
            $event->mediaFile()->associate($mediafile);
            $event->is_promoted = 1;
            if($event->save()) {
              $returnData = ['eventimage' => $mediafile->filename, 'is_promoted' => $event->is_promoted,'is_approved' => $event->is_approved,'priority'=> $event->priority, 'home_priority'=> $event->home_priority, 'is_canceled'=> $event->is_canceled];
              return $this->setStatusCode(201)
              ->respondUpdatedWithData('Event Image Updated',$returnData );
            }
          }
        }



        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function updateItem(Request $request, $id)
        { // Toggles the events bools
          $event = Event::findOrFail($id);
          if ($request->get('lbc_approved') !== null){
            // Condition for lbc approval update
            $event->lbc_approved = $request->get('lbc_approved');
            $event->lbc_reviewed = $request->get('lbc_reviewed');

            if($event->save()) {
              $returnData = ['lbc_reviewed' => $event->lbc_reviewed, 'lbc_approved' => $event->lbc_approved];
              return $this->setStatusCode(201)
              ->respondUpdatedWithData('event updated',$returnData );
            }
          } else if ($request->get('hsc_rewards') !== null || $request->get('hsc_reviewed') !== null){
            // Condition for hsc eagle rewards
            $event->hsc_reviewed = $request->get('hsc_reviewed');
            $event->hsc_rewards = $request->get('hsc_rewards');

            if($event->save()) {
              $returnData = ['hsc_reviewed' => $event->hsc_reviewed, 'hsc_rewards' => $event->hsc_rewards];
              return $this->setStatusCode(201)
              ->respondUpdatedWithData('event updated',$returnData );
            }
          } else {
            // Normal update
            $event->priority = $request->get('priority');
            $event->home_priority = $request->get('home_priority');
            $event->is_approved = $request->get('is_approved');
            ($event->is_approved == 1) ? $event->approved_date = Carbon::now() : $event->approved_date = null;
            $event->is_canceled = $request->get('is_canceled');

            if($event->save()) {
              if ($request->get('automail') === true && !empty($request->get('is_approved')) && $request->get('is_approved') == '1'){
                // Send approval notification email
                $to      = $event->submitter."@emich.edu";
                $subject = "Your Calendar Event Was Approved";
                $message = "Thank you for your submission. Your event ({$event->title}) has been posted to the calendar.";
                $headers = 'From: calendar_events@emich.edu' . "\r\n" .
                'Reply-To: calendar_events@emich.edu' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
                mail($to, $subject, $message, $headers);
              }
              // $returnData = ['is_approved' => $event->is_approved,'home_priority'=> $event->home_priority, 'priority'=> $event->priority, 'is_canceled'=> $event->is_canceled];
              $returnData = ['is_promoted' => $event->is_promoted,'is_approved' => $event->is_approved,'priority'=> $event->priority, 'home_priority'=> $event->home_priority, 'is_canceled'=> $event->is_canceled];
              return $this->setStatusCode(201)
              ->respondUpdatedWithData('event updated',$returnData );
            }
          }
        }

        public function delete($id)
        {
          $event = Event::findOrFail($id);
          $event->delete();
          return 'Event Deleted';
        }

        public function cancel($id)
        {
          $event = Event::findOrFail($id);
          ($event->is_canceled == 1) ? $event->is_canceled = 0 : $event->is_canceled = 1;
          if($event->save()) {
            return $this->setStatusCode(201)
            ->respondSavedWithData('Event cancel status changed',[ 'record_id' => $event->id ]);
          }
        }

        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request, $id)
        {
          // Find event
          $event = Event::findOrFail($id);

          // Conditional validation of related link text
          if($request->get('related_link_1') != ''){
              $related_text_rules_1 = 'required';
          } else {
              $related_text_rules_1 = '';
          }

          if($request->get('related_link_2') != ''){
              $related_text_rules_2 = 'required';
          } else {
              $related_text_rules_2 = '';
          }

          if($request->get('related_link_3') != ''){
              $related_text_rules_3 = 'required';
          } else {
              $related_text_rules_3 = '';
          }

          if($request->get('all_day') != '1' || $request->get('all_day') != 1){
              $start_time_rules = 'required';
          } else {
              $start_time_rules = '';
          }

          // Validation rules
          $validation = \Validator::make( Input::all(), [
            'title'           => 'required',
            'location'        => 'required',
            'on_campus'				=> 'required',
            'start_date'      => 'required|date',
            'end_date'        => 'required|date',
            'start_time'      => $start_time_rules,
            'categories'      => 'required',
            'cost'			      => 'required',
            'description'     => 'required',
            'contact_person'  => 'required',
            'contact_phone'   => 'required',
            'contact_email'   => 'required|email',
            'related_link_1_txt'  => $related_text_rules_1,
            'related_link_2_txt'  => $related_text_rules_2,
            'related_link_3_txt'  => $related_text_rules_3,
          ]);

          // Check against Validation rules
          if( $validation->fails() )
          {
            return $this->setStatusCode(422)
            ->respondWithError($validation->errors()->getMessages());
          }

          // Build record if Valid
          if($validation->passes())
          {
            // General & Location info
            $event->title                 	= $request->get('title');
            $event->short_title           	= $request->get('short_title');
            $event->description           	= $request->get('description');
            $event->on_campus				      	= $request->get('on_campus');
            //$request->get('building') !== null ? $event->building = str_replace(' ', '-', strtolower($request->get('building'))) : $event->building = null;
            $request->get('building') !== null ? $event->building = preg_replace(["/[\s\\/]/","/[^A-Za-z0-9-\\/]/"], ["-",""], strtolower($request->get('building'))) : $event->building = null;
            $event->room						      	= $request->get('room');
            $event->location              	= $request->get('location');

            // Time & Date info
            $event->all_day					      	= $request->get('all_day');
            $event->no_end_time			      	= $request->get('no_end_time');
            $event->start_date             	= \Carbon\Carbon::parse($request->get('start_date'));
            $request->get('all_day') == 1 ? $event->start_time = '00:00:00' : $event->start_time = \Carbon\Carbon::parse($request->get('start_time'));
            $event->end_date      	      	= \Carbon\Carbon::parse($request->get('end_date'));
            ($request->get('no_end_time') == 1 || $request->get('all_day') == 1) ? $event->end_time = '23:59:59' : $event->end_time = \Carbon\Carbon::parse($request->get('end_time'));

            // Contact & Links
            $event->contact_person          = $request->get('contact_person');
            $event->contact_phone           = $request->get('contact_phone');
            $event->contact_email           = $request->get('contact_email');
            $event->contact_fax			      	= $request->get('contact_fax');
            $event->related_link_1					= trim($request->get('related_link_1'));
            $event->related_link_2					= trim($request->get('related_link_2'));
            $event->related_link_3					= trim($request->get('related_link_3'));
            $event->related_link_1_txt			= $request->get('related_link_1_txt');
            $event->related_link_2_txt			= $request->get('related_link_2_txt');
            $event->related_link_3_txt			= $request->get('related_link_3_txt');

            // Ticket info
            $event->reg_deadline						= $request->get('reg_deadline');
            $event->free 										= $request->get('free');
            $event->cost 										= $request->get('cost');
            $event->participants						= $request->get('participants');
            $event->tickets									= $request->get('tickets');
            $event->ticket_details_phone		= $request->get('ticket_details_phone');
            $event->ticket_details_online		= $request->get('ticket_details_online');
            $event->ticket_details_office		= $request->get('ticket_details_office');
            $event->ticket_details_other		= $request->get('ticket_details_other');

            // Misc
            $event->mini_calendar						= $request->get('mini_calendar');
            $event->lbc_approved						= $request->get('lbc_approved');
            $event->submission_date 				= \Carbon\Carbon::now();
            $event->is_hidden                 = $request->get('is_hidden');

            // Reset Approvals
            if($request->input('admin_pre_approved')){
              $event->is_approved       = 1;

              $updateMessage = "Event successfully updated and approved.";
            } else {
              $event->is_approved       = 0; // events must go back into approver queue when updated
              $event->lbc_reviewed      = 0; // events must go back into approver queue when updated
              $event->priority          = 0; // events requiring re-approval lose priority
              $updateMessage = "Event successfully updated.";
            }


            if($event->save()) { // Record successfully Saved
              // Make event categories and mini calendars
              $categoriesRequest = $request->input('categories') == null ? [] : array_pluck($request->input('categories'),'value');
              $minicalsRequestValue = $request->input('minicals') == null ? [] : array_pluck($request->input('minicals'),'value');
              $minicalsRequestParent = $request->input('minicals') == null ? [] : array_pluck($request->input('minicals'),'parent');
              $minicalsRequest = array_merge($minicalsRequestValue, array_filter($minicalsRequestParent));

              // Relate event categories and mini calendars
              $event->eventcategories()->sync($categoriesRequest);
              $event->minicalendars()->sync($minicalsRequest);


              // Save and return
              $event->save();

              return $this->setStatusCode(201)
              ->respondSavedWithData($updateMessage,[ 'record_id' => $event->id ]);
            }
          }
        }

        /**
         * Any event with a 'priority' > 0
         */
        public function getElevatedEvents()
        {
          $currentDate = Carbon::now();
          if (\Auth::check()) {

            $user = \Auth::user();
            if ($user->hasRole('contributor_1')){
                return $this->setStatusCode(401)->respondWithError('You do not have sufficient privileges to see elevated events.');
            } else {
                $events  = Event::where([['priority', '>', 0]])->orderBy('priority', 'desc')->get();
            }

            $fractal = new Manager();
            $resource = new Fractal\Resource\Collection($events->all(), new FractalEventTransformerModelFull);
            // Turn all of that into a Array string
            return $fractal->createData($resource)->toArray();

          } else {
            return $this->setStatusCode(501)->respondWithError('Error');
          }
        }

        /**
         * Takes in elevated events and re-arranges their priority in array order.
         */
        public function reorderElevatedEvents(Request $request)
        {
          $elevatedEvents = $request->all();

          $elevatedEventIds = array();
          for($i = 0; $i < count($elevatedEvents); $i++){
            $event = Event::findOrFail($elevatedEvents[$i]['id']);
            $event->priority = count($elevatedEvents) - $i; //set new priority
            $event->save();
            $elevatedEventIds[] = $event->id; //prevent this event's priority from being set to 0
          }

          // Set all other event priorities to 0
          Event::whereNotIn('id', $elevatedEventIds)->update(['priority' => 0]);

          // Get updated list of priority events
          $events  = Event::where([['priority', '>', 0]])->orderBy('priority', 'desc')->get();
          $fractal = new Manager();
          $resource = new Fractal\Resource\Collection($events->all(), new FractalEventTransformerModelFull);
          // Turn all of that into a Array string
          return $fractal->createData($resource)->toArray();
        }
}
