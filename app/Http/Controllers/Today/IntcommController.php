<?php

namespace Emutoday\Http\Controllers\Today;

use Emutoday\Http\Controllers\Controller;
use Emutoday\IntcommPost;
use Illuminate\Support\Facades\View;
use Emutoday\Imagetype;

class IntcommController extends Controller{
	protected $post;

	public function __construct(IntcommPost $post){
		$this->post = $post;
//			$this->middleware('auth', []);
	}

	/**
	 * Display all of the live posts.
	 */
	public function index(){
		$now = now();

		// Retrieve the IDs of the required image types
		$requiredImageTypeIds = Imagetype::select('id')
			->where('is_required', 1)
			->where('group', 'intcommpost')
			->pluck('id')
			->toArray();

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
			->with('images')
			->get();
		return view('public.intcomm.index', compact('posts'));
	}
}
