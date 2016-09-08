<?php

namespace Emutoday\Emutoday\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class MagazineCover implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        // resize the image to a height of .25 * height  and constrain aspect ratio (auto width)
        return $image->fit(240, 320);

    }
}
