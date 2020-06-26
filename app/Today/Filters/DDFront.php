<?php

namespace Emutoday\Today\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class DDFront implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(300, 200);
    }
}
