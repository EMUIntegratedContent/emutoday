<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;

class AnnouncementType extends Model
{
    public function announcements()
    {
        return $this->hasMany('Emutoday\Announcement', 'type','shortname');
    }
    

}
