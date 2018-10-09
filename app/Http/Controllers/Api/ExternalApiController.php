<?php

namespace Emutoday\Http\Controllers\Api;

use Emutoday\Announcement;
use Emutoday\Event;
use Emutoday\Story;
use Emutoday\MiniCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as Input;
use Carbon\Carbon;
use League\Fractal\Manager;
use League\Fractal;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

use Emutoday\Today\Transformers\FractalAnnouncementTransformerModel;
class ExternalApiController extends ApiController
{
  function __construct()
  {
    $this->middleware('cors');
  }

  /**
   *  Get a list of events from the database.
   *
   *  @param  int    $limit         Limit the number of events
   *  @param  String $startDate     Start date for events
   *  @param  String $endDate       End date for events
   *  @param  int    $minicalendar  Events from a certain mini calendar
   *  @return json                  A JSON representation of all events
   */
  public function getEvents($limit = 10, $startDate = null, $endDate = null, $miniCalendar = null){
    $conditions = array(); //conditions for the where clause
    $conditions[] = array('is_approved', 1);
    $conditions[] = array('is_canceled', 0);

    if($startDate){
      $conditions[] = array('start_date', '>=', $startDate);
    }
    if($endDate){
      $conditions[] = array('end_date', '<=', $endDate);
    }
    if($miniCalendar){
        $events = MiniCalendar::find($miniCalendar)->events()->where($conditions)->limit($limit)->orderBy('start_date', 'asc');
    } else {
        $events = Event::select('*');
        $events->where($conditions)->limit($limit)->orderBy('start_date', 'asc');
    }

    $result = $events->get();
    return $result->toJson();
  }

  /**
   *  Get a list of HSC events from the database.
   *
   *  @param  int    $limit         Limit the number of events
   *  @param  String $startDate     Start date for events
   *  @param  String $endDate       End date for events
   *  @return json                  A JSON representation of all events
   */
  public function getHscEvents($limit = 10, $startDate = null, $endDate = null){
    $conditions = array(); //conditions for the where clause
    $conditions[] = array('is_approved', 1);
    $conditions[] = array('is_canceled', 0);
    $conditions[] = array('hsc_reviewed', 1);
    $conditions[] = array('hsc_rewards', '>', 0);

    if($startDate){
      $conditions[] = array('start_date', '>=', $startDate);
    }
    if($endDate){
      $conditions[] = array('end_date', '<=', $endDate);
    }

    $events = Event::select('*');
    $events->where($conditions)->limit($limit)->orderBy('start_date', 'asc');

    $result = $events->get();
    return $result->toJson();
  }

  /**
   *  Get a list of events from the database with a home_priority.
   *
   *  @param  int    $limit      Limit the number of events
   *  @param  String $sortBy     The criteria for sorting events
   *  @return json               A JSON representation of the events
   */
  public function getHomeFeaturedEvents($limit = 5, $sortBy = 'date'){
    $today = date('Y-m-d');
    $events = Event::select('*')
      ->where([
        ['home_priority', '>', 0],
        ['end_date', '>=', $today],
        ['is_approved', 1]
      ])->limit($limit);

    if($sortBy == 'priority'){
      $events->orderBy('home_priority', 'desc');
    } else {
      $events->orderBy('start_date', 'asc');
    }
    $result = $events->get();

    return $result->toJson();
  }

  public function getCurrentNews($limit = 10){
    $today = date('Y-m-d');
    $news = Story::select('*');
    $news
      ->where([
        ['is_approved', 1],
        ['start_date', '<=', $today],
      ])
      ->whereIn('story_type', ['news', 'story'])
      ->limit($limit)
      ->orderBy('priority', 'desc')
      ->orderBy('start_date', 'asc');

    $result = $news->get();

    return $result->toJson();
  }

