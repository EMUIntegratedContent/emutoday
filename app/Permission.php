<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Emutoday\Role;

class Permission extends Model
{
    protected $fillable = ['name', 'label'];

        public function roles()
        {
            return $this->belongsToMany('Emutoday\Role');
        }
}
