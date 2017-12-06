<?php

namespace Emutoday;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Emutoday\Mediafile;
use Sofa\Eloquence\Eloquence;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasRoles, Notifiable, HasApiTokens;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'last_name', 'first_name', 'phone', 'email',
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
    use Eloquence;
    protected $searchableColumns = ['last_name', 'first_name', 'email'];

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

    public function roles()
    {
        return $this->belongsToMany('Emutoday\Role');
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

    public function isAdmin() {
        if($this->hasRole('admin') || $this->hasRole('admin_super')){
            return true;
        }
        return false;
    }

    public function isExpertsEditor() {
        return $this->hasRole('experts');
    }

    public function isEmailBuilder() {
        return $this->hasRole('emails');
    }
}
