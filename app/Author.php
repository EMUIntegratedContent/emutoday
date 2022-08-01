<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Author extends Model
{
  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'phone',
    'is_contact',
    'is_principal_contact',
    'user_id',
  ];

  public function getFullNameAttribute(){
    return $this->last_name . ', '. $this->first_name;
  }
  public function scopeLikeSearch($query, $field, $value){
    return $query->where($field, 'LIKE', "%$value%");
  }

    public function user()
    {
        return $this->hasOne('Emutoday\User');
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
