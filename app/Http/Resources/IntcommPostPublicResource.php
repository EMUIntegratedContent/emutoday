<?php

namespace Emutoday\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Emutoday\Http\Resources\IntcommPostsImagesResource;

class IntcommPostPublicResource extends JsonResource
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
				'postId' => $this->id,
				'title' => $this->title,
				'is_live' => $this->postIsLive()
			];
    }
}
