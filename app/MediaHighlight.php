<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;

class MediaHighlight extends Model
{
    protected $fillable = [
      'title',
      'url',
      'source',
      'priority',
      'is_archived',
      'added_by_user'
    ];

    protected $dates = [
      'start_date'
    ];

    public function tags(){
      return $this->belongsToMany('Emutoday\MediaHighlight', 'mediahighlights_tags', 'mediahighlight_id', 'tag_id')->withTimestamps();
    }
}
