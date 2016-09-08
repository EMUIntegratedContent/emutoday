<?php

namespace Emutoday\Presenters;

use Laracasts\Presenter\Presenter;
use Carbon\Carbon;

class UserPresenter extends Presenter
{
    public function avatarUrl()
    {
        // dd($mediafile = $this->mediaFiles->first());

        return $mediafile->path . $mediafile->name . '.' . $mediafile->ext;

    }

    public function lastLoginDifference()
    {
        return $this->last_login_at->diffForHumans();
    }
}
