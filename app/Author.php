<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function getFullNameAttribute(){
        return $this->last_name . ', '. $this->first_name;
    }
}
