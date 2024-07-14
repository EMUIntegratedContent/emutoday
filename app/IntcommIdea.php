<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntcommIdea extends Model
{
    use HasFactory;
		protected $fillable = ['title', 'teaser', 'content', 'contributor_netid', 'contributor_first', 'contributor_last', 'admin_status', 'archived', 'use_other_source', 'other_source', 'submitted_at'];
		protected $dates = ['created_at', 'updated_at', 'submitted_at'];

		public function images(){
			return $this->hasMany(IntcommIdeasImages::class);
		}

		public function posts(){
			return $this->hasMany(IntcommPost::class);
		}
}
