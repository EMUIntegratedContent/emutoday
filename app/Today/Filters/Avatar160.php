<?php

namespace Emutoday\Today\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Avatar160 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        // resize the image to a height of .25 * height  and constrain aspect ratio (auto width)
        return $image->fit(160, 160);
    }
}
