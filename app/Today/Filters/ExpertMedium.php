<?php

namespace Emutoday\Today\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class ExpertMedium implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        // resize the image to a height of 418px  and constrain aspect ratio (auto width)
        return $image->resize(null, 418, function ($constraint) {
            $constraint->aspectRatio();
        });
    }
}
