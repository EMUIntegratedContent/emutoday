<?php
namespace Emutoday\Today\Transformers;
use Emutoday\StoryIdea;
use Emutoday\StoryIdeaMedium;
use League\Fractal;
use DB;

class FractalStoryIdeaTransformerModel extends Fractal\TransformerAbstract
{
    public function transform(StoryIdea $idea)
    {
        return [
            'id'                        => (int) $idea->id,
            'title'                     => $idea->title,
            'idea'                      => $idea->idea,
            'deadline'                  => $idea->deadline,
            'is_completed'              => $idea->is_completed,
            'is_archived'               => $idea->is_archived,
            'creator'                   => $idea->creator()->select(DB::raw('CONCAT(first_name, " ", last_name) AS name'), 'id as value')->first(),
            'assignee'                  => $idea->assignee()->select(DB::raw('CONCAT(first_name, " ", last_name) AS name'), 'id as value')->first(),
            'medium'                    => $idea->medium()->select('medium', 'id as value')->first(),
        ];
    }
}
