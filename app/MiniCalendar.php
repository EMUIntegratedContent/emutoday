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
  protected $fillable = ['calendar', 'slug', 'parent', 'admin_only'];

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
   * Scope to return mini calendars for the current user
   * If the user is not an admin, only show mini calendars that are not admin only
   * @param mixed $query
   * @return mixed
   */
  public function scopeForUser($query)
  {
    $query->select('calendar', 'id as value', 'parent')
      ->where('calendar', '<>', 'Welcome Weeks')
      ->orderBy('calendar', 'asc');

    if (!auth()->user()->isAdmin()) {
      $query->where('admin_only', false);
    }

    return $query;
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
