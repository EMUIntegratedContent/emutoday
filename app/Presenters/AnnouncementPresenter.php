<?php

namespace Emutoday\Presenters;

use Laracasts\Presenter\Presenter;
use Carbon\Carbon;

class AnnouncementPresenter extends Presenter
{

  public function prettyDate()
  {
      if ($this->start_date) {
          if ($this->start_date == '0000-00-00 00:00:00'){
            $carbondate = Carbon::create(2016,5,5,5,5,5);
          } else {
              $carbondate = Carbon::parse($this->start_date);
          }
          return $carbondate->toFormattedDateString();
      }

      return 'Not Published';
  }


  public function timelineHighlight()
  {
      if ($this->start_date && $this->end_date) {
          if ($this->end_date->isPast()) {
            //event is over
              return 'medium-gray';
          } elseif ($this->start_date->isFuture()) {
            //event is upcoming
              return 'warning';
          } elseif ($this->start_date->isPast() && $this->end_date->isFuture()) {
            //event is going on right now
              return 'success';
          } else {
              return 'alert';
          }

      } else {
        return 'alert';
      }
  }

}
