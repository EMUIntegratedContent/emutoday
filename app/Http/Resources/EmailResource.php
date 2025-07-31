<?php

namespace Emutoday\Http\Resources;

use Emutoday\Author;
use Emutoday\Imagetype;
use Emutoday\InsideemuPost;
use Emutoday\Story;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmailResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		// Combine the main stories and main Inside EMU posts
		$mainStories = $this->mainstories()->get();
		$mainInsideemuPosts = $this->maininsideemuposts()->get();
		$combinedMainStories = $mainStories->merge($mainInsideemuPosts);
		// Reorder by the 'order' field
		$combinedMainStories = $combinedMainStories->sortBy('pivot.order');
		// Reset the keys on the sorted collection
		$sortedCombinedMainStories = $combinedMainStories->values()->all();

		$otherStories = $this->stories()->get();

		$insideemuPosts = $this->insideemuPosts()->orderBy('order')->get();

		$sendAt = null;
		if($this->send_at){
			$sendAt = $this->send_at;
		}

		return [
			'id'      => (int) $this->id,
			'title'    =>  $this->title,
			'subheading' => $this->subheading,
			'is_approved' => $this->is_approved,
			'is_ready' => $this->is_ready,
			'mainStories' => EmailPostStoryResource::collection($sortedCombinedMainStories),
			'announcements' => $this->announcements()->orderBy('email_announcement.order', 'asc')->get(),
			'events' => $this->events()->orderBy('email_event.order', 'asc')->get(),
			'otherStories' => EmailPostStoryResource::collection($otherStories),
			'insideemuPosts' => InsideemuPostPublicResource::collection($insideemuPosts), // use the resource instead of the model because it has the 'postId' field, which the frontend needs
			'send_at' => $sendAt,
			'recipients' => $this->recipients()->get(),
			'is_sent' => $this->is_sent,
			'mailgun_opens' => $this->mailgun_opens,
			'mailgun_clicks' => $this->mailgun_clicks,
			'mailgun_spam' => $this->mailgun_spam,
			'clone' => $this->clonedEmail()->select('id', 'title')->get(),
			'created_at' => $this->created_at->format('n/j/y @ g:i A'),
			'is_president_included' => $this->is_president_included,
			'president_teaser' => $this->president_teaser,
			'president_url' => $this->president_url,
			'exclude_events' => $this->exclude_events,
			'exclude_insideemu' => $this->exclude_insideemu,
			'is_emu175_included' => $this->is_emu175_included,
			'emu175_teaser' => $this->emu175_teaser,
			'emu175_url' => $this->emu175_url
		];
	}
}
