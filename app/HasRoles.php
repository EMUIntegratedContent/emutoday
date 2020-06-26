<?php

namespace Emutoday;

trait HasRoles
{
    /**
     * User may have multiple Roles
     * @return [type] [description]
     */
    public function roles()
    {
        return $this->belongsToMany('Emutoday\Role');
    }


    /**
     * Assign the given Role to User
     * @param  [type] $role [description]
     * @return [type]       [description]
     */
    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }

    /**
     * determine if User has the given role by
     * getting all the roles for the user
     * and find if equal to the necessary role
     * @param  [type]  $role [description]
     * @return boolean       [description]
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }

    /**
     * Detemine if User may perform the given permission
     *
     * @param  Permission $Permission [description]
     * @return boolean                [description]
     */
    public function hasPermission(Permission $Permission)
    {
        return $this->hasRole($permission->roles);
    }
}
