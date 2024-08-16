<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
//use Laracasts\Presenter\PresentableTrait;
use DateTimeInterface;

class Magazine extends Model
{
//use PresentableTrait;
    protected $presenter = 'Emutoday\Presenters\MagazinePresenter';
    protected $fillable = [
            'year', 'season','title',
            'subtitle', 'teaser', 'ext_url',
            'is_published', 'is_archived','cover_art',
            'is_ready', 'start_date', 'end_date', 'user_id'
        ];
    protected $casts = [
			'start_date' => 'datetime',
			'end_date' => 'datetime'
		];


    public function storys(){
        return $this->belongsToMany('Emutoday\Story')
        ->withPivot('story_position');
    }

    public function storyImages()
    {
        return $this->hasManyThrough('Emutoday\StoryImage', 'emutoday\Story');
    }

    public function mediafiles()
    {
        return $this->belongsToMany('Emutoday\Mediafile');
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
