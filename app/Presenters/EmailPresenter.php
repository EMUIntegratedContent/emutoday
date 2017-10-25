<?php

namespace Emutoday\Presenters;

use Laracasts\Presenter\Presenter;
use Carbon\Carbon;

class EmailPresenter extends Presenter
{
    public function emailScheduleStatus()
    {
        if ($this->send_at && $this->send_at->isFuture() && ($this->is_approved == 0 || $this->is_ready == 0)) {
            return 'warning';
        } elseif ($this->send_at && $this->send_at->isFuture() && $this->is_approved == 1 && $this->is_ready == 1) {
            return 'success';
        } else {
            return 'isproblem';
        }

    }

    public function prettySendAtDate()
    {
      if($this->send_at){
        return $this->send_at->format('D m-d-Y @ g:i A');
      }

      return 'Date not set.';
    }

}
