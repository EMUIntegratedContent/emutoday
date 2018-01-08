<?php

namespace Emutoday\Today\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class EmailSub implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(268, null, function ($constraint) {
            $constraint->aspectRatio();
        });
    }
}
