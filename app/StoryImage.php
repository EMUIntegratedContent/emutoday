<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
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
        'group'
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

}
