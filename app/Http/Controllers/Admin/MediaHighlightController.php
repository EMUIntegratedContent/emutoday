<?php

namespace Emutoday\Http\Controllers\Admin;


use Emutoday\MediaHighlight;
use Emutoday\MediaHighlightTag;
use Illuminate\Http\Request;

use Emutoday\Http\Requests;
use Emutoday\Helpers\Interfaces\IBug;

use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\DB;

class MediaHighlightController extends Controller{

	protected $highlight;
	protected $bugService;

	public function __construct(MediaHighlight $highlight, IBug $bugService){
		$this->highlight = $highlight;
		$this->bugService = $bugService;

		View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
		View::share('bugEvents', $this->bugService->getUnapprovedEvents());
		View::share('bugStories', $this->bugService->getUnapprovedStories());
		View::share('bugExperts', $this->bugService->getUnapprovedExperts());
		View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
		View::share('bugInsideemuIdeas', $this->bugService->getNewInsideemuIdeas());
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($atype = null){
		$highlightsPaginated = MediaHighlight::orderBy('start_date', 'desc')->paginate(20);
		$topTagsPaginated = MediaHighlightTag::join('mediahighlights_tags', 'mediahighlights_tags.tag_id', '=', 'media_highlight_tags.id')
			->groupBy('media_highlight_tags.id')
			->orderBy('tag_count', 'desc')
			->select('media_highlight_tags.id', 'media_highlight_tags.name')
			->selectRaw('COUNT(media_highlight_tags.id) AS tag_count')
			->paginate(20);

		return view('admin.mediahighlight.index', compact('highlightsPaginated', 'topTagsPaginated'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id){
		$user = \Auth::user();
		$highlight = $this->highlight->findOrFail($id);

		return view('admin.mediahighlight.form', compact('highlight'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function form(){
		$highlight = $this->highlight;

		return view('admin.mediahighlight.form', compact('highlight'));
	}

	/**
	 * Delete the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id){
		$highlight = $this->highlight->findOrFail($id);
		$title = $highlight->title;
		$highlight->delete();
		return back()->with('highlight_deleted', 'Highlight "'.$title.'" was successfully deleted.');
	}

}
