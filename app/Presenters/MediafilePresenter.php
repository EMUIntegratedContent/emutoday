<?php

namespace Emutoday\Presenters;

use Laracasts\Presenter\Presenter;

class MediafilePresenter extends Presenter
{
    protected $mediafile;

    protected $thumbnailPath = 'thumbnails/thumb-';

    public function attachedToUserId(){
        $user = $this->user;
        return  $this->$user->id;
    }

    public function mainMediafileURL()
    {
        return $this->path . $this->name . '.' . $this->ext;
    }

    public function thumbnailMediafileURL()
    {
        return $this->path . 'thumbnails/thumb-' . $this->name . '.' . $this->ext;
    }
}
