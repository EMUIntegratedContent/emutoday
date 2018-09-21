<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Emutoday\Experts\Searchable;

class ExpertSpeakerRequest extends Model
{

    protected $table = 'expertspeaker_request';

  protected $fillable = [
    'organization',
    'org_description',
    'org_website',
    'contact_name',
    'contact_phone',
    'contact_email',
    'time_needed',
    'length_of_presentation',
    'location',
    'event_description',
    'topic'
  ];

    public function expert(){
        return $this->hasOne('Emutoday\Expert', 'id', 'expert_id');
    }
}
