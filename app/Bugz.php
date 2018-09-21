<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;

class Bugz extends Model
{

    protected $fillable = [
        'type', 'screen',
        'notes', 'priority',
        'complete','confirmed'
    ];

    protected $dates = ['created_at','updated_at'];


    public function user()
    {
        return $this->belongsTo('Emutoday\User');
    }
}
