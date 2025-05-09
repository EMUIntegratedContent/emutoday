<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use DateTimeInterface;

class StoryImage extends Model
{
    use PresentableTrait;
    protected $presenter = 'Emutoday\Presenters\StoryImagePresenter';

    protected $fillable = [
        'story_id',
        'is_active',
        'image_name',
        'image_path',
        'title',
        'caption',
        'teaser',
        'moretext',
        'link',
        'link_text',
        'image_extension',
        'image_type',
        'imagetype_id',
        'group',
        'alt_text'
];


    /**
    * All of the relationships to be touched.
    *
    * @var array
    */
    protected $touches = ['story'];

    public function story()
    {
        return $this->belongsTo('Emutoday\Story');
    }

    public function imgtype()
    {
        return $this->belongsTo('Emutoday\Imagetype','imagetype_id');
    }

    public function scopeOfType($query, $itype)
    {
        return $query->where('image_type',$itype);
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
