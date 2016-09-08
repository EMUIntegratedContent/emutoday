<?php

namespace Emutoday\Emutoday\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class FeaturedEvent implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(412, 248);

    }
}
