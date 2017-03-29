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
              $events = MiniCalendar::find($miniCalendar)->events()->where(['is_approved' => 1, 'start_date' => $date->start_date])->orderBy('title', 'asc');
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
          $events = Event::select('*')->where(['is_approved' => 1, 'start_date' => $date->start_date])->orderBy('title', 'asc');
          $events = $events->get();
          //add the day's events into the eventsArray
          $eventsArr[] = array('date' => $date->start_date, 'date_events' => $events);
      }
      $return = ['events' => $eventsArr, 'numDatesGross' => $numDatesGross];
      return $return;
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
  public function getHomecomingEvents($firstDate, $lastDate){
      $conditions = array(); //conditions for the where clause
      $conditions[] = array(['is_approved', 1], ['start_date', '>=', $firstDate], ['startDate', '<=', $lastDate]);

      $miniCalendars = array(40,41,42); //MiniCalendar IDs in table cea_mini_calendars

      $orderBy = 'asc';

      // The goal here is to find a distinct number of dates that matches the $limit supplied
      $dates = MiniCalendar::find(40)->events()->distinct()->select('start_date');

      $numDatesGross = $dates->count();

      // groupBy is the key here...it allows to select distinct dates (as opposed to the default of 'id')
      $dates->where($conditions)->orderBy('start_date', $orderBy)->groupBy('start_date');
      $dates = $dates->get();

      // Get all the events that fall on each date
      $eventsArr = array();
      foreach($dates as $date){
          $events = MiniCalendar::find(40)->events()->where($conditions)->orderBy('title', 'asc');
          $events = $events->get();
          //add the day's events into the eventsArray
          $eventsArr[] = array('date' => $date->start_date, 'date_events' => $events);
      }
      $return = ['events' => $eventsArr, 'numDatesGross' => $numDatesGross];
      return $return;

  }
}
