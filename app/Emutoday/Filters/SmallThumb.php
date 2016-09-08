<?php

namespace Emutoday\Emutoday\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class SmallThumb implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(100, 100);
    }
}
