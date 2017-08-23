<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Emutoday\Experts\Searchable;

class ExpertMediaRequest extends Model
{

    protected $table = 'expertmedia_request';

  protected $fillable = [
    'name',
    'title',
    'media_outlet',
    'city',
    'state',
    'phone',
    'email',
    'deadline',
    'interview_type',
    'description',
  ];

  public function expert(){
      return $this->hasOne('Emutoday\Expert', 'id', 'expert_id');
  }
}
