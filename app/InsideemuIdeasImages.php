<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsideemuIdeasImages extends Model{
	use HasFactory;

	protected $fillable = [
		'insideemu_idea_id',
		'image_name',
		'image_path',
		'description'
	];

	public function post(){
		return $this->belongsTo(InsideemuIdea::class);
	}
}
