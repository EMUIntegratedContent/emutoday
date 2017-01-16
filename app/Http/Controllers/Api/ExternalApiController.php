<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\Announcement;
use Emutoday\Event;
use Emutoday\Story;
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

    $events = Event::select('*');

    if($startDate){
      $conditions[] = array('start_date', '>=', $startDate);
    }
    if($endDate){
      $conditions[] = array('end_date', '<=', $endDate);
    }
    if($miniCalendar){
        $conditions[] = array('mini_calendar', $miniCalendar);
    }
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
        ['story_type', 'news'],
        ['is_approved', 1],
        ['start_date', '<=', $today],
      ])
      ->limit($limit)
      ->orderBy('priority', 'desc')
      ->orderBy('start_date', 'asc');

    $result = $news->get();

    return $result->toJson();
  }

  /**
   * EMU public calendars (e.g. emich.edu/cob/calendar) often gather events not by date,
   * but in groups of n-number of events. For example, the COB gets events in groups of 7,
   * with previous and next arrows to fetch earlier and later events, respectively.
   *
   * In this function, return n-number of events based on the reference_date passed as an argument
   * If the 'previous' flag is TRUE, search for dates EARLIER than this.
   * If the 'previous' flag is FALSE, search for dates LATER than this.
   */
  public function getPrevNextEvents($limit = 10, $referenceDate = null, $previous = false, $miniCalendar = null){
      $conditions = array(); //conditions for the where clause
      $conditions[] = array('is_approved', 1);

      $orderBy = 'asc';
      $events = Event::select('*');

      // 'previous' flag is only relevant if referenceDate is set
      if($referenceDate){
          if($previous){
              $conditions[] = array('start_date', '<', $referenceDate);
              $orderBy = 'desc';
          } else {
              $conditions[] = array('start_date', '>', $referenceDate);
          }
      } else {
          $conditions[] = array('start_date', '>=', date('Y-m-d'));
      }
      // Return only events from this mini calendar
      if($miniCalendar){
          $conditions[] = array('mini_calendar', $miniCalendar);
      }
      $events->where($conditions)->limit($limit)->orderBy(['start_date'=> $orderBy, 'start_date' => 'asc']);
      $result = $events->get();

      return $result->toJson();
  }
}
