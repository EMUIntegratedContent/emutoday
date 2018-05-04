<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Emutoday\User;
use Emutoday\StoryIdeaMedium;

class StoryIdea extends Model
{
  protected $fillable = [
      'title',
      'idea',
      'creator',
      'assignee',
      'is_completed',
      'medium',
  ];
  protected $dates = ['deadline'];

  /**
   * This story idea's creator
   * HINT: 'id' is the id field of the User class, 'creator' is the creator field of the StoryIdea class
   */
   public function creator(){
     return $this->hasOne(User::class, 'id', 'creator');
   }

   /**
    * This user to whom this idea was assigned
    */
    public function assignee(){
      return $this->hasOne(User::class, 'assignee','id');
    }

  /**
   * This story idea's medium
   */
   public function medium(){
     return $this->hasOne(StoryIdeaMedium::class, 'id', 'medium');
   }
}
