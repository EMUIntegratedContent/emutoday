<?php
namespace Emutoday\Today\Transformers;
use Emutoday\StoryIdea;
use Emutoday\StoryIdeaMedium;
use League\Fractal;
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
            'creator'                   => $idea->creator()->select('email', 'id')->first(),
            'assignee'                  => $idea->assignee()->select('email', 'id')->first(),
            'medium'                    => $idea->medium()->select('medium', 'id')->first(),
        ];
    }
}
