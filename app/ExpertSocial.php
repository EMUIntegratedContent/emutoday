<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
class ExpertSocial extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'expertssocial';

    protected $fillable = [
        'title',
        'url'
    ];


    /**
    * All of the relationships to be touched (updated_at field will be updated).
    *
    * @var array
    */
    protected $touches = ['expert'];

    public function expert()
    {
        return $this->belongsTo('Emutoday\Expert');
    }

}
