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
   *  @param  int    $limit      Limit the number of events
   *  @param  String $startDate  Start date for events
   *  @param  String $endDate    End date for events
   *  @return json               A JSON representation of all events
   */
   public function getEvents($limit = 10, $startDate = null, $endDate = null){
    $conditions = array(); //conditions for the where clause
    $conditions[] = array('is_approved', 1);

    $events = Event::select('*');

    if($startDate){
      $conditions[] = array('start_date', '>=', $startDate);
    }
    if($endDate){
      $conditions[] = array('end_date', '<=', $endDate);
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
    $news = Story::select('title', 'is_approved', 'start_date', 'priority');
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
}