  /**
   * EMU public calendars (e.g. emich.edu/cob/calendar) often gather events not by n-number of dates,
   * For example, the COB gets events in groups of 7 dates (a date can have any number of events),
   * with previous and next arrows to fetch earlier and later dates, respectively.
   *
   * In this function, return n-number of dates based on the reference_date passed as an argument
   * If the 'previous' flag is TRUE, search for dates EARLIER than this.
   * If the 'previous' flag is FALSE, search for dates LATER than this.
   *
   * @param int       $limit                     How many dates to get events for.
   * @param String    $referenceDate             The date to search before or after.
   * @param boolean   $previous                  TRUE = search past dates in relation to $referenceDate.
   *                                             FALSE = search future dates in relation to $referenceDate.
   * @param boolean   $includeSelectedDate       TRUE = search dates that include the $referenceDate.
   *                                             FALSE = do not search dates that include the $referenceDate.
   * @param int       $miniCalendar              The ID of the miniCalendar to filter dates and events by.
   * @return Array                               The array of dates with corresponding events and the number of total results found.
   */
  public function getEventsByDates($limit = 10, $referenceDate = null, $previous = false, $includeSelectedDate = false, $miniCalendar = null){
      $conditions = array(); //conditions for the where clause
      $conditions[] = array('is_approved', 1);

      $orderBy = 'asc';

      // includeSelectedDate variable gives the option of including the $referenceDate in the query
      if($includeSelectedDate){
          $dateOperator = '=';
      } else {
          $dateOperator = '';
      }

      // 'previous' flag is only relevant if referenceDate is set
      if($referenceDate){
          if($previous){
              $conditions[] = array('start_date', '<'.$dateOperator, $referenceDate);
              $orderBy = 'desc'; //start with most recent rather than oldest
          } else {
              $conditions[] = array('start_date', '>'.$dateOperator, $referenceDate);
          }
      } else {
          $conditions[] = array('start_date', '>'.$dateOperator, date('Y-m-d'));
      }

      // If minicalendar is set
      if($miniCalendar){
          // The goal here is to find a distinct number of dates that matches the $limit supplied
          $dates = MiniCalendar::find($miniCalendar)->events()->distinct()->select('start_date');

          $numDatesGross = $dates->count();

          // groupBy is the key here...it allows to select distinct dates (as opposed to the default of 'id')
          $dates->where($conditions)->take($limit)->orderBy('start_date', $orderBy)->groupBy('start_date');
          $dates = $dates->get();

          // Get all the events that fall on each date
          $eventsArr = array();
          foreach($dates as $date){
              $events = MiniCalendar::find($miniCalendar)->events()->where(['is_approved' => 1, 'start_date' => $date->start_date])->orderBy('start_time', 'asc');
              $events = $events->get();
              //add the day's events into the eventsArray
              $eventsArr[] = array('date' => $date->start_date, 'date_events' => $events);
          }
          $return = ['events' => $eventsArr, 'numDatesGross' => $numDatesGross];
          return $return;
      }

      // No minicalendar set
      $dates = Event::distinct()->select('start_date')->where($conditions);
      $numDatesGross = $dates->count();

      // groupBy is the key here...it allows to select distinct dates (as opposed to the default of 'id')
      $dates->take($limit)->orderBy('start_date', $orderBy)->groupBy('start_date');;
      $dates = $dates->get();

      // Get all the events that fall on each date
      $eventsArr = array();
      foreach($dates as $date){
          $events = Event::select('*')->where(['is_approved' => 1, 'start_date' => $date->start_date])->orderBy('start_time', 'asc');
          $events = $events->get();
          //add the day's events into the eventsArray
          $eventsArr[] = array('date' => $date->start_date, 'date_events' => $events);
      }
      $return = ['events' => $eventsArr, 'numDatesGross' => $numDatesGross];
      return $return;
  }

