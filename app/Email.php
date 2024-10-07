<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use DateTimeInterface;

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
      'send_at',
      'is_president_included',
      'exclude_events',
			'exclude_insideemu',
      'president_teaser',
      'president_url',
      'is_emu175_included',
      'emu175_teaser',
      'emu175_url',
  ];

  protected $casts = [
      'send_at' => 'datetime',
      'deleted_at' => 'datetime'
  ];

  public function announcements() {
    return $this->belongsToMany('Emutoday\Announcement', 'email_announcement')->withPivot('order')->orderBy('order')->withTimestamps();
  }

  public function events() {
    return $this->belongsToMany('Emutoday\Event', 'email_event')->withPivot('order')->orderBy('order')->withTimestamps();
  }

	public function insideemuPosts() {
		return $this->belongsToMany('Emutoday\InsideemuPost', 'email_insideemu')->withPivot('order')->orderBy('order')->withTimestamps();
	}

  /**
   * The main stories (with pictures). Each email must have 1 main story but can have 3.
   */
  public function mainstories() {
    return $this->belongsToMany('Emutoday\Story', 'email_mainstory')->withPivot('order')->orderBy('order')->withTimestamps();
  }

	/**
	 * As of 10/2/2024, the main stories can also be Inside EMU posts.
	 */
	public function maininsideemuposts(){
		return $this->belongsToMany('Emutoday\InsideemuPost', 'email_mainstory')->withPivot('order')->orderBy('order')->withTimestamps();
	}

  /**
   * The list of stories
   */
  public function stories() {
    return $this->belongsToMany('Emutoday\Story', 'email_story')->withPivot('order')->orderBy('order')->withTimestamps();
  }

  public function recipients() {
    return $this->belongsToMany('Emutoday\MailingList', 'email_recipients', 'email_id', 'mailinglist_id')->withTimestamps();
  }

  public function clonedEmail() {
    return $this->belongsTo('Emutoday\Email', 'clone_email_id');
  }

  /**
   * ADDED FOR LARAVEL 7 TO KEEP EXISTING DATETIME FORMAT
   * https://laravel.com/docs/7.x/upgrade#date-serialization
   * Prepare a date for array / JSON serialization.
   *
   * @param \DateTimeInterface $date
   * @return string
   */
  protected function serializeDate(DateTimeInterface $date) {
    return $date->format('Y-m-d H:i:s');
  }
}
