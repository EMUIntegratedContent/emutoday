<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;

class StoryType extends Model
{

    protected $fillable = ['name', 'shortname'];

    /**
     * [storys description]
     * @return [type] [description]
     */
    public function storys()
    {
        return $this->hasMany('Emutoday\Story', 'story_type');
    }


}
