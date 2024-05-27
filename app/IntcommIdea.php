<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntcommIdea extends Model
{
    use HasFactory;
		protected $fillable = ['title', 'teaser', 'content', 'submitted_by', 'status', 'archived'];
		protected $dates = ['created_at', 'updated_at'];

		public function images(){
			return $this->hasMany(IntcommIdeasImages::class);
		}

		public function posts(){
			return $this->hasMany(IntcommPost::class);
		}
}
