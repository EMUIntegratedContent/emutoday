<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use DateTimeInterface;

class StudentEmail extends Model
{
  use PresentableTrait;

  protected $presenter = 'Emutoday\Presenters\StudentEmailPresenter';

  protected $table = 'student_emails';
  protected $fillable = [
      'title',
      'subheading',
      'is_approved',
      'is_ready',
      'is_sent',
      'send_at',
      'exclude_events',
      'exclude_insideemu',
  ];

  protected $casts = [
      'send_at' => 'datetime',
      'deleted_at' => 'datetime'
  ];

  public function announcements() {
    return $this->belongsToMany('Emutoday\Announcement', 'student_email_announcement', 'student_email_id', 'announcement_id')->withPivot('order')->orderBy('order')->withTimestamps();
  }

  public function events() {
    return $this->belongsToMany('Emutoday\Event', 'student_email_event', 'student_email_id', 'event_id')->withPivot('order')->orderBy('order')->withTimestamps();
  }

  public function insideemuPosts() {
    return $this->belongsToMany('Emutoday\InsideemuPost', 'student_email_insideemu', 'student_email_id', 'insideemu_post_id')->withPivot('order')->orderBy('order')->withTimestamps();
  }

  /**
   * The single featured story. A student email has exactly one featured item, which may be a Story...
   */
  public function mainstories() {
    return $this->belongsToMany('Emutoday\Story', 'student_email_mainstory', 'student_email_id', 'story_id')->withTimestamps();
  }

  /**
   * ...or a Campus Life (Inside EMU) post. Same pivot table as mainstories().
   */
  public function maininsideemuposts() {
    return $this->belongsToMany('Emutoday\InsideemuPost', 'student_email_mainstory', 'student_email_id', 'insideemu_post_id')->withTimestamps();
  }

  /**
   * More News (the side stories listing)
   */
  public function stories() {
    return $this->belongsToMany('Emutoday\Story', 'student_email_story', 'student_email_id', 'story_id')->withPivot('order')->orderBy('order')->withTimestamps();
  }

  public function recipients() {
    return $this->belongsToMany('Emutoday\StudentMailinglist', 'student_email_recipients', 'student_email_id', 'student_mailinglist_id')->withTimestamps();
  }

  public function clonedEmail() {
    return $this->belongsTo('Emutoday\StudentEmail', 'clone_student_email_id');
  }

  /**
   * Keep the existing datetime format on serialization.
   *
   * @param \DateTimeInterface $date
   * @return string
   */
  protected function serializeDate(DateTimeInterface $date) {
    return $date->format('Y-m-d H:i:s');
  }
}
