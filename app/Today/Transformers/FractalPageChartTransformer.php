<?php

namespace Emutoday\Today\Transformers;

use Emutoday\Page;
use League\Fractal;
use Carbon\Carbon;

class FractalPageChartTransformer extends Fractal\TransformerAbstract
{
    // $pgs = \DB::table('pages')->select('id', 'uri','start_date', 'end_date')->get();

    public function transform(Page $page)
    {
        return [
            'id'           =>   $page->id,
            'uri'   =>  'id:'. $page->id.'-'. $page->template,
            'start_date'   => $page->start_date->toDateString(),
            'end_date'   => $page->end_date ? $page->end_date->toDateString() : Carbon::now()->addMonths(3)->toDateString()
        ];
    }
}
