<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;

class StudentMailinglist extends Model
{
  protected $table = 'student_mailinglists';
  protected $fillable = [
      'email_address',
      'description',
      'show',
    ];

  public function studentEmails()
  {
      return $this->belongsToMany('Emutoday\StudentEmail', 'student_email_recipients', 'student_mailinglist_id', 'student_email_id');
  }
}
