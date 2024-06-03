<?php

namespace Emutoday\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Emutoday\Http\Resources\IntcommIdeasImagesResource;

class IntcommIdeaResource extends JsonResource
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
				'teaser' => $this->teaser,
				'content' => $this->content,
				'contributor_netid' => $this->contributor_netid,
				'contributor_first' => $this->contributor_first,
				'contributor_last' => $this->contributor_last,
				'is_submitted' => $this->is_submitted,
				'admin_status' => $this->admin_status,
				'archived' => $this->archived,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
				'images' => IntcommIdeasImagesResource::collection($this->images),
				'associated_posts' => IntcommPostResource::collection($this->posts) // Posts that have the fk intcomm_idea_id = ideaId
			];
    }
}
