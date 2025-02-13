<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;

class StoryIdeaMedium extends Model
{
  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = true;

  /**
   * The database table used by the model.
   *
   * @var string
   */
   protected $table = 'storyidea_mediums';

   protected $fillable = [
       'medium',
   ];

   /**
    * The story ideas that are of this medium
    */
   public function storyIdeas(){
     return $this->belongsToMany(StoryIdea::class);
   }
}
