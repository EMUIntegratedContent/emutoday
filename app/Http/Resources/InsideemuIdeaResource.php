<?php

namespace Emutoday\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InsideemuIdeaResource extends JsonResource
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
				'contributor_fullname' => $this->contributor_first . ' ' . $this->contributor_last,
				'use_other_source' => $this->use_other_source,
				'other_source' => $this->other_source,
				'admin_status' => $this->admin_status,
				'archived' => $this->archived,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
				'submitted_at' => $this->submitted_at,
				'images' => InsideemuIdeasImagesResource::collection($this->images),
				'associated_posts' => InsideemuPostResource::collection($this->posts) // Posts that have the fk insideem_idea_id = ideaId
			];
    }
}
