<?php

namespace Emutoday\Today\Transformers;

use Emutoday\Expert;
use League\Fractal;

class FractalExpertTransformerModel extends Fractal\TransformerAbstract
{
    public function transform(Expert $expert)
    {
        return [
            'id'          => (int) $expert->id,
            'first_name'  => $expert->first_name,
            'last_name'   => $expert->last_name,
            'title'       => $expert->title,
            'about'       => $expert->about,
            'education'   => $expert->education,
            'expertise'   => $expert->expertise,
        ];
    }
}
