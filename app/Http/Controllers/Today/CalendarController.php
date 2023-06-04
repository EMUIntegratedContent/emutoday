<?php
namespace Emutoday\Http\Controllers\Today;

use Emutoday\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Emutoday\Event;
use Carbon\Carbon;
use JavaScript;

class CalendarController extends Controller
{
    protected $events;

    public function __construct(Event $events)
    {
        $this->events = $events;
        $this->middleware('auth', ['only'=>['eventForm','userEvents']]);
    }

    public function index($year = null, $month = null, $day = null, $id = null)
    {
        $eventid = $id;
        if ($year == null) {
            $cd = Carbon::now();
        } else {
            if ($month == null) {
                $cd = Carbon::create($year,1,1)->startOfYear();
            } else {
                if ($day == null) {
                    $cd = Carbon::create($year,$month,1)->startOfMonth();;
                } else {
                    $cd = Carbon::create($year,$month,$day);
                }
            }

        }
        $varYearUnit =   $cd->year;
        $varMonthUnit =   $cd->month;
        $varDayUnit =   $cd->day;
        $dayInMonth = $cd->day;
        $monthArray = [];
        $cd_dayMonthStarts = $cd->firstOfMonth()->dayOfWeek;
        $cd_daysInMonth = $cd->daysInMonth;

        $dayCounter = 0;
        while ($dayCounter < $cd_dayMonthStarts) {
            $monthArray = array_add($monthArray,$dayCounter, ' ');
            $dayCounter++;
        }

        for ($x = 1; $x <= $cd_daysInMonth; $x++){
            $monthArray = array_add($monthArray,$dayCounter, $x);
            $dayCounter++;
        }
        $totalDaysInArray = count($monthArray);
        $monthNumber = $cd->month;

        $events_this_month = Event::whereMonth( 'start_date', '=', $monthNumber )->get();
        $events = $this->events->where([
            ['start_date', '>', $cd],
            ['is_approved', 1],
            ['is_canceled', 0],
            ['is_hidden', 0]
            ])
            ->orderBy('start_date', 'asc')->get();

        $groupedevents = $events_this_month->groupBy(function ($item, $key) {
            return $item['start_date']->day;
        });

        $featuredevents =  Event::where([
            ['is_approved', 1],
            ['mediafile_id', '>', 0],
            ['end_date', '>=', date('Y-m-d')]
            ])
            ->orderBy('start_date', 'asc')
            ->take(5)->get();

            JavaScript::put([
                'jsis' => 'hi',
                'varYearUnit' => $varYearUnit,
                'currentDate' => Carbon::now(),
                'currentMonth' => $cd->month,
                'currentMonthWord' => $cd->format('M'),
                'currentYear' => $cd->format('Y'),
                'firstOfMonthDayNumber' => $cd->firstOfMonth()->format('w'),
                'dayArray' => $monthArray,
                'dayInMonth' => $dayInMonth,
                'groupedevents' => $groupedevents,
            ]);

            return view('public.calendar.index', compact('events', 'featuredevents', 'cd','totalDaysInArray', 'monthArray', 'dayInMonth', 'varYearUnit', 'varMonthUnit', 'varDayUnit','eventid'));
        }

        /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
        */
        public function eventForm(Event $event)
        {
            if (\Auth::check()) {
              // The user is logged in...
              $user = \Auth::user();

              //return redirect()->action('Admin\EventController@form');
            } else {
                $user = cas()->user();
            }
              $approveditems = $this->events->where([
                  ['is_approved', 1],
                  ['submitter', $user]
                  ])->get();

              $submitteditems = $this->events->where([
                  ['is_approved', 0],
                  ['submitter', $user]
                  ])->get();

              return view('public.calendar.eventform', compact('event','approveditems','submitteditems'));
        }

        public function userEvents(Event $event)
        {
          $user = cas()->user();

          if($user){
            $approveditems = $this->events->where([
                ['is_approved', 1],
                ['submitter', $user]
                ])->get();

            $submitteditems = $this->events->where([
                ['is_approved', 0],
                ['submitter', $user]
                ])->get();
          } else {
            return "There was an error. Events table could not be loaded";
          }

          if(\Request::ajax()) {
            $view = \View::make('public.calendar.eventform', compact('event', 'approveditems','submitteditems'));
            $view = $view->renderSections();
            return json_encode($view['content-middle']);
          }
        }
}
