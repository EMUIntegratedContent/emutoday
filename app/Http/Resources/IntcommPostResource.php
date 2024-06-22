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
				'status' => $this->status,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
				'associated_idea' => $this->idea ? $this->idea->load('images') : null, // Load the associated idea and its images
				'images' => IntcommPostsImagesResource::collection($this->images)
			];
    }
}
