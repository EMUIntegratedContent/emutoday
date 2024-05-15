<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntcommPostsImages extends Model{
	use HasFactory;

	protected $fillable = [
		'intcomm_post_id',
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
		'image_type',
		'alt_text'
	];

	public function post(){
		return $this->belongsTo(IntcommPost::class);
	}
}