  /**
   * Same as getEventsByDates, but for any event that has HSC points and is HSC approved
   *
   * @param int       $limit                     How many dates to get events for.
   * @param String    $referenceDate             The date to search before or after.
   * @param boolean   $previous                  TRUE = search past dates in relation to $referenceDate.
   *                                             FALSE = search future dates in relation to $referenceDate.
   * @param boolean   $includeSelectedDate       TRUE = search dates that include the $referenceDate.
   *                                             FALSE = do not search dates that include the $referenceDate.
   * @return Array                               The array of dates with corresponding events and the number of total results found.
   */
  public function getHscEventsByDates($limit = 10, $referenceDate = null, $previous = false, $includeSelectedDate = false){
      $conditions = array(); //conditions for the where clause
      $conditions[] = array('is_approved', 1);
      $conditions[] = array('hsc_reviewed', 1);
      $conditions[] = array('hsc_rewards', '>', 0);

      $orderBy = 'asc';

      // includeSelectedDate variable gives the option of including the $referenceDate in the query
      if($includeSelectedDate){
          $dateOperator = '=';
      } else {
          $dateOperator = '';
      }

      // 'previous' flag is only relevant if referenceDate is set
      if($referenceDate){
          if($previous){
              $conditions[] = array('start_date', '<'.$dateOperator, $referenceDate);
              $orderBy = 'desc'; //start with most recent rather than oldest
          } else {
              $conditions[] = array('start_date', '>'.$dateOperator, $referenceDate);
          }
      } else {
          $conditions[] = array('start_date', '>'.$dateOperator, date('Y-m-d'));
      }

      // No minicalendar set
      $dates = Event::distinct()->select('start_date')->where($conditions);
      $numDatesGross = $dates->count();

      // groupBy is the key here...it allows to select distinct dates (as opposed to the default of 'id')
      $dates->take($limit)->orderBy('start_date', $orderBy)->groupBy('start_date');;
      $dates = $dates->get();

      // Get all the events that fall on each date
      $eventsArr = array();
      foreach($dates as $date){
          $events = Event::select('*')->where(['is_approved' => 1, 'start_date' => $date->start_date, 'hsc_reviewed' => 1, ['hsc_rewards', '>', 0]])->orderBy('title', 'asc');
          $events = $events->get();
          //add the day's events into the eventsArray
          $eventsArr[] = array('date' => $date->start_date, 'date_events' => $events);
      }
      $return = ['events' => $eventsArr, 'numDatesGross' => $numDatesGross];
      return $return;
  }

  /**
   * Get all homecoming events (events that have homecoming-related minicalendars related to them)
   *
   * @param Request   $request                   The HTTP request (which will contain an array of minicalendars in this case).
   * @param String    $firstDate                 The first date for which to search homecoming events.
   * @param String    $lastDate                  The last date for which to search homecoming events.
   * @return Array                               The array of events with corresponding minicalendars.
   */
  public function getHomecomingEvents(Request $request, $firstDate, $lastDate){
      $conditions = array(); //conditions for the where clause

      $miniCalendars = $request->get('minicalendars'); //MiniCalendar IDs in table cea_mini_calendars
      $eventsArr = array();

      // Loop through each date between first and last dates
      while(strtotime($firstDate) <= strtotime($lastDate)){
          // Get all the events for the date
          $dayEvents = Event::whereHas('minicalendars', function($query) use($miniCalendars, $firstDate) {
                            $query->where(['is_approved' => 1, 'start_date' => $firstDate])->whereIn('id', $miniCalendars);
                        })->orderBy('start_time', 'asc');
          $dayEvents = $dayEvents->get();

          // Get all the minicalendars to which each event belongsTo
          $dayArr = array();
          foreach($dayEvents as $dayEvent){
              $associatedMinicalendars = Event::find($dayEvent->id)->minicalendars();
              $associatedMinicalendars = $associatedMinicalendars->get();

              // Pack this day's events along with the associated minicalendars into an array
              $dayArr[] = array('event' => $dayEvent, 'minicalendars' => $associatedMinicalendars);
          }

          // Add this day's events array to the master events array
          $eventsArr[] = $dayArr;

          $firstDate = date ("Y-m-d", strtotime("+1 day", strtotime($firstDate))); //increment the date
      }
      return $eventsArr;
  }

