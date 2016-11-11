<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Carbon\Carbon;

class Page extends Model
{
    use PresentableTrait;
    protected $presenter = 'Emutoday\Presenters\PagePresenter';

    protected $fillable = [
        'template',
        'uri',
        'start_date',
        'end_date',
        'user_id',
        'template_elements',
      ];

    protected $dates = ['end_date', 'start_date'];

    public function storys(){
        return $this->belongsToMany('Emutoday\Story')
            ->withPivot('page_position', 'note')
            ->withTimestamps();
    }
    // public function storyImages()
    // {
    //     return $this->hasManyThrough('emutoday\StoryImage', 'emutoday\Story');
    // }

}
