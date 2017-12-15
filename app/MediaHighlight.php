<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Emutoday\MediaHighlight\Searchable;
use Sofa\Eloquence\Eloquence;

class MediaHighlight extends Model
{
    use Eloquence;
    
    protected $fillable = [
      'title',
      'url',
      'source',
      'priority',
      'is_archived',
      'added_by'
    ];

    protected $searchableColumns = [
        'title' => 100,
        'source' => 90
    ];

    protected $dates = [
      'start_date'
    ];

    public function tags(){
      return $this->belongsToMany('Emutoday\MediaHighlightTag', 'mediahighlights_tags', 'mediahighlight_id', 'tag_id')->withTimestamps();
    }

    public function addedBy(){
        return $this->belongsTo('Emutoday\User', 'added_by');
    }

    public function getFullNameAttribute(){
        return $this->addedBy()->first()->first_name . ' '. $this->addedBy()->first()->last_name;
    }
}