  /**
   * Takes an externally-created Campus Life event and updates it in EMU Today
   * e.g. https://www.emich.edu/campuslife/admin/calendar/add.php
   *
   * @param int $id   The id of the record in the godzilla/general/campuslife_events table
   */
  public function updateCampusLifeEvent(Request $request, $id){

    $validation = \Validator::make( Input::all(), [
      //'first_name'          => 'required|max:80|min:2',
    ]);

    if( $validation->fails() )
    {
      return $this->setStatusCode(422)
      ->respondWithError($validation->errors()->getMessages());
    }

    if($validation->passes())
    {
      // UPDATE this event if it already exists (i.e. if its External ID is found)
      $existingEvent = Event::where('external_record_id', $id)->first();
      if($existingEvent){
        $existingEvent->is_approved = 0; //event needs re-approval

        $existingEvent->title = $request->input('title');
        $existingEvent->description = $request->input('description');
        $existingEvent->start_date = $request->input('start-date');
        $existingEvent->start_time = date("H:i:s", strtotime($request->input('start-time')));
        $existingEvent->end_date = $request->input('end-date');
        $existingEvent->end_time = date("H:i:s", strtotime($request->input('end-time')));

        $existingEvent->contact_person = $request->input('contact-person');
        $existingEvent->contact_phone = $request->input('contact-phone');
        $existingEvent->contact_email = $request->input('contact-email');
        $existingEvent->contact_fax = $request->input('contact-fax');

        $existingEvent->tickets = $request->input('tickets');
        if($request->input('tickets') == 'online'){
          $existingEvent->ticket_details_online = $request->input('ticket-details-online');
        } else if ($request->input('tickets') == 'phone') {
          $existingEvent->ticket_details_phone = $request->input('ticket-details-phone');
        } else if ($request->input('tickets') == 'office') {
          $existingEvent->ticket_details_office = $request->input('ticket-details-office');
        } else if ($request->input('tickets') == 'all') {
          $existingEvent->ticket_details_online = $request->input('ticket-details-online');
          $existingEvent->ticket_details_phone = $request->input('ticket-details-phone');
          $existingEvent->ticket_details_office = $request->input('ticket-details-office');
        } else if ($request->input('tickets') == 'other') {
          $existingEvent->ticket_details_other = $request->input('ticket-details-other');
        }

        if($request->input('free') == 1){
          $existingEvent->free = 1;
          $existingEvent->cost = 0;
        } else {
          $existingEvent->free = 0;
          $existingEvent->cost = $request->input('cost');
        }

        if($request->input('all-day') == 1){
          $existingEvent->all_day = 1;
          $existingEvent->start_time = '00:00:00';
          $existingEvent->end_time = '23:59:59';
        } else {
          $existingEvent->all_day = 0;
        }

        if($request->input('no-end') == 1){
          $existingEvent->no_end_time = 1;
          $existingEvent->end_time = '23:59:59';
        } else {
          $existingEvent->no_end_time = 0;
        }

        if($request->input('link-1') != ''){
          $existingEvent->related_link_1 = $request->input('link-1');
          $existingEvent->related_link_1_txt = $request->input('link-1');
        } else {
          $existingEvent->related_link_1 = null;
          $existingEvent->related_link_1_txt = null;
        }

        if($request->input('link-2') != ''){
          $existingEvent->related_link_2 = $request->input('link-2');
          $existingEvent->related_link_2_txt = $request->input('link-2');
        } else {
          $existingEvent->related_link_2 = null;
          $existingEvent->related_link_2_txt = null;
        }

        if($request->input('link-3') != ''){
          $existingEvent->related_link_3 = $request->input('link-3');
          $existingEvent->related_link_3_txt = $request->input('link-3');
        } else {
          $existingEvent->related_link_3 = null;
          $existingEvent->related_link_3_txt = null;
        }

        $existingEvent->lbc_approved = $request->input('lbc');
        $existingEvent->location = $request->input('location');
        $existingEvent->participants = $request->input('participants');

        if($request->input('deadline') != ''){
          $existingEvent->reg_deadline = $request->input('deadline');
        } else {
          $existingEvent->reg_deadline = null;
        }

        $minical = MiniCalendar::find(47); // 47 is the campus life minical on www as of 10/20/17
        $existingEvent->minicalendars()->sync($minical);

        if($existingEvent->save()) {
          return $this->setStatusCode(201)
          ->respondSavedWithData('Event successfully updated!', [ 'laravel_event' => $existingEvent, 'cma_event' => $request->all(), 'all-day' => $request->input('all-day') ]);
        }
      }
      // create the event if it didn't previously exist
      else {
        $event = new Event;

        $event->is_approved = 0; //event needs re-approval
        $event->external_record_id = $id;
        $event->submitter = $request->input('submitter');
        $event->submission_date = date('Y-m-d');

        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->start_date = $request->input('start-date');
        $event->start_time = date("H:i:s", strtotime($request->input('start-time')));
        $event->end_date = $request->input('end-date');
        $event->end_time = date("H:i:s", strtotime($request->input('end-time')));

        $event->contact_person = $request->input('contact-person');
        $event->contact_phone = $request->input('contact-phone');
        $event->contact_email = $request->input('contact-email');
        $event->contact_fax = $request->input('contact-fax');

        $event->tickets = $request->input('tickets');
        if($request->input('tickets') == 'online'){
          $event->ticket_details_online = $request->input('ticket-details-online');
        } else if ($request->input('tickets') == 'phone') {
          $event->ticket_details_phone = $request->input('ticket-details-phone');
        } else if ($request->input('tickets') == 'office') {
          $event->ticket_details_office = $request->input('ticket-details-office');
        } else if ($request->input('tickets') == 'all') {
          $event->ticket_details_online = $request->input('ticket-details-online');
          $event->ticket_details_phone = $request->input('ticket-details-phone');
          $event->ticket_details_office = $request->input('ticket-details-office');
        } else if ($request->input('tickets') == 'other') {
          $event->ticket_details_other = $request->input('ticket-details-other');
        }

        if($request->input('free') == 1){
          $event->free = 1;
          $event->cost = 0;
        } else {
          $event->free = 0;
          $event->cost = $request->input('cost');
        }

        if($request->input('all-day') == 1){
          $event->all_day = 1;
          $event->start_time = '00:00:00';
          $event->end_time = '23:59:59';
        } else {
          $event->all_day = 0;
        }

        if($request->input('no-end') == 1){
          $event->no_end_time = 1;
          $event->end_time = '23:59:59';
        } else {
          $event->no_end_time = 0;
        }

        if($request->input('link-1') != ''){
          $event->related_link_1 = $request->input('link-1');
          $event->related_link_1_txt = $request->input('link-1');
        } else {
          $event->related_link_1 = null;
          $event->related_link_1_txt = null;
        }

        if($request->input('link-2') != ''){
          $event->related_link_2 = $request->input('link-2');
          $event->related_link_2_txt = $request->input('link-2');
        } else {
          $event->related_link_2 = null;
          $event->related_link_2_txt = null;
        }

        if($request->input('link-3') != ''){
          $event->related_link_3 = $request->input('link-3');
          $event->related_link_3_txt = $request->input('link-3');
        } else {
          $event->related_link_3 = null;
          $event->related_link_3_txt = null;
        }

        $event->lbc_approved = $request->input('lbc');
        $event->location = $request->input('location');
        $event->participants = $request->input('participants');

        if($request->input('deadline') != ''){
          $event->reg_deadline = $request->input('deadline');
        } else {
          $event->reg_deadline = null;
        }

        if($event->save()) {
          $minical = MiniCalendar::find(47); // 47 is the campus life minical on www as of 10/20/17
          $event->minicalendars()->sync($minical);

          $to      = "calendar_events@emich.edu";
          $subject = $event->submitter."@emich.edu has submitted the following new calendar event:\n\n";
          $message = $event->submitter."@emich.edu has submitted the following new calendar event:\n\n" .
                      "$event->title\nhttps://today.emich.edu/admin/event/$event->id/edit\n\n" .
                      "https://today.emich.edu/admin/event/queue";
          $headers = 'From: '.$event->submitter.'@emich.edu'. "\r\n" .
          'Reply-To: '.$event->submitter."@emich.edu"."\r\n" .
          'X-Mailer: PHP/' . phpversion();
          mail($to, $subject, $message, $headers);

          return $this->setStatusCode(201)
          ->respondSavedWithData('Event successfully created!',[ 'event_id' => $event->id ]);
        }

      }

      return $this->setStatusCode(400)
      ->respondWithError('Event cound not be updated!');
    }
  }

