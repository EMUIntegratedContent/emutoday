<?php

namespace Emutoday\Today\Transformers;

use Emutoday\Story;
use Emutoday\Author;
use Emutoday\Imagetype;
use League\Fractal;
use Carbon\Carbon;

class FractalStoryTransformerModel extends Fractal\TransformerAbstract
{
    public function transform(Story $story)
    {
        $emailImageTypeIds = Imagetype::select('id')->where('type', 'email')->get();
        $smallImageTypeIds = Imagetype::select('id')->where('type', 'small')->get();

        $author = Author::find($story->author_id);

        return [
            'id'      => (int) $story->id,
            'user_id' => $story->user_id,
            'user' => $story->user,
            'author_id' => $story->author_id,
            'author_info' => $story->author_info,
            'story_type'   => $story->story_type,
            'group'  => $story->storyGroup->group,
            'title'    =>  $story->title,
            'slug'    =>  $story->slug,
            'subtitle'    =>  $story->subtitle,
            'content'  => $story->content,
            'is_ready' => $story->is_ready,
            'is_approved' => $story->is_approved,
            'is_promoted' => $story->is_promoted,
            'is_featured' =>  $story->is_featured,
            'is_live' =>  $story->is_live,
            'is_archived' =>  $story->is_archived,
            'tags' => $story->tags()->select('name', 'id as value')->get(),
            'start_date'   =>  $story->start_date->toDateString(),
            'priority' => $story->priority,
            'magazines' => $story->magazines,
            'pages' => $story->pages,
            'author' => ($story->author_id == 0)? null:$story->author,
            'contact' => ($story->contact_id == 0)? null:$story->contact,
            'author_object' => $author,
            'small_images' => $story->storyImages()->select('image_path','filename','title','caption','teaser','moretext','link','link_text')->whereIn('imagetype_id', $smallImageTypeIds)->get(), // need for email builder (sub-main stories)
            'email_images' => $story->storyImages()->select('image_path','filename','title','caption','teaser','moretext','link','link_text')->whereIn('imagetype_id', $emailImageTypeIds)->get(), // need for email builder (main stories)
            'full_url' => url('/') . '/story/' . $story->story_type . '/' . $story->id,
            'edit_url' => url('/') . '/admin/queueall/story/' . $story->story_type . '/' . $story->id . '/edit'
        ];
    }
}
