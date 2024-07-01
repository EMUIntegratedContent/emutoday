<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntcommPost extends Model{
	use HasFactory;

	protected $fillable = ['title', 'teaser', 'content', 'start_date', 'end_date', 'submitted_by', 'admin_status', 'intcomm_idea_id'];
	protected $dates = ['start_date', 'end_date', 'created_at', 'updated_at'];

	public function images(){
		return $this->hasMany(IntcommPostsImages::class);
	}

	public function idea(){
		return $this->belongsTo(IntcommIdea::class, 'intcomm_idea_id');
	}

	public function requiredImageTypes(){
		return Imagetype::select('id')->where('is_required', 1)->where('group', 'intcommpost')->get();
	}

	/**
	 * Determine if the post is live. For a post to be live, it must:
	 * - Have a title
	 * - Have content
	 * - Be approved by an admin
	 * - Be within the start and end date
	 * - Have all required images (imagetypes.is_required == 1)
	 * @return bool;
	 */
	public function postIsLive(): bool{
		$reqImgs = $this->requiredImageTypes();

		// Make sure that the post has one image for each of the $reqImgs ids
		// (i.e. the post has an image for each required imagetype)
		$hasReqImgs = $reqImgs->every(function($reqImg){
			return $this->images->contains('imagetype_id', $reqImg->id);
		});
		return $this->title != '' && $this->content != '' &&
			$this->admin_status === 'Approved' && $this->start_date <= now() && $this->end_date >= now() && $hasReqImgs;
	}
}
