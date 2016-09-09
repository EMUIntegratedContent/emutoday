<?php

namespace Emutoday;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'last_name', 'first_name', 'phone', 'email', 'password',
    ];
    protected $dates = ['last_login_at'];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * [setPasswordAttribute description]
     * @param [type] $value [description]
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * [getFullNameAttribute description]
     * @return [type] [description]
     */
    public function getFullNameAttribute(){
        return $this->last_name . ', '. $this->first_name;
    }

    /*******
    *
    *  RELATIONSHIPS
    *
    ******** /

    /**
     * [storys description]
     * @return [type] [description]
     */
    public function storys()
    {
        return $this->hasMany('Emutoday\Story', 'user_id');
    }
    /**
     * [mediaFiles description]
     * @return [type] [description]
     */
    public function mediaFiles()
    {
        return $this->belongsToMany('Emutoday\Mediafile');
    }
    /**
     * [announcements description]
     * @return [type] [description]
     */
    public function announcements()
    {
        return $this->hasMany('Emutoday\Announcement', 'user_id');
    }

    /**
     * [events description]
     * @return [type] [description]
     */
    public function events() {
        return $this->hasMany('Emutoday\Event', 'user_id');
    }

    /**
     * [bugztracked description]
     * @return [type] [description]
     */
    public function bugztracked(){
        return $this->hasMany('Emutoday\Bugz', 'user_id');
    }



}
