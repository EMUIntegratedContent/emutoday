<?php

namespace Emutoday\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Emutoday\Http\Resources\IntcommPostsImagesResource;

class IntcommPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
		{
			return [
				'postId' => $this->id,
				'title' => $this->title,
				'teaser' => $this->teaser,
				'content' => $this->content,
				'start_date' => $this->start_date,
				'end_date' => $this->end_date,
				'submitted_by' => $this->submitted_by,
				'admin_status' => $this->admin_status,
				'seq' => $this->seq,
				'source' => $this->source,
				'created_by' => $this->postCreator(),
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
				'is_live' => $this->postIsLive(), // In the model, this method checks if the post is live based on several criteria
				'progress' => $this->postProgress(), // In the model, this method checks the progress of the post based on several criteria
				'starts_soon' => $this->postStartsIn24Hours(),
				'ends_soon' => $this->postEndsIn24Hours(),
				'ended_recently' => $this->postEndedInLast24Hours(),
				'associated_idea' => $this->idea ? $this->idea->load('images') : null, // Load the associated idea and its images
				'images' => IntcommPostsImagesResource::collection($this->images)
			];
    }
}
