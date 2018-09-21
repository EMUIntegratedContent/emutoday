<?php

namespace Emutoday\Today\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class BetterThumb implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $iheight = $image->height();
        $adjheight = $iheight * 0.25;
        // resize the image to a height of .25 * height  and constrain aspect ratio (auto width)
        return $image->resize(null, $adjheight, function ($constraint) {
            $constraint->aspectRatio();
        });

    }
}
