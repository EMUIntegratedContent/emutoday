<?php

namespace Emutoday\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IntcommIdeaPublicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
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
				'associated_posts' => IntcommPostPublicResource::collection($this->posts) // Posts that have the fk intcomm_idea_id = ideaId
			];
    }
}
