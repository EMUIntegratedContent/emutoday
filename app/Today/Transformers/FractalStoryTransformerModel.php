<?php

namespace Emutoday\Today\Transformers;

use Emutoday\Story;
use League\Fractal;
use Carbon\Carbon;

class FractalStoryTransformerModel extends Fractal\TransformerAbstract
{
    public function transform(Story $story)
    {
      // LETS JUST RETURN THE WHOLE DATABASE ONTO ONE VIEW!!!
        return [
            'id'      => (int) $story->id,
            // 'user_id' => $story->user_id,
            // 'user' => $story->user,
            // 'author_id' => $story->author_id,
            // 'author_info' => $story->author_info,
            'story_type'   => $story->story_type,
            'group'  => $story->storyGroup->group,
            'title'    =>  $story->title,
            // 'slug'    =>  $story->slug,
            // 'subtitle'    =>  $story->subtitle,
            // 'content'  => $story->content,
            'is_ready' => $story->is_ready,
            'is_approved' => $story->is_approved,
            'is_promoted' => $story->is_promoted,
            'is_featured' =>  $story->is_featured,
            'is_live' =>  $story->is_live,
            'is_archived' =>  $story->is_archived,
            // 'tags' => $story->tags()->select('name', 'id as value')->get(),
            'start_date'   =>  $story->start_date->toDateString(),
            'priority' => $story->priority,
            'magazines' => $story->magazines,
            'pages' => $story->pages,
            // 'start_date'   => $story->start_date->format('m-d-Y'),
            // 'author' => ($story->author_id == 0)? null:$story->author,
            // 'contact' => ($story->contact_id == 0)? null:$story->contact
        ];
    }
}
