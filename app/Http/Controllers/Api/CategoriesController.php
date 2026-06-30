<?php

namespace Emutoday\Http\Controllers\Api;

use Emutoday\Category;
use Emutoday\Event;
use Carbon\Carbon;


class CategoriesController extends ApiController
{
  public function activeCategories($year = null, $month = null, $day = null)
  {
    if ($year == null) {
      $mondifier = "all";
    } else {
      if ($month == null) {
        $mondifier = "Y";
      } else if ($day == null) {
        $mondifier = "YM";
      } else {
        $mondifier = "YMD";
      }
    }

    if ($mondifier == "all") {
      $cdate_start = Carbon::now()->startOfDay();
      $cdate_end = Carbon::now()->addDays(7)->endOfDay();
    } else if ($mondifier == "Y") {
      $cdate_start = Carbon::create($year, 1, 1)->startOfDay();
      $cdate_end = Carbon::create($year, 12, 31)->endOfDay();
    } else if ($mondifier == "YM") {
      $cdate_start = Carbon::create($year, $month, 1)->startOfDay();
      $cdate_daysInMonth = $cdate_start->daysInMonth;
      $cdate_end = Carbon::create($year, $month, $cdate_daysInMonth)->endOfDay();
    } else {
      $cdate_start = Carbon::create($year, $month, $day)->startOfDay();
      $cdate_end = Carbon::create($year, $month, $day)->addDays(7)->endOfDay();
    }

    $activateCategories = Category::with(['events' => function ($query) use ($cdate_start, $cdate_end) {
      $query->approvedForCalendar()
        ->overlappingDateRange($cdate_start, $cdate_end)
        ->orderBy('start_date')
        ->orderBy('start_time', 'asc')
        ->addSelect('id', 'title', 'start_date', 'end_date');
    }])->addSelect('id', 'category', 'slug')->orderBy('category', 'asc')->get();

    return $this->respond($activateCategories);
  }

  /**
   * [getCategories description]
   * @param  [type] $eventid [description]
   * @return [type]          [description]
   */
  private function getCategories($eventid)
  {
    $categories = $eventid ? Event::findOrFail($eventid)->categories : Category::all();
    return $categories;
  }
}
