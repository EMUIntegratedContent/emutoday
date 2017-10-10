<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Email extends Model
{
  protected $table = 'emails';
  protected $fillable = [
      'title',
      'frequency',
      'send_at',
      'stop_at',
    ];

  protected $dates = ['send_at', 'stop_at'];

/*
  public function sendTimes(){
    return $this->hasMany('Emutoday\EmailSendTimes')
  }
  */
}
