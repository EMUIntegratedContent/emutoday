<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Emutoday\Permission;

class Role extends Model
{
    protected $fillable = ['name', 'label'];

      public function permissions()
        {
            return $this->belongsToMany('Emutoday\Permission');
        }

        public function givePermissionTo(Permission $permission)
        {
            return $this->permissions()->save($permission);
        }
}
