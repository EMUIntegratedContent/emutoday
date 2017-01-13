<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;

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
}
