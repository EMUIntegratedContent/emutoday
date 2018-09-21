<?php

namespace Emutoday\Today\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class ExpertThumb implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        // resize the image to a 4:5 ratio
        return $image->resize(120, 150);
    }
}
