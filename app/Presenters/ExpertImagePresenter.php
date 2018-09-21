<?php

namespace Emutoday\Presenters;

use Laracasts\Presenter\Presenter;

class ExpertImagePresenter extends Presenter
{
    protected $expert;

    protected $thumbnailPath = 'thumbnails/thumb-';


    public function attachedToExpertId(){
        $expert = $this->expert;
        return  $this->$expert->id;
    }

    public function mainImageURL()
    {
        return $this->image_path . $this->filename;
    }

    public function thumbnailImageURL()
    {
        return $this->image_path . 'thumbnails/thumb-' . $this->filename;
    }
}
