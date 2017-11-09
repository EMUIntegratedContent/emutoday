<?php

namespace Emutoday\Today\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class EmailMain implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(600, 282, function ($constraint) {
            $constraint->aspectRatio();
        });
    }
}
