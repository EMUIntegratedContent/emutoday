<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;

class MediaHighlightTag extends Model
{
  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = true;
  protected $fillable = [
    'name'
  ];

  protected $dates = [

  ];

  public function mediahighlights(){
    return $this->belongsToMany('Emutoday\MediaHighlight', 'mediahighlights_tags', 'mediahighlight_id', 'tag_id')->withTimestamps();
  }
}
