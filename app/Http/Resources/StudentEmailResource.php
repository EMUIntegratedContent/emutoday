<?php

namespace Emutoday\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentEmailResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		// Combine the single featured story and featured Campus Life post (only one will be present)
		$mainStories = $this->mainstories()->get();
		$mainInsideemuPosts = $this->maininsideemuposts()->get();
		$combinedMainStories = $mainStories->merge($mainInsideemuPosts)->values()->all();

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
			'mainStories' => EmailPostStoryResource::collection($combinedMainStories),
			'announcements' => $this->announcements()->orderBy('student_email_announcement.order', 'asc')->get(),
			'events' => $this->events()->orderBy('student_email_event.order', 'asc')->get(),
			'otherStories' => EmailPostStoryResource::collection($otherStories),
			'insideemuPosts' => InsideemuPostPublicResource::collection($insideemuPosts), // resource has the 'postId' field the frontend needs
			'send_at' => $sendAt,
			'recipients' => $this->recipients()->get(),
			'is_sent' => $this->is_sent,
			'mailgun_opens' => $this->mailgun_opens,
			'mailgun_clicks' => $this->mailgun_clicks,
			'mailgun_spam' => $this->mailgun_spam,
			'clone' => $this->clonedEmail()->select('id', 'title')->get(),
			'created_at' => $this->created_at->format('n/j/y @ g:i A'),
			'exclude_events' => $this->exclude_events,
			'exclude_insideemu' => $this->exclude_insideemu,
		];
	}
}
