<?php

namespace Emutoday\Http\Controllers\Today;

use Emutoday\Http\Controllers\Controller;
use Emutoday\Http\Resources\InsideemuPostResource;
use Emutoday\InsideemuPost;
use Illuminate\Support\Facades\View;
use Emutoday\Imagetype;

class InsideemuController extends Controller{
	protected $post;

	public function __construct(InsideemuPost $post){
		$this->post = $post;
	}

	/**
	 * Display all of the live posts.
	 */
	public function index(){
		$now = now();

		// Retrieve the IDs of the required image types
		$requiredImageTypeIds = Imagetype::select('id')
			->where('is_required', 1)
			->where('group', 'insideemu')
			->pluck('id')
			->toArray();

		// Posts are ordered by seq then by date
		$posts = $this->post->whereNotNull('title')
			->whereNotNull('content')
			->where('admin_status', 'Approved')
			->where('start_date', '<=', $now)
			->where(function ($query) use ($now) {
				$query->where('end_date', '>=', $now)
					->orWhereNull('end_date');
			})
			->whereHas('images', function ($query) use ($requiredImageTypeIds) {
				$query->whereIn('imagetype_id', $requiredImageTypeIds);
			})
			->with(['images' => function ($query) use ($requiredImageTypeIds) {
				// Only retrieve the required images for each post (in this case, the 'small' image)
				$query->whereIn('imagetype_id', $requiredImageTypeIds);
			}])
			->orderByRaw('CASE WHEN seq >= 1 THEN 0 ELSE 1 END, seq ASC')
			->orderByRaw('CASE WHEN seq = 0 THEN start_date END DESC')
			->get();

		return view('public.insideemu.index', compact('posts'));
	}
}
