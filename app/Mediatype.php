<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;

class Mediatype extends Model
{

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'group','type','name',
        'width','height','infotxt',
        'helptxt','rules','notes'
    ];
    /**
    * Scope a query to only include popular users.
    *
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeOfGroup($query, $group)
    {
        return $query->where('group', $group);
    }

    /**
    * Scope a query to only include active users.
    *
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeIsRequired($query, $bool)
    {
        return $query->where('is_required', $bool);
    }


    /**
    * The one-to-many relationship with storyImages
    */
    public function mediafiles()
    {
        return $this->hasMany('Emutoday\Mediafile');
    }
}
