<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;

class Bugz extends Model{

	protected $fillable = [
		'type', 'screen',
		'notes', 'priority',
		'complete', 'confirmed'
	];

	protected $casts = [
		'created_at' => 'datetime',
		'updated_at' => 'datetime'
	];


	public function user(){
		return $this->belongsTo('Emutoday\User');
	}
}
