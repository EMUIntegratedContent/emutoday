<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Emutoday\StoryImage;
use Emutoday\Experts\Searchable;
use Sofa\Eloquence\Eloquence;
use DateTimeInterface;

class Expert extends Model
{
    /* elasticsearch trait (not in use as of 5/15/17...using Sofa/Eloquence instead) */
    //use Searchable; //elasticsearch trait

  protected $fillable = [
    'display_name',
    'first_name',
    'last_name',
    'title',
    'biography',
    'teaser',
    'is_media_expert',
    'is_community_speaker',
    'interviews',
    'office_phone',
    'cell_phone',
    'release_cell_phone',
    'email',
    'is_approved',
    'submitter_name',
    'submitter_phone',
    'submitter_email'
  ];

//  use Eloquence;
//  protected $searchableColumns = [
//      'display_name' => 100,
//      'first_name' => 95,
//      'last_name' => 100,
//      'title' => 100,
//      'biography' => 50,
//      'teaser' => 40,
//      'office_phone' => 10,
//      'email' => 40,
//      'education.education' => 20,
//      'expertCategories.category' => 80,
//      'expertise.expertise' => 250,
//      'languages.language' => 20,
//      'previousTitles.title' => 20,
//      'socialMediaLinks.title' => 10,
//      'socialMediaLinks.url' => 10,
//  ];

  public function getFullNameAttribute(){
    return $this->last_name . ', '. $this->first_name;
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

    public function expertCategories()
	{
		return $this->belongsToMany('Emutoday\ExpertCategory', 'experts_expertcategory', 'expert_id', 'cat_id');
	}

    public function education(){
        return $this->hasMany('Emutoday\ExpertEducation');
    }

    public function languages(){
        return $this->hasMany('Emutoday\ExpertLanguages');
    }

    public function expertise(){
        return $this->hasMany('Emutoday\ExpertExpertise');
    }

    public function socialMediaLinks(){
        return $this->hasMany('Emutoday\ExpertSocial');
    }

    public function previousTitles(){
        return $this->hasMany('Emutoday\ExpertTitles');
    }

    /**
     * ADDED FOR LARAVEL 7 TO KEEP EXISTING DATETIME FORMAT
     * https://laravel.com/docs/7.x/upgrade#date-serialization
     * Prepare a date for array / JSON serialization.
     *
     * @param \DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
