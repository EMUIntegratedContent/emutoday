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

  public function announcements()
  {
      return $this->belongsToMany('Emutoday\Announcement', 'email_announcement');
  }

  public function events()
  {
      return $this->belongsToMany('Emutoday\Event', 'email_event');
  }

  public function stories()
  {
      return $this->belongsToMany('Emutoday\Story', 'email_story');
  }

/*
  public function sendTimes(){
    return $this->hasMany('Emutoday\EmailSendTimes')
  }
  */
}
