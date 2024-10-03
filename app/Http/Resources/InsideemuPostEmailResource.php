<?php

namespace Emutoday\Http\Resources;

use Emutoday\Imagetype;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InsideemuPostEmailResource extends JsonResource
{
    /**
     * Transform the resource into an array for the EMAIL BUILDER (Main Stories).
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
		{
			$emailImageTypeIds = Imagetype::select('id')->where('type', 'email')->get();
			$smallImageTypeIds = Imagetype::select('id')->where('type', 'small')->get();

			// The goal of this resource it to MIMIC a Story model for the email builder.
			return [
				'id'      => (int) $this->id,
				'story_type'   => 'Inside EMU',
				'group'  => 'insideemu_post',
				'title'    =>  $this->title,
				'content'  => $this->content,
				'start_date'   =>  $this->start_date,
				'small_images' => $this->images()->whereIn('imagetype_id', $smallImageTypeIds)->get(), // need for email builder (sub-main stories)
				'email_images' => $this->images()->whereIn('imagetype_id', $emailImageTypeIds)->get(), // need for email builder (main stories)
				'full_url' => url('/') . '/insideemu/posts/' . $this->id,
				'edit_url' => url('/') . '/admin/insideemu/posts/' . $this->id . '/edit'
			];
    }
}
