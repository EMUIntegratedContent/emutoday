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
				'submitted_by' => $this->submitted_by,
				'status' => $this->status,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
				'images' => IntcommIdeasImagesResource::collection($this->images)
			];
    }
}
