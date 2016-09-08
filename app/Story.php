<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Story extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'storys';

    /**
     * Vendor Package
     */
    use PresentableTrait;
    protected $presenter = 'Emutoday\Presenters\StoryPresenter';

    protected $fillable = ['user_id', 'title', 'slug','subtitle', 'teaser', 'content', 'external_link', 'start_date','end_date', 'is_featured','is_ready','is_approved', 'is_live' ,'story_type','author_id','author_info','priority'];

    protected $dates = ['start_date', 'end_date'];




    /**
    *
    *   RELATIONSHIPS
    ***/

    /**
     * [author description]
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * [author description]
     * @return [type] [description]
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * [storyImages description]
     * @return [type] [description]
     */
    public function storyImages()
    {
        return $this->hasMany(StoryImage::class);
    }



}
