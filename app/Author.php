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
  ];

  public function getFullNameAttribute(){
    return $this->last_name . ', '. $this->first_name;
  }
  public function scopeLikeSearch($query, $field, $value){
    return $query->where($field, 'LIKE', "%$value%");
  }
}
