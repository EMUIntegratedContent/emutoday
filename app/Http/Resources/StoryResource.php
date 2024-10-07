<?php

namespace Emutoday\Http\Resources;

use Emutoday\Author;
use Emutoday\Imagetype;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Emutoday\Http\Resources\InsideemuPostsImagesResource;

class StoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
		{
			$emailImageTypeIds = Imagetype::select('id')->where('type', 'email')->get();
			$smallImageTypeIds = Imagetype::select('id')->where('type', 'small')->get();
			$frontImageTypeIds = Imagetype::select('id')->where('type', 'front')->get();
			$emu175ImageTypeIds = Imagetype::select('id')->where('type', 'emu175')->get();

			$author = Author::find($this->author_id);

			return [
				'id'      => (int) $this->id,
				'user_id' => $this->user_id,
				'user' => $this->user,
				'author_id' => $this->author_id,
				'author_info' => $this->author_info,
				'story_type'   => $this->story_type,
				'group'  => $this->storyGroup->group,
				'title'    =>  $this->title,
				'slug'    =>  $this->slug,
				'subtitle'    =>  $this->subtitle,
				'content'  => $this->content,
				'is_ready' => $this->is_ready,
				'is_approved' => $this->is_approved,
				'is_promoted' => $this->is_promoted,
				'is_featured' =>  $this->is_featured,
				'is_live' =>  $this->is_live,
				'is_archived' =>  $this->is_archived,
				'tags' => $this->tags()->select('name', 'id as value')->get(),
				'start_date'   =>  $this->start_date->toDateTimeString(),
				'priority' => $this->priority,
				'magazines' => $this->magazines,
				'pages' => $this->pages,
				'author' => ($this->author_id == 0)? null:$this->author,
				'contact' => ($this->contact_id == 0)? null:$this->contact,
				'author_object' => $author,
				'photo_credit' => $this->photo_credit,
				'small_images' => $this->storyImages()->select('image_path','filename','title','caption','teaser','moretext','link','link_text','alt_text')->whereIn('imagetype_id', $smallImageTypeIds)->get(), // need for email builder (sub-main stories)
				'email_images' => $this->storyImages()->select('image_path','filename','title','caption','teaser','moretext','link','link_text','alt_text')->whereIn('imagetype_id', $emailImageTypeIds)->get(), // need for email builder (main stories)
				'full_url' => url('/') . '/story/' . $this->story_type . '/' . $this->id,
				'edit_url' => url('/') . '/admin/queueall/story/' . $this->story_type . '/' . $this->id . '/edit',
				'is_emu175_hub_story' => $this->is_emu175_hub_story,
				'emu175_image' => $this->storyImages()->select('image_path','filename','title','caption','teaser','moretext','link','link_text','alt_text')->whereIn('imagetype_id', $emu175ImageTypeIds)->get()
			];
    }
}
