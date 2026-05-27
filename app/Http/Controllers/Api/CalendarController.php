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
     * @param null $year
     * @param null $month
     * @param null $day
     * @param null $id
     * @return array [type]        [description]
     */
    public function eventsByDay($year = null, $month = null, $day = null, $id = null)
    {
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
        if ($modifier == 'YMD') {
            $cdate_start = Carbon::create($year, $month, $day)->startOfDay();
            $cdate_end = Carbon::create($year, $month, $day)->addDays(7)->endOfDay();
        } else {
            $cdate_start = Carbon::now()->startOfDay();
            $cdate_end = Carbon::now()->addDays(7)->endOfDay();
        }
        $eventlist = Event::where([
            ['is_approved', '1'],
            ['is_hidden', '0'],
            ['is_archived', '0'],
        ])
            ->where('start_date', '<=', $cdate_end)
            ->whereRaw('COALESCE(end_date, start_date) >= ?', [$cdate_start])
            ->orderBy('start_date')
            ->orderBy('start_time', 'asc')
            ->get();

        // it would be better just to not query the event in the first place...
        if (!empty($id)) { // if id is given.
            $i = 0;
            foreach ($eventlist as $event) { // filter by category
                $has_category = false; // sentinel

                // Associate the events category
                $event['category'] = $event->eventcategories()->get();

                foreach ($event['category'] as $ev_cat) {
                    // Loop through to find if the category matches.
                    if ($ev_cat['id'] == $id) {
                        $has_category = true;
                    }
                }
                if ($has_category == false) {
                    // Destroy event. if it doesn't have the category.
                    unset($eventlist[$i]);
                }
                $i++;
            }
        }

        // Group events by day for the 7-day list view. Multi-day events appear on
        // every day they run, not just on their start date.
        $rangeStart = $cdate_start->copy()->startOfDay();
        $rangeEnd = $cdate_end->copy()->startOfDay();
        $groupedByDay = collect();

        for ($day = $rangeStart->copy(); $day->lte($rangeEnd); $day->addDay()) {
            $key = $day->format('Y-n-j');
            $dayEvents = $eventlist->filter(function ($event) use ($day) {
                $eventStart = Carbon::parse($event->start_date)->startOfDay();
                // Events without an end_date are treated as single-day events.
                $eventEnd = $event->end_date
                    ? Carbon::parse($event->end_date)->startOfDay()
                    : $eventStart->copy();

                return $day->gte($eventStart) && $day->lte($eventEnd);
            })->sortBy(function ($event) {
                return Carbon::parse($event->start_date)->format('Y-m-d') . ' ' . ($event->start_time ?? '');
            })->values();

            // Skip days with no events so the response only includes populated headings.
            if ($dayEvents->isNotEmpty()) {
                $groupedByDay->put($key, $dayEvents);
            }
        }
        $yearVar = $cdate_start->year;
        $monthVarWord = $cdate_start->format('F');
        $monthVar = $cdate_start->month;
        $dayVar = $cdate_start->day;
        $firstDate = $cdate_start->format('l, F j');
        $lastDate = $cdate_end->format('l, F j');

        return ['groupedByDay' => $groupedByDay,
            'yearVar' => $yearVar,
            'monthVar' => $monthVar,
            'monthVarWord' => $monthVarWord,
            'dayVar' => $dayVar,
            'firstDate' => $firstDate,
            'lastDate' => $lastDate
        ];
    }


    public function eventsByDate($year = null, $month = null, $day = null)
    {
        $cdate = Carbon::now()->subYear();

        $yearVar = $cdate->year;
        $monthVar = $cdate->month;
        $monthVarWord = $cdate->format('F');
        $dayInMonth = $cdate->day;
        $cd_dayMonthStarts = $cdate->firstOfMonth()->dayOfWeek;
        $cd_daysInMonth = $cdate->daysInMonth;

        $cdate_monthstart = Carbon::create($yearVar, $monthVar, 1, 12);

        $cdate_monthend = Carbon::create($yearVar, $monthVar, $cd_daysInMonth, 12);

        $eventlist = Event::select('id', 'title', 'start_date', 'end_date')->where([
            ['start_date', '>=', $cdate_monthstart],
            ['start_date', '<=', $cdate_monthend],
            ['is_hidden', '0'],
            ['is_archived', '0']
        ])->get();


        $eventlistcount = $eventlist->count();

        $grouped = Event::select('id', 'title', 'start_date', 'end_date')
            ->where([
                ['start_date', '>=', $cdate_monthstart],
                ['start_date', '<=', $cdate_monthend],
                ['is_hidden', 0],
                ['is_archived', '0']
            ])->orderBy('start_date', 'asc')->get();

        $groupedByDay = $grouped->groupBy(function ($date) {
            return Carbon::parse($date->start_date)->format('j');
        });

        $keyed = $eventlist->keyBy(function ($item) {
            return Carbon::parse($item['start_date'])->day;
        });
        $uniqueByDay = $keyed->keys();
        $calDaysArray = collect();
        $dayCounter = 0;
        while ($dayCounter < $cd_dayMonthStarts) {
            $dayObject = collect(['day' => 'x' . $dayCounter, 'hasevents' => 'no']);
            $calDaysArray->push($dayObject);

            $dayCounter++;
        }

        for ($x = 1; $x <= $cd_daysInMonth; $x++) {
            $hasevent = $uniqueByDay->contains($x) ? 'yes' : 'no';
            $dayObject = collect(['day' => $x, 'hasevents' => $hasevent]);
            $calDaysArray->push($dayObject);
        }

        return ['groupedByDay' => $groupedByDay,
            'elist2' => $eventlist,
            'eachItems' => $eventlistcount,
            'uniqueByDay' => $uniqueByDay,
            'yearVar' => $yearVar,
            'monthVar' => $monthVar,
            'monthVarWord' => $monthVarWord,
            'monthArray' => $calDaysArray,
            'dayInMonth' => $dayInMonth];
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
        if ($year == null) {
            $cdate_start = Carbon::now()->startOfMonth();
            $cdate_end = Carbon::now()->endOfMonth();
            $selectedDate = Carbon::now();
        } else {
            if ($month == null) {
                $currentMonth = Carbon::now()->month;
                $currentDay = Carbon::now()->day;
                $selectedDate = Carbon::create($year, $currentMonth, $currentDay);
                $cdate_start = Carbon::create($year, $currentMonth, $currentDay)->startOfMonth();
                $cdate_end = Carbon::create($year, $currentMonth, 1)->endOfMonth();
            } else {
                if ($day == null) {
                    $selectedDate = Carbon::create($year, $month, 1);
                    $cdate_start = Carbon::create($year, $month, 1)->startOfMonth();
                    $cdate_end = Carbon::create($year, $month, 1)->endOfMonth();
                } else {
                    $selectedDate = Carbon::create($year, $month, $day);
                    $cdate_start = Carbon::create($year, $month, $day)->startOfMonth();
                    $cdate_end = Carbon::create($year, $month, 1)->endOfMonth();
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

        $selectedMonth_StartOnDay = $cdate_start->firstOfMonth()->dayOfWeek;
        $selectedMonth_daysInMonth = $cdate_start->daysInMonth;

        $eventsInMonth = Event::select('id', 'start_date', 'end_date')
            ->where([
                ['is_approved', 1],
                ['is_hidden', 0],
                ['is_archived', '0'],
            ])
            ->where('start_date', '<=', $cdate_end)
            ->whereRaw('COALESCE(end_date, start_date) >= ?', [$cdate_start])
            ->get();

        // Build a list of calendar day numbers (1-31) that have at least one event.
        // Multi-day events mark every day they span, not just their start date.
        $monthStart = $cdate_start->copy()->startOfDay();
        $monthEnd = $cdate_end->copy()->startOfDay();
        $uniqueByDay = collect();

        foreach ($eventsInMonth as $event) {
            $eventStart = Carbon::parse($event->start_date)->startOfDay();
            // Events without an end_date are treated as single-day events.
            $eventEnd = $event->end_date
                ? Carbon::parse($event->end_date)->startOfDay()
                : $eventStart->copy();

            // Clamp the event to the visible month so days outside the month are ignored.
            $rangeStart = $eventStart->greaterThan($monthStart) ? $eventStart : $monthStart;
            $rangeEnd = $eventEnd->lessThan($monthEnd) ? $eventEnd : $monthEnd;

            if ($rangeStart->greaterThan($rangeEnd)) {
                continue;
            }

            for ($day = $rangeStart->copy(); $day->lte($rangeEnd); $day->addDay()) {
                $uniqueByDay->push($day->day);
            }
        }

        $uniqueByDay = $uniqueByDay->unique()->sort()->values();

        // Build the calendar grid payload consumed by the Vue sidebar widget.
        $calDaysArray = collect();
        $dayCounter = 0;

        // Pad the first week with placeholder cells so day 1 aligns under the correct weekday.
        while ($dayCounter < $selectedMonth_StartOnDay) {
            $dayObject = collect(['day' => 'x' . $dayCounter, 'hasevents' => 'no-events']);
            $calDaysArray->push($dayObject);
            $dayCounter++;
        }

        // One entry per day in the month; hasevents drives the event indicator styling.
        for ($x = 1; $x <= $selectedMonth_daysInMonth; $x++) {
            $hasevent = $uniqueByDay->contains($x) ? 'yes-events' : 'no-events';
            $dayObject = collect(['day' => $x, 'hasevents' => $hasevent]);
            $calDaysArray->push($dayObject);

            $dayCounter++;
        }

        return [
            'uniqueByDay' => $uniqueByDay,
            'calDaysArray' => $calDaysArray,
            'selectedYear' => $selectedYear,
            'selectedMonth' => $selectedMonth,
            'selectedMonthWord' => $selectedMonthWord,
            'selectedDay' => $selectedDay,
            'currentYear' => $currentYear,
            'currentMonth' => $currentMonth,
            'currentMonthWord' => $currentMonthWord,
            'currentDay' => $currentDay,
        ];
    }


    public function byDate(Request $request)
    {
        return $request->all();
    }
}
