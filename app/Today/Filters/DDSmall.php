<?php

namespace Emutoday\Today\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class DDSmall implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(100, 100);
    }
}
