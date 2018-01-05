<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class MailingList extends Model
{
  protected $table = 'mailinglists';
  protected $fillable = [
      'email_address',
      'description',
    ];

  public function emails()
  {
      return $this->belongsToMany('Emutoday\Email', 'email_recipients');
  }
}
