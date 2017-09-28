<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
class ExpertLanguages extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'expertslanguages';

    protected $fillable = [
        'language'
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
