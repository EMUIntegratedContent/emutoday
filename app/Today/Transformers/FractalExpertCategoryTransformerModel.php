<?php

namespace Emutoday\Today\Transformers;

use Emutoday\ExpertCategory;
use League\Fractal;

class FractalExpertCategoryTransformerModel extends Fractal\TransformerAbstract
{
    public function transform(ExpertCategory $category)
    {
        return [
            'id'          => (int) $category->id,
            'category'  => $category->category,
        ];
    }
}
