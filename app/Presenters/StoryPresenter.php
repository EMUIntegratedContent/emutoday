<?php

namespace Emutoday\Presenters;

use Laracasts\Presenter\Presenter;
use Carbon\Carbon;

class StoryPresenter extends Presenter
{

    public function publishedDate()
    {
        if ($this->start_date) {
            if ($this->start_date == '0000-00-00 00:00:00'){
                $carbondate = Carbon::create(2016,5,5,5,5,5);
            } else {
                $carbondate = Carbon::parse($this->start_date);
            }
            return $carbondate->format('Y-m-d');
        }

        return 'Not Published';
    }
    public function publishedEndDate()
    {
        if ($this->end_date) {
            if ($this->end_date == '0000-00-00 00:00:00'){
                $carbondate = Carbon::create(2016,5,5,5,5,5);
            } else {
                $carbondate = Carbon::parse($this->end_date);
            }
            return $carbondate->format('m-d-Y');
        }

        return 'No End Date';
    }
    public function publishedStartDate()
    {
        if ($this->start_date) {
            if ($this->start_date == '0000-00-00 00:00:00'){
                $carbondate = Carbon::create(2016,5,5,5,5,5);
            } else {
                $carbondate = Carbon::parse($this->start_date);
            }
            return $carbondate->format('m-d-Y');
        }

        return 'Not Published';
    }
    public function publishedHighlight()
    {
        if ($this->start_date && $this->start_date->isFuture()) {
            return 'isfuture';
        } elseif ($this->start_date && $this->start_date->isPast() && $this->end_date && $this->end_date->isFuture()) {
            return 'iscurrent';
        } elseif ($this->end_date && $this->end_date->isPast()) {
            return 'ispast';
        } else {
            return 'isproblem';
        }
    }


}
