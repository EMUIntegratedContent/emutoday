<?php

namespace Emutoday\Today\Transformers;

use Emutoday\Page;
use League\Fractal;
use Carbon\Carbon;

class FractalPageTransformer extends Fractal\TransformerAbstract
{
    public function transform(Page $page)
    {


        return [
            'id'      => (int) $page->id,
            'template'   => $page->template,
            'ready'=> (int) $page->is_ready,
            'live'    => (int)  $page->is_live,
          'start_date'   => $page->start_date->toDateString(),
                    'end_date'   => $page->end_date ? $page->end_date->toDateString() : 'No End Date'
        ];
    }
}
