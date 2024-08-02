<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Emutoday\Imagetype;

class InsideemuPostsImages extends Model{
	use HasFactory;

	protected $fillable = [
		'insideemu_post_id',
		'is_active',
		'image_name',
		'image_path',
		'title',
		'caption',
		'teaser',
		'moretext',
		'link',
		'link_text',
		'image_extension',
		'imagetype_id',
		'alt_text'
	];

	public function post(){
		return $this->belongsTo(InsideemuPost::class);
	}
}
