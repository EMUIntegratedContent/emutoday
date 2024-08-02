<?php

namespace Emutoday\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InsideemuIdeaPublicResource extends JsonResource
{
	/**
	 * Transform the resource into an array with limited information.
	 * This should be used when sending the post data in public views (e.g. the user's idea list)
	 *
	 * @return array<string, mixed>
	 */
    public function toArray(Request $request): array
		{
			return [
				'ideaId' => $this->id,
				'title' => $this->title,
				'archived' => $this->archived,
				'created_at' => $this->created_at,
				'submitted_at' => $this->submitted_at,
				'associated_posts' => InsideemuPostPublicResource::collection($this->posts) // Posts that have the fk insideemu_idea_id = ideaId
			];
    }
}
