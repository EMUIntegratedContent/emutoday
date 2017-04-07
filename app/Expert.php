<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Emutoday\StoryImage;

class Expert extends Model
{
  protected $fillable = [
    'first_name',
    'last_name',
    'title',
    'expertise',
    'about',
    'education',
  ];

  public function getFullNameAttribute(){
    return $this->last_name . ', '. $this->first_name;
  }

    public function expertCategories()
	{
		return $this->belongsToMany('Emutoday\ExpertCategory', 'experts_expertcategory', 'expert_id', 'cat_id');
	}

    public function addImage()
    {
        return $this->expertImages()->create([
            'image_name'=> 'img' . $this->id . '_expert',
            'image_type'=> 'headshot',
        ]);
    }

    public function expertImages()
    {
        return $this->hasMany('Emutoday\ExpertImage');
    }

    public function images()
    {
        return $this->hasMany('Emutoday\ExpertImage');
    }
}
