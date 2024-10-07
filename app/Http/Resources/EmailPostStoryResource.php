<?php

namespace Emutoday\Http\Resources;

use Emutoday\InsideemuPost;
use Emutoday\Story;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmailPostStoryResource extends JsonResource
{
    /**
     * Transform the resource (a collection of Story and InsideemuPost models) into an array for the email builder
     *
     * @return InsideemuPostEmailResource | StoryResource | array
		 */
    public function toArray(Request $request): InsideemuPostEmailResource | StoryResource | array
		{
			// Determine the type of the resource and use the appropriate resource class
			if ($this->resource instanceof Story) {
				return new StoryResource($this->resource);
			} elseif ($this->resource instanceof InsideemuPost) {
				return new InsideemuPostEmailResource($this->resource);
			}
			return [];
    }
}
