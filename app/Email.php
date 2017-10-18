<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Email extends Model
{
  protected $table = 'emails';
  protected $fillable = [
      'title',
      'subheading',
      'is_approved',
      'is_ready',
      'mainstory_id',
      'is_sent',
      'send_at'
    ];

  protected $dates = ['send_at', 'deleted_at'];

  public function announcements()
  {
      return $this->belongsToMany('Emutoday\Announcement', 'email_announcement')->withPivot('order')->withTimestamps();
  }

  public function events()
  {
      return $this->belongsToMany('Emutoday\Event', 'email_event')->withPivot('order')->withTimestamps();
  }

  public function stories()
  {
      return $this->belongsToMany('Emutoday\Story', 'email_story')->withPivot('order')->withTimestamps();
  }

  public function recipients()
  {
      return $this->belongsToMany('Emutoday\MailingList', 'email_recipients', 'email_id', 'mailinglist_id')->withTimestamps();
  }

/*
  public function sendTimes(){
    return $this->hasMany('Emutoday\EmailSendTimes')
  }
  */
}
