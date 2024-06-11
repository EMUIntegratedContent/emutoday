<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntcommIdeasImages extends Model{
	use HasFactory;

	protected $fillable = [
		'intcomm_idea_id',
		'image_name',
		'image_path',
		'description'
	];

	public function post(){
		return $this->belongsTo(IntcommIdea::class);
	}
}
