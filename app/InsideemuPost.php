<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class InsideemuPost extends Model{
	use HasFactory;

	protected $fillable = ['title', 'teaser', 'content', 'start_date', 'end_date', 'admin_status', 'insideemu_idea_id', 'seq', 'created_by', 'source', 'is_hub_post'];
	protected $dates = ['start_date', 'end_date', 'created_at', 'updated_at'];

	public function images(){
		return $this->hasMany(InsideemuPostsImages::class);
	}

	public function idea(){
		return $this->belongsTo(InsideemuIdea::class, 'insideemu_idea_id');
	}

	public function requiredImageTypes(){
		return Imagetype::select('id')->where('is_required', 1)->where('group', 'insideemupost')->get();
	}

	/**
	 * Determine if the post is live. For a post to be live, it must:
	 * - Have a title
	 * - Have content
	 * - Be approved by an admin
	 * - Be within the start and end date
	 * - TODO Have all required images (imagetypes.is_required == 1)
	 * @return bool;
	 */
	public function postIsLive(): bool{
		// End date is optional
		if($this->end_date) {
			return $this->postProgress() === 100 && $this->start_date <= now() && $this->end_date >= now();
		}
		return $this->postProgress() === 100 && $this->start_date <= now();
	}

	/**
	 * Give a percentage representation of post progress. For a post to be 100% complete, it must:
	 * - Have a title
	 * - Have content
	 * - Be approved by an admin
	 * - Have a start date
	 * - Have all required images (imagetypes.is_required == 1)
	 * @return int;
	 */
	public function postProgress(): int{
		$progress = 0;
		$reqImgs = $this->requiredImageTypes();

		// Make sure that the post has one image for each of the $reqImgs ids
		// (i.e. the post has an image for each required imagetype)
		$hasReqImgs = $reqImgs->every(function($reqImg){
			return $this->images->contains('imagetype_id', $reqImg->id);
		});

		if($this->title != '') $progress += 20;
		if($this->content != '') $progress += 20;
		if($this->admin_status === 'Approved') $progress += 20;
		if($this->start_date != '') $progress += 20;
		if($hasReqImgs) $progress += 20;

		return $progress;
	}

	public function postIsApproved(): bool{
		return $this->admin_status === 'Approved';
	}

	public function postStartsIn24Hours(): bool{
		// Carbon diff in hours
		$start = Carbon::parse($this->start_date);
		$now = Carbon::now();
		$diff = $now->diffInMinutes($start, false);
		return $diff >= 0 && $diff <= 24*60 && !$this->postIsLive();
	}

	public function postEndsIn24Hours(): bool{
		// Carbon diff in hours
		$end = Carbon::parse($this->end_date);
		$now = Carbon::now();
		$diff = $now->diffInMinutes($end, false);
		return $diff >= 0 && $diff <= 24*60 && $this->postIsLive();
	}

	public function postEndedInLast24Hours(): bool{
		// Carbon diff in hours
		$end = Carbon::parse($this->end_date);
		$now = Carbon::now();
		$diff = $now->diffInMinutes($end, false);
		return $diff >= -24*60 && $diff <= 0;
	}

	public function postCreator (){
		return User::select('first_name', 'last_name', 'email')->where('id', $this->created_by)->first();
	}
}
