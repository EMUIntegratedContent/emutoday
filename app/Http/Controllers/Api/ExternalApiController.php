<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\Announcement;
use Emutoday\Event;
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
}
