<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\Event;
// use emutoday\Emutoday\Transformers\EventTransformer;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends ApiController
{
    protected $events;

    public function __construct(Event $events)
    {
        $this->events = $events;
    }
    
    /**
     * [Creates event list when a date is selected]
     * route calendar/events/{year?}/{month?}/{day?}
     *   Route::get('calendar/events/{year?}/{month?}/{day?}','Api\EventsController@eventsByDay');
     * @param  [type] $year  [description]
     * @param  [type] $month [description]
     * @param  [type] $day   [description]
     * @return [type]        [description]
     */
    public function eventsByDay($year = null, $month = null, $day = null, $id = null)
    {
      $mondifier;
      if ($year == null) {
        $mondifier = "all";
      } else {
        if ($month == null) {
          $mondifier = "Y";
        } else {
          if ($day == null) {
              $mondifier = "YM";
          } else {
            $mondifier = "YMD";
          }
        }

      }

      if ($mondifier == 'YMD') {
        // $variations = Variation::where('created_at', '<' , $valuation->updated_at->toDateTimeString())->get();

        $cdate_start = Carbon::create($year,$month,$day)->startOfDay();
        $cdate_end = Carbon::create($year,$month,$day)->addDays(7)->endOfDay();
      //  dd($cdatePlusOne);


      } else {
        $cdate_start = Carbon::now()->startOfDay();
        $cdate_end = Carbon::now()->addDays(7)->endOfDay();
      }

      $eventlist = Event::where([
          ['start_date', '>=' , $cdate_start],
          ['start_date', '<=', $cdate_end],
          ['is_approved', '1']
      ])->orderBy('start_date')->get();


      // it would be better just to not query the event in the first place...
      if (!empty($id)){ // if id is given.
        $i = 0;
        foreach($eventlist as $event){ // filter by category
          $has_category = false; // sentinel

          // Associate the events category
          $event['category']=$event->eventcategories()->get();

          foreach($event['category'] as $ev_cat){
          // Loop through to find if the category matches.
            if ($ev_cat['id'] == $id){
              $has_category = true;
            }
          }
          if ($has_category == false){
            // Destroy event. if it doesn't have the category.
            unset($eventlist[$i]);
          }
          $i++;
        }
      }

      $groupedByDay = $eventlist->groupBy(function ($date){
    return Carbon::parse($date->start_date)->format('Y-n-j');                // return Carbon::parse($date->start_date)->timestamp;
              });
              // dd($groupedByDay);
        $yearVar = $cdate_start->year;
        $monthVarWord = $cdate_start->format('F');
        $monthVar =  $cdate_start->month;
        $dayVar = $cdate_start->day;
        $firstDate = $cdate_start->format('l, F j');
        $lastDate = $cdate_end->format('l, F j');

        return [ 'groupedByDay' => $groupedByDay,
                            'yearVar'=> $yearVar,
                            'monthVar'=> $monthVar,
                            'monthVarWord'=> $monthVarWord,
                            'dayVar' => $dayVar,
                            'firstDate' => $firstDate,
                            'lastDate' => $lastDate

                          ];
    }


    public function eventsByDate($year = null, $month = null, $day = null)
    {
      $modifier;
      if ($year == null) {
        $modifier = "all";
      } else {
        if ($month == null) {
          $modifier = "Y";
        } else {
          if ($day == null) {
              $modifier = "YM";
          } else {
            $modifier = "YMD";
          }
        }

      }

      // dd($mondifier);


      $cdate = Carbon::now()->subYear();
      $cdate_first = $cdate->firstOfMonth();


      $yearVar =  $cdate->year;
      $monthVar= $cdate->month;
      $monthVarWord = $cdate->format('F');
      $dayInMonth = $cdate->day;
      $monthArray = collect();
      $cd_dayMonthStarts = $cdate->firstOfMonth()->dayOfWeek;
      $cd_daysInMonth = $cdate->daysInMonth;

      $cdate_monthstart = Carbon::create($yearVar, $monthVar, 1, 12);

      $cdate_monthend = Carbon::create($yearVar, $monthVar, $cd_daysInMonth, 12);

      $eventlist = Event::select('id','title', 'start_date', 'end_date')->where([
        ['start_date', '>', $cdate_monthstart],
        ['start_date', '<', $cdate_monthend]
        ])->get();


        $eventlistcount = $eventlist->count();

        $grouped = Event::select('id','title', 'start_date', 'end_date')
                  ->where([
                      ['start_date', '>', $cdate_monthstart],
                      ['start_date', '<', $cdate_monthend]
                      ])->orderBy('start_date', 'asc')->get();

        $groupedByDay =  $grouped->groupBy(function ($date){
                return Carbon::parse($date->start_date)->format('j');
              });




        $keyed = $eventlist->keyBy(function ($item) {
          return Carbon::parse($item['start_date'])->day;
        });
        $uniqueByDay = $keyed->keys();
        $calDaysArray = collect();
      $dayCounter = 0;
      while ($dayCounter < $cd_dayMonthStarts) {
        $dayObject = collect(['day' => 'x'.$dayCounter , 'hasevents'=> 'no']);
        $calDaysArray->push($dayObject);

        //  = array_add($monthArray,$dayCounter, $dayObject);
        $dayCounter++;
      }

      for ($x = 1; $x <= $cd_daysInMonth; $x++){
        $hasevent = $uniqueByDay->contains($x)?'yes':'no';
        $dayObject = collect(['day' => $x, 'hasevents'=> $hasevent]);
        $calDaysArray->push($dayObject);

        // $monthArray = array_add($monthArray,$dayCounter, $dayObject);
        $dayCounter++;
      }

      $totalDaysInArray = count($calDaysArray);

      return [ 'groupedByDay' => $groupedByDay,
                          'elist2' => $eventlist,
                          'eachItems' => $eventlistcount,
                          'uniqueByDay'=> $uniqueByDay,
                          'yearVar'=> $yearVar,
                          'monthVar'=> $monthVar,
                          'monthVarWord'=> $monthVarWord,
                          'monthArray'=> $calDaysArray,
                          'dayInMonth' => $dayInMonth];
    //  $carbondate = new Carbon();
      // if ($mondifier == 'all') {
      //     $events = Event::all();
      //   } else {
        //   $year = 2016;
        //
        //   $carbondatestart = Carbon::create($year,1,1,12);
        //
        //   $carbondateend = Carbon::create($year,1,1,12)->addYear();
        //     $events = Event::where([
        //           ['start_date', '>', $carbondatestart],
        //           ['start_date', '<', $carbondateend],
        //         ])->get();
        // // }
        //
        //   return $this->respond($events);
    }

    /**
     * creates the Calendar Widget on public.event.index
     * Route::get('calendar/month/{year?}/{month?}/{day?}','Api\EventsController@eventsInMonth');
     * route calendar/month/{year?}/{month?}
     * @param  [type] $year  [year to view]
     * @param  [type] $month [month to view]
     * @return [type]        [json encode variables for consumption by vuejs]
     */
    public function eventsInMonth($year = null, $month = null, $day = null)
    {
      $currentDate;
      $selectedDate;
      $cdate_start;
      $cdate_end;
      if ($year == null) {
        $cdate_start = Carbon::now()->startOfMonth();
        $cdate_end = Carbon::now()->endOfMonth();
        $selectedDate = Carbon::now();
      } else {
        if ($month == null) {
            $modifier = "Y";
            $currentMonth = Carbon::now()->month;
            $currentDay = Carbon::now()->day;
            $selectedDate = Carbon::create($year, $currentMonth, $currentDay);
            $cdate_start = Carbon::create($year, $currentMonth, $currentDay)->startOfMonth();
            $cdate_end =  Carbon::create($year, $currentMonth, 1)->endOfMonth();
        } else {
            if ($day == null ){

              $selectedDate = Carbon::create($year, $month, 1 );
              $cdate_start = Carbon::create($year, $month, 1)->startOfMonth();
              $cdate_end =  Carbon::create($year, $month, 1)->endOfMonth();
            } else {
              $selectedDate = Carbon::create($year, $month, $day );
              $cdate_start = Carbon::create($year, $month, $day)->startOfMonth();
              $cdate_end =  Carbon::create($year, $month, 1)->endOfMonth();
            }

        }

      }


      $selectedYear = $selectedDate->year;
      $selectedMonth = $selectedDate->month;
      $selectedMonthWord = $selectedDate->format('F');
      $selectedDay = $selectedDate->day;

      $currentDate = Carbon::now();
      $currentYear = $currentDate->year;
      $currentMonth = $currentDate->month;
      $currentMonthWord = $currentDate->format('F');
      $currentDay = $currentDate->day;

      $yearVar =  $currentDate->year;
      $monthVar = $currentDate->format('F');
      $monthVarUnit = $currentDate->month;
      $dayInMonth = $currentDate->day;
      $monthArray = collect();

      $selectedMonth_StartOnDay =  $cdate_start->firstOfMonth()->dayOfWeek;
      $selectedMonth_daysInMonth = $cdate_start->daysInMonth;


      $eventsInMonth = Event::select('id', 'start_date', 'end_date')->where([
        ['start_date', '>', $cdate_start],
        ['start_date', '<', $cdate_end]
        ])->get();

        $keyed = $eventsInMonth->keyBy(function ($item) {
          return Carbon::parse($item['start_date'])->day;
        });
        $uniqueByDay = $keyed->keys();


        $eventlistcount = $eventsInMonth->count();
        $calDaysArray = collect();
      $dayCounter = 0;
      while ($dayCounter < $selectedMonth_StartOnDay) {
        $dayObject = collect(['day' => 'x'.$dayCounter , 'hasevents'=> 'no-events']);
        $calDaysArray->push($dayObject);
        $dayCounter++;
      }
      // dd($uniqueByDay);

      for ($x = 1; $x <= $selectedMonth_daysInMonth; $x++){
        $hasevent = $uniqueByDay->contains($x)?'yes-events':'no-events';
        $dayObject = collect(['day' => $x, 'hasevents'=> $hasevent]);
        $calDaysArray->push($dayObject);

        // $monthArray = array_add($monthArray,$dayCounter, $dayObject);
        $dayCounter++;
      }

      $totalDaysInArray = count($calDaysArray);


      return    [
          'uniqueByDay'         => $uniqueByDay,
          'calDaysArray'        => $calDaysArray,
          'selectedYear'        => $selectedYear,
          'selectedMonth'       => $selectedMonth,
          'selectedMonthWord'   => $selectedMonthWord,
          'selectedDay'         => $selectedDay,
          'currentYear'        => $currentYear,
          'currentMonth'       => $currentMonth,
          'currentMonthWord'   => $currentMonthWord,
          'currentDay'         => $currentDay,
            ];
    }


    public function byDate(Request $request)
    {
      return $request->all();

    }
    
    public function addEventToGoogleCalendar(Request $request){
        $client = new \Google_Client();
        $client->setAuthConfig(base_path() . '/client_secret.json');
        $client->addScope(array(\Google_Service_Calendar::CALENDAR));
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        
        $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/api/oauth2callback';
        
        if ($request->session()->has('access_token')) {
            
            $client->setAccessToken(session('access_token'));
            $calendar_service = new \Google_Service_Calendar($client);
          
            $event = $this->events->find($request->input('eventId'));
          
            $event_arr = array();
            $startDate = $event->start_date;
            $endDate = $event->end_date;
            $startTime = $event->start_time;
            $endTime = $event->end_time;

            $timezone = new \DateTimeZone('America/Detroit');

            $startDate = explode(' ', $startDate);
            $startDate = $startDate[0];
            $startDateTime = "$startDate $startTime";
            $startDateTime = new \DateTime($startDateTime, $timezone);

            $endDate = explode(' ', $endDate);
            $endDate = $endDate[0];
            $endDateTime = "$endDate $endTime";
            $endDateTime = new \DateTime($endDateTime, $timezone);
          
            if($event->all_day){
                $dateType = 'date';
                $finalStartTime = $startDateTime->format('Y-m-d');
                $finalEndTime = $endDateTime->format('Y-m-d');
            } else {
                $dateType = 'dateTime';
                $finalStartTime = $startDateTime->format(\DateTime::RFC3339);

                // add an hour to the start hour if no end hour is somehow set as being before the start hour
                if($endDateTime < $startDateTime){
                    $finalEndTime = clone $startDateTime;
                    $finalEndTime->add(new \DateInterval('PT1H')); 
                    $finalEndTime = $finalEndTime->format(\DateTime::RFC3339);
                } else {
                    $finalEndTime = $endDateTime->format(\DateTime::RFC3339);
                }
            }

            $event = new \Google_Service_Calendar_Event(array(
                'summary' => $event->title,
                'location' => $event->location,
                'description' => $event->description . ' | ' . $event->related_link_1 . ' | ' . $event->related_link_2 . ' | ' . $event->related_link_3,
                'start' => array(
                    $dateType => $finalStartTime,
                    'timeZone' => 'America/Detroit',
                ),
                'end' => array(
                    $dateType => $finalEndTime,
                    'timeZone' => 'America/Detroit',
                ),
            ));

          $calendarId = 'primary';
          $evt = $calendar_service->events->insert($calendarId, $event);
          
          $request->session()->flash('alert-success', 'Event successfully added!');
          return redirect()->back();

        } else {
          header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        } 
    }

    public function oAuth(Request $request){
        $client = new \Google_Client();
        $client->setAuthConfigFile(base_path() . '/client_secret.json');
        $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/api/oauth2callback');
        $client->addScope(array(\Google_Service_Calendar::CALENDAR));
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        
        // If there is an pre-existing access token, and that token has expired, refresh it.
        if($client->getAccessToken() && $client->isAccessTokenExpired()){
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        }
        if (!$request->get('code')) {
            $auth_url = $client->createAuthUrl();
            header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
        } else {
            $client->authenticate($request->get('code'));
            session(['access_token' => $client->getAccessToken()]);
            $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/calendar';
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }
    }
}
