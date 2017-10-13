<?php

namespace Emutoday\Today\Transformers;

use Emutoday\Email;
use League\Fractal;
use Carbon\Carbon;

use League\Fractal\Manager;
use Emutoday\Today\Transformers\FractalStoryTransformerModel;

class FractalEmailTransformerModel extends Fractal\TransformerAbstract
{
    public function transform(Email $email)
    {
        // Other stories need to be packaged as a fractal to access the 'group' field
        $otherStories = $email->stories()->orderBy('order', 'desc')->get();
        $fractal = new Manager();
        $resource = new Fractal\Resource\Collection($otherStories->all(), new FractalStoryTransformerModel);
        $otherStories = $fractal->createData($resource)->toArray();

        return [
            'id'      => (int) $email->id,
            'title'    =>  $email->title,
            'subheading' => $email->subheading,
            'is_approved' => $email->is_approved,
            'is_ready' => $email->is_ready,
            'announcements' => $email->announcements()->orderBy('order', 'desc')->get(),
            'events' => $email->events()->orderBy('order', 'desc')->get(),
            'otherStories' => $otherStories['data'],
        ];
    }
}