  /**
   * Takes an externally-created Campus Life event and re-creates it in EMU Today
   * e.g. https://www.emich.edu/campuslife/admin/calendar/add.php
   */
  public function createCampusLifeEvent(Request $request){

    $validation = \Validator::make( Input::all(), [
      //'first_name'          => 'required|max:80|min:2',
    ]);

    if( $validation->fails() )
    {
      return $this->setStatusCode(422)
      ->respondWithError($validation->errors()->getMessages());
    }

    if($validation->passes())
    {
      // DO NOT create this event if it already exists (i.e. if its External ID is found)
      $existingEvent = Event::where('external_record_id', $request->input('record-id'))->first();
      if($existingEvent){
        return $this->setStatusCode(400)
        ->respondWithError('Event already exists!');
      }
      $event = new Event;

      $event->is_approved = 0; //event needs re-approval
      $event->external_record_id = $request->input('record-id');
      $event->submitter = $request->input('submitter');
      $event->submission_date = date('Y-m-d');

      $event->title = $request->input('title');
      $event->description = $request->input('description');
      $event->start_date = $request->input('start-date');
      $event->start_time = date("H:i:s", strtotime($request->input('start-time')));
      $event->end_date = $request->input('end-date');
      $event->end_time = date("H:i:s", strtotime($request->input('end-time')));

      $event->contact_person = $request->input('contact-person');
      $event->contact_phone = $request->input('contact-phone');
      $event->contact_email = $request->input('contact-email');
      $event->contact_fax = $request->input('contact-fax');

      $event->tickets = $request->input('tickets');
      if($request->input('tickets') == 'online'){
        $event->ticket_details_online = $request->input('ticket-details-online');
      } else if ($request->input('tickets') == 'phone') {
        $event->ticket_details_phone = $request->input('ticket-details-phone');
      } else if ($request->input('tickets') == 'office') {
        $event->ticket_details_office = $request->input('ticket-details-office');
      } else if ($request->input('tickets') == 'all') {
        $event->ticket_details_online = $request->input('ticket-details-online');
        $event->ticket_details_phone = $request->input('ticket-details-phone');
        $event->ticket_details_office = $request->input('ticket-details-office');
      } else if ($request->input('tickets') == 'other') {
        $event->ticket_details_other = $request->input('ticket-details-other');
      }

      if($request->input('free') == 1){
        $event->free = 1;
        $event->cost = 0;
      } else {
        $event->free = 0;
        $event->cost = $request->input('cost');
      }

      if($request->input('all-day') == 1){
        $event->all_day = 1;
        $event->start_time = '00:00:00';
        $event->end_time = '23:59:59';
      } else {
        $event->all_day = 0;
      }

      if($request->input('no-end') == 1){
        $event->no_end_time = 1;
        $event->end_time = '23:59:59';
      } else {
        $event->no_end_time = 0;
      }

      if($request->input('link-1') != ''){
        $event->related_link_1 = $request->input('link-1');
        $event->related_link_1_txt = $request->input('link-1');
      } else {
        $event->related_link_1 = null;
        $event->related_link_1_txt = null;
      }

      if($request->input('link-2') != ''){
        $event->related_link_2 = $request->input('link-2');
        $event->related_link_2_txt = $request->input('link-2');
      } else {
        $event->related_link_2 = null;
        $event->related_link_2_txt = null;
      }

      if($request->input('link-3') != ''){
        $event->related_link_3 = $request->input('link-3');
        $event->related_link_3_txt = $request->input('link-3');
      } else {
        $event->related_link_3 = null;
        $event->related_link_3_txt = null;
      }

      $event->lbc_approved = $request->input('lbc');
      $event->location = $request->input('location');
      $event->participants = $request->input('participants');

      if($request->input('deadline') != ''){
        $event->reg_deadline = $request->input('deadline');
      } else {
        $event->reg_deadline = null;
      }

      if($event->save()) {
        $minical = MiniCalendar::find(47); // 47 is the campus life minical on www as of 10/20/17
        $event->minicalendars()->sync($minical);

        $to      = "calendar_events@emich.edu";
        $subject = $event->submitter."@emich.edu has submitted the following new calendar event:\n\n";
        $message = $event->submitter."@emich.edu has submitted the following new calendar event:\n\n" .
                    "$event->title\nhttps://today.emich.edu/admin/event/$event->id/edit\n\n" .
                    "https://today.emich.edu/admin/event/queue";
        $headers = 'From: '.$event->submitter.'@emich.edu'. "\r\n" .
        'Reply-To: '.$event->submitter."@emich.edu"."\r\n" .
        'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);

        return $this->setStatusCode(201)
        ->respondSavedWithData('Event successfully created!',[ 'event_id' => $event->id ]);
      }
    }

    return $this->setStatusCode(400)
    ->respondWithError('Event cound not be created!');
  }

