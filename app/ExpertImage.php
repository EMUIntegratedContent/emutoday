<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
//use Laracasts\Presenter\PresentableTrait;
class ExpertImage extends Model
{
//    use PresentableTrait;
    protected $presenter = 'Emutoday\Presenters\StoryImagePresenter';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'experts_images';

    protected $fillable = [
        'expert_id',
        'is_active',
        'image_name',
        'image_path',
        'title',
        'caption',
        'image_extension',
        'image_name',
        'imagetype_id',
        'group'
];


    /**
    * All of the relationships to be touched.
    *
    * @var array
    */
    protected $touches = ['expert'];

    public function expert()
    {
        return $this->belongsTo('Emutoday\Expert');
    }

    public function imgtype()
    {
        return $this->belongsTo('Emutoday\Imagetype','imagetype_id');
    }

}
