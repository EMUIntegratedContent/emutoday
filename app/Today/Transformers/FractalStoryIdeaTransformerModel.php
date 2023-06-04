<?php
namespace Emutoday\Today\Transformers;
use Emutoday\StoryIdea;
use Emutoday\StoryIdeaMedium;
use League\Fractal;
use Illuminate\Support\Facades\DB;

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
            'creator'                   => $idea->creator()->select('id AS value')->selectRaw('CONCAT(first_Name, " ", last_Name) AS name')->first(),
            'assignee'                  => $idea->assignee()->select('id AS value')->selectRaw('CONCAT(first_Name, " ", last_Name) AS name')->first(),
            'medium'                    => $idea->medium()->select('medium', 'id as value')->first(),
        ];
    }
}
