<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'cea_categories';

    public function scopeLikeSearch($query, $field, $value){
        return $query->where($field, 'LIKE', "%$value%");
    }

    public function events() {
        return $this->belongsToMany('Emutoday\Event', 'cea_category_event', 'category_id', 'event_id');
    }
}