  /**
   * Takes an externally-created Campus Life event and updates its cancelation status in EMU Today
   * e.g. https://www.emich.edu/campuslife/admin/calendar/add.php
   *
   * @param int $id   The id of the record in the godzilla/general/campuslife_events table
   */
  public function cancelCampusLifeEvent(Request $request, $id){

    $eventToCancel = Event::where('external_record_id', $id)->first();

    $eventToCancel->is_canceled == 1 ? $eventToCancel->is_canceled = 0 : $eventToCancel->is_canceled = 1;

    if($eventToCancel->save()) {
      return $this->setStatusCode(200)
      ->respondUpdatedWithData('Event cancelation status successfully updated!',[]);
    }

    return $this->setStatusCode(400)
    ->respondWithError('Event cancelation status cound not be updated!');
  }

  /**
   * Takes an externally-created Campus Life event and deletes it in EMU Today
   * e.g. https://www.emich.edu/campuslife/admin/calendar/add.php
   *
   * @param int $id   The id of the record in the godzilla/general/campuslife_events table
   */
  public function deleteCampusLifeEvent(Request $request, $id){

    $eventToDelete = Event::where('external_record_id', $id)->first();

    if($eventToDelete->delete()) {
      return $this->setStatusCode(204)
      ->respondUpdatedWithData('Event successfully deleted!',[]);
    }

    return $this->setStatusCode(400)
    ->respondWithError('Event cound not be deleted!');
  }

  /**
   * INSTRUCTIONS
   * Cron OrgSync API script every 30 minutes
   *
   * Function 1: Get all events from orgsync API: curl -i -X GET 'https://api.orgsync.com/api/v2/events?key=Rl4NzNlqpaRih4tKQmRlcSMKftQVI09JH0xNglReQ58'
   * Function 2: Get an array of all the ids within the events from function 1
   * Functoin 3: Get an array of all the external_record_ids
   * Function 4: If an id exists within the events from OrgSync but NOT EMUToday, make that event.
   * Function 5: If an id exists within the EMUToday table but not in the events from OrgSync, delete that event from EMUToday.
   */
  public function refreshOrgSyncEvents(Request $request){

  }
}
