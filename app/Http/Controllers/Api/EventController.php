<?php

namespace Emutoday\Http\Controllers\Api;



use Illuminate\Support\Facades\Input;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
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

use Carbon\Carbon;


use Emutoday\Today\Transformers\FractalEventTransformerModelFull;

use Illuminate\Http\Request;

class EventController extends ApiController
{

  function __construct()
  {
    // $this->middleware('auth');
    $this->middleware(['web','auth'], ['only' => [
      'queueLoad'
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

    public function queueLoad()
    {
      $currentDate = Carbon::now();

      if (\Auth::check()) {
        $user = \Auth::user();

        if ($user->hasRole('contributor_1')){
          // dd($user->id);
          $events = $user->events()->get();
        } else {
          // $events = Event::limit(40)->where([
          $events = Event::where([
            ['end_date', '>', $currentDate->subDay(2)]
            ])->get();
            // Announcement::all();
          }
          $fractal = new Manager();
          $resource = new Fractal\Resource\Collection($events->all(), new FractalEventTransformerModelFull);
          return $fractal->createData($resource)->toArray();
        } else {
          return $this->setStatusCode(501)->respondWithError('Error');
        }
      }
      public function lbcQueueLoad()
      { // Return LBC approved or reviewed events
          $currentDate = Carbon::now();

          $events = Event::where([
            ['lbc_approved', '1'],
            ['lbc_reviewed', '0'],
            ['end_date', '>', $currentDate->subDay(14)]
          // ])->orWhere([
          //   ['lbc_reviewed', '0'],
          //   ['end_date', '>', $currentDate->subDay(14)]
          ])->get();

          $fractal = new Manager();
          $resource = new Fractal\Resource\Collection($events->all(), new FractalEventTransformerModelFull);
          return $fractal->createData($resource)->toArray();
      }

      /**
      * Retieve resource for editing
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
        // Validation rules
        $validation = \Validator::make( Input::all(), [
          'title'           => 'required',
          'location'        => 'required',
          'on_campus'				=> 'required',
          'start_date'      => 'required|date',
          'end_date'        => 'required|date',
          'categories'      => 'required',
          'cost'			      => 'required',
          'description'     => 'required',
          'contact_person'  => 'required',
          'contact_phone'   => 'required',
          'contact_email'   => 'required|email'
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

          // General & Location info
          $event->submitter             	= cas()->user();
          $event->title                 	= $request->get('title');
          $event->short_title           	= $request->get('short_title');
          $event->description           	= $request->get('description');
          $event->on_campus				      	= $request->get('on_campus');
          $event->building				      	= $request->get('building');
          $event->room						      	= $request->get('room');
          $event->location              	= $request->get('location');

          // Time & Date info
          $event->start_date             	= \Carbon\Carbon::parse($request->get('start_date'));
          $event->start_time     	      	= \Carbon\Carbon::parse($request->get('start_time'));
          $event->end_date      	      	= \Carbon\Carbon::parse($request->get('end_date'));
          $event->end_time     		      	= \Carbon\Carbon::parse($request->get('end_time'));
          $event->all_day					      	= $request->get('all_day');
          $event->no_end_time			      	= $request->get('no_end_time');

          // Contact & Links
          $event->contact_person          = $request->get('contact_person');
          $event->contact_phone           = $request->get('contact_phone');
          $event->contact_email           = $request->get('contact_email');
          $event->contact_fax			      	= $request->get('contact_fax');
          $event->related_link_1					= $request->get('related_link_1');
          $event->related_link_2					= $request->get('related_link_2');
          $event->related_link_3					= $request->get('related_link_3');
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

          if($event->save()) { // Record successfully stored
            // Make event categories and mini calendars
            $categoriesRequest = $request->input('categories') == null ? [] : array_pluck($request->input('categories'),'value');
            $minicalsRequest = $request->input('minicals') == null ? [] : array_pluck($request->input('minicals'),'value');

            // Relate event categories and mini calendars
            $event->eventcategories()->sync($categoriesRequest);
            $event->minicalendars()->sync($minicalsRequest);

            // Save and return
            $event->save();
            return $this->setStatusCode(201)
            ->respondSavedWithData('Event successfully created!',[ 'record_id' => $event->id ]);
          }
        }
      }

      public function mediaFileAdd($id, Request $request)
      {
        $group = 'event';
        $type = 'small';
        dd(Input::all());
      }

      public function addMediaFile(Request $request)
      {
        // dd($request->all(), $request->hasFile('eventimg'), $request->file('eventimg'));

        $group = 'event';
        $type = 'small';
        // $imgFile = $request->file('attachment');
        // dd($imgFile);
        $event_id = $request->input('event_id');
        // $imgFile = $request->file('attachment');
        $event = Event::findOrFail($event_id);
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
          //  ->fit(100)
          //  ->save(public_path() . $destinationFolder . 'thumbnails/' . 'thumb-' . $imgFileName);
          // 	}
          //
          $mediafile->filename = $imgFileName;
          $mediafile->save();
          $event->mediaFile()->associate($mediafile);
          $event->is_promoted = 1;
          if($event->save()) {
            $returnData = ['eventimage' => $event->mediaFile->filename , 'is_approved' => $event->is_approved,'priority'=> $event->priority, 'is_canceled'=> $event->is_canceled];
            return $this->setStatusCode(201)
            ->respondUpdatedWithData('event updated',$returnData );
            // return $this->setStatusCode(201)
            //             ->respondCreated('Event successfully updated');
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
          } else {
            // Normal update
            $event->priority = $request->get('priority');
            $event->home_priority = $request->get('home_priority');
            $event->is_approved = $request->get('is_approved');
            ($event->is_approved == 1) ? $event->approved_date = Carbon::now() : $event->approved_date = null;
            $event->is_canceled = $request->get('is_canceled');

            if($event->save()) {
              $returnData = ['is_approved' => $event->is_approved,'home_priority'=> $event->home_priority, 'priority'=> $event->priority, 'is_canceled'=> $event->is_canceled];
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

          // Validation rules
          $validation = \Validator::make( Input::all(), [
            'title'           => 'required',
            'location'        => 'required',
            'on_campus'				=> 'required',
            'start_date'      => 'required|date',
            'end_date'        => 'required|date',
            'categories'      => 'required',
            'cost'			      => 'required',
            'description'     => 'required',
            'contact_person'  => 'required',
            'contact_phone'   => 'required',
            'contact_email'   => 'required|email'
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
            $event->building				      	= $request->get('building');
            $event->room						      	= $request->get('room');
            $event->location              	= $request->get('location');

            // Time & Date info
            $event->start_date             	= \Carbon\Carbon::parse($request->get('start_date'));
            $event->start_time     	      	= \Carbon\Carbon::parse($request->get('start_time'));
            $event->end_date      	      	= \Carbon\Carbon::parse($request->get('end_date'));
            $event->end_time     		      	= \Carbon\Carbon::parse($request->get('end_time'));
            $event->all_day					      	= $request->get('all_day');
            $event->no_end_time			      	= $request->get('no_end_time');

            // Contact & Links
            $event->contact_person          = $request->get('contact_person');
            $event->contact_phone           = $request->get('contact_phone');
            $event->contact_email           = $request->get('contact_email');
            $event->contact_fax			      	= $request->get('contact_fax');
            $event->related_link_1					= $request->get('related_link_1');
            $event->related_link_2					= $request->get('related_link_2');
            $event->related_link_3					= $request->get('related_link_3');
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

            // Reset Approvals
            $event->is_approved       = 0; // events must go back into approver queue when updated
            $event->lbc_reviewed      = 0; // events must go back into approver queue when updated

            if($event->save()) { // Record successfully Saved
              // Make event categories and mini calendars
              $categoriesRequest = $request->input('categories') == null ? [] : array_pluck($request->input('categories'),'value');
              $minicalsRequest = $request->input('minicals') == null ? [] : array_pluck($request->input('minicals'),'value');

              // Relate event categories and mini calendars
              $event->eventcategories()->sync($categoriesRequest);
              $event->minicalendars()->sync($minicalsRequest);

              // Save and return
              $event->save();
              return $this->setStatusCode(201)
              ->respondSavedWithData('Event successfully updated!',[ 'record_id' => $event->id ]);
            }
          }
        }
      }
