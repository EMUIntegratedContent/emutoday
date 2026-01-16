<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MiniCalendar extends Model
{

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'cea_mini_calendars';
  public $timestamps = false;

  /**
   * Mass assignable attributes
   */
  protected $fillable = ['calendar', 'slug', 'parent'];

  /**
   * Relationship to events (many-to-many)
   */
  public function events()
  {
    return $this->belongsToMany('Emutoday\\Event', 'cea_event_minicalendar' , 'mini_calendar_id', 'event_id');
  }

  /**
   * Parent mini calendar (single)
   */
  public function parentCalendar()
  {
    return $this->belongsTo(self::class, 'parent');
  }

  /**
   * Children mini calendars
   */
  public function children()
  {
    return $this->hasMany(self::class, 'parent');
  }

  /**
   * Scope helper for like searches
   */
  public function scopeLikeSearch($query, $field, $value){
    return $query->where($field, 'LIKE', "%$value%");
  }

  /**
   * Ensure slug is stored in kebab-case when set programmatically
   */
  public function setSlugAttribute($value)
  {
    if (is_null($value) || $value === '') {
      $this->attributes['slug'] = null;
      return;
    }

    $this->attributes['slug'] = Str::slug($value);
  }

}
