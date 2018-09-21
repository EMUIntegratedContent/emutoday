<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Laracasts\Presenter\PresentableTrait;

class Email extends Model
{
  use PresentableTrait;
  protected $presenter = 'Emutoday\Presenters\EmailPresenter';

  protected $table = 'emails';
  protected $fillable = [
      'title',
      'subheading',
      'is_approved',
      'is_ready',
      'is_sent',
      'send_at'
    ];

  protected $dates = ['send_at', 'deleted_at'];

  public function announcements()
  {
      return $this->belongsToMany('Emutoday\Announcement', 'email_announcement')->withPivot('order')->orderBy('order')->withTimestamps();
  }

  public function events()
  {
      return $this->belongsToMany('Emutoday\Event', 'email_event')->withPivot('order')->orderBy('order')->withTimestamps();
  }

  /**
   * The main stories (with pictures). Each email must have 1 main story but can have 3.
   */
  public function mainstories()
  {
      return $this->belongsToMany('Emutoday\Story', 'email_mainstory')->withPivot('order')->orderBy('order')->withTimestamps();
  }

  /**
   * The list of stories
   */
  public function stories()
  {
      return $this->belongsToMany('Emutoday\Story', 'email_story')->withPivot('order')->orderBy('order')->withTimestamps();
  }

  public function recipients()
  {
      return $this->belongsToMany('Emutoday\MailingList', 'email_recipients', 'email_id', 'mailinglist_id')->withTimestamps();
  }

  public function clonedEmail()
  {
      return $this->belongsTo('Emutoday\Email', 'clone_email_id');
  }

/*
  public function sendTimes(){
    return $this->hasMany('Emutoday\EmailSendTimes')
  }
  */
}
