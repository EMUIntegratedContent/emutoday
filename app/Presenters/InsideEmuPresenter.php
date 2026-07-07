<?php

namespace Emutoday\Presenters;

use Laracasts\Presenter\Presenter;
use Carbon\Carbon;

class InsideEmuPresenter extends Presenter
{

    public function postedDate()
    {
        if ($this->start_date) {
            if ($this->start_date == '0000-00-00 00:00:00'){
                $carbondate = Carbon::create(2016,5,5,5,5,5);
            } else {
                $carbondate = Carbon::parse($this->start_date);
            }
            return $carbondate->format('Y-m-d');
        }

        return 'Not Posted';
    }

}
