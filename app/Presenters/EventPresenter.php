<?php

namespace Emutoday\Presenters;

use Laracasts\Presenter\Presenter;

class EventPresenter extends Presenter
{
  public function eventStartDateYear(){

        //return $this->start_date;
        return  date_format($this->start_date, "Y");
    }
  public function eventStartDateMonthUnit(){

        //return $this->start_date;
        return  date_format($this->start_date, "n");
    }
  public function eventStartDateMonth(){

        //return $this->start_date;
        return  date_format($this->start_date, "M");
    }
    public function eventStartDateDay(){

      //  return $this->start_date;
        return  date_format($this->start_date, "d");
    }

    public function eventListDateString(){

      return date_format($this->start_date, 'D F j\\, Y');
    }

    public function eventFeaturedDateString(){

      return date_format($this->start_date, 'M d');
    }
    //From 10:00 AM to 5:00 PM
    public function displayTimeRange()
    {
      if ($this->no_end_time){
        return $this->start_time;
      } else {
        return $this->start_time . ' to ' . $this->end_time;
      }
    }

}
