<?php

namespace Emutoday\Today\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Emu175 implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(616, null, function ($constraint) {
            $constraint->aspectRatio();
        });
    }
}
