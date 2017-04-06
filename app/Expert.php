<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;

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
        return $this->storyImages()->create([
            'image_name'=> 'img' . $this->id . '_expert',
            'image_type'=> 'imageexpert',
        ]);
    }

    public function storyImage()
    {
        return $this->hasOne(ExpertImage::class);
    }

    public function images()
    {
        return $this->hasOne('Emutoday\ExpertImage');
    }
}
