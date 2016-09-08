<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
  /**
  * The database table used by the model.
  *
  * @var string
  */
  protected $table = 'cea_buildings';

  /**
  * Scope the query to records of map = illustrated.
  *
  * @param  Builder $query
  * @return mixed
  */
  public function scopeOfMapType($query, $type)
  {
    return $query->where('map', $type);
  }

  public function scopeLikeSearch($query, $field, $value){
    return $query->where([
      ['map', 'illustrated'],
      [$field, 'LIKE', "%$value%"],
    ]);
  }
}
