<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = [
      'name'
    ];
    /**
     * Get the manyToMany relationship from Story
     * @return [type] [description]
     */
    public function storys()
    {
        return $this->belongsToMany('Emutoday\Story', 'story_tag', 'tag_id', 'story_id')
        ->withTimestamps();
    }

    public function scopeLikeSearch($query, $field, $value){
        return $query->where($field, 'LIKE', "%$value%");
    }

}
