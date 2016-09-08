<?php
namespace emutoday\Http\Controllers\EmuToday;

use emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use emutoday\Event;
use Carbon\Carbon;
use JavaScript;
class CalendarController extends Controller
{

  protected $events;

  public function __construct(Event $events)
  {
    $this->events = $events;
  }

  // Route::get('calendar', 'EmuToday\CalendarController@index');

  public function index($year = null, $month = null, $day = null)
  {
    $cd;
    if ($year == null) {
      // $mondifier = "all";
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

    // $cd = Carbon::now();
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

    // $monthDayCollection = collect($monthArray);


    $firstOfYear =  Carbon::create($cd->year,1,1);
    $lastDayOfYear = Carbon::create($cd->year,12,31);

  //  $groupedevents = $this->events->whereBetween('start_date', [$firstOfYear, $lastDayOfYear])->get();
    $monthNumber = $cd->month;
    $events_this_year = Event::where( \DB::raw('YEAR(start_date)'), '=', date('Y') )->get();
    $events_this_month = Event::where( \DB::raw('MONTH(start_date)'), '=', $monthNumber )->get();
    $events = $this->events->where('start_date', '>', $cd )->orderBy('start_date', 'asc')->get();

    $groupedevents = $events_this_month->groupBy(function ($item, $key) {
        $startdate = $item['start_date'];
        return $startdate->day;
      //  return substr($item['account_id'], -3);
    });
    // $featuredevents =  Event::where('mediafile_id', '>', 0)->orderBy('priority', 'dsc')->get();
    $featuredevents =  Event::where([
        ['is_approved', 1],
        ['mediafile_id', '>', 0]
        ] )->orderBy('priority', 'dsc')->get();
        // dd($featuredevents);
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
    return view('public.calendar.index', compact('events', 'featuredevents', 'cd','totalDaysInArray', 'monthArray', 'dayInMonth', 'varYearUnit', 'varMonthUnit', 'varDayUnit'));
  }

  public function show()
  {

  }
}
