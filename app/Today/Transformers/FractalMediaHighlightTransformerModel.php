<?php

namespace Emutoday\Today\Transformers;

use Emutoday\MediaHighlight;
use Emutoday\MediaHighlightTag;
use League\Fractal;
use Carbon\Carbon;

class FractalMediaHighlightTransformerModel extends Fractal\TransformerAbstract
{
    public function transform(MediaHighlight $highlight)
    {
        return [
            'id'              => (int) $highlight->id,
            'title'           => $highlight->title,
            'url'             => $highlight->url,
            'source'          => $highlight->source,
            'is_archived'     => $highlight->is_archived,
            'tags'            => $highlight->tags()->get(),
            'start_date'      => $highlight->start_date->toDateString(),
        ];
    }
}
