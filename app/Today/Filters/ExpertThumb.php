<?php

namespace Emutoday\Today\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class ExpertThumb implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        // resize the image to a height of 150px  and constrain aspect ratio (auto width)
        return $image->resize(null, 150, function ($constraint) {
            $constraint->aspectRatio();
        });

    }
}
