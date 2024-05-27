<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntcommPost extends Model
{
    use HasFactory;
		protected $fillable = ['title', 'teaser', 'content', 'start_date', 'end_date', 'submitted_by', 'status', 'intcomm_idea_id'];
		protected $dates = ['start_date', 'end_date', 'created_at', 'updated_at'];

		public function images(){
			return $this->hasMany(IntcommPostsImages::class);
		}

		public function idea() {
			return $this->belongsTo(IntcommIdea::class, 'intcomm_idea_id');
		}
}
