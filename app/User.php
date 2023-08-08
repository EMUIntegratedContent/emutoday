<?php

namespace Emutoday;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Emutoday\Mediafile;
use Sofa\Eloquence\Eloquence;
use Laravel\Passport\HasApiTokens;
use DateTimeInterface;

class User extends Authenticatable
{
    use HasRoles, Notifiable, HasApiTokens;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'last_name', 'first_name', 'phone', 'email', 'hidden'
    ];
    protected $casts = [
			'last_login_at' => 'datetime'
		];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

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

    public function isEditor() {
        return $this->hasRole('editor');
    }

    public function isExpertsEditor() {
        return $this->hasRole('experts');
    }

    public function isEmailBuilder() {
        return $this->hasRole('emails');
    }

    /**
     * ADDED FOR LARAVEL 7 TO KEEP EXISTING DATETIME FORMAT
     * https://laravel.com/docs/7.x/upgrade#date-serialization
     * Prepare a date for array / JSON serialization.
     *
     * @param \DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
