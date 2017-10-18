<?php

namespace Emutoday\Http\Controllers\Admin;


use Emutoday\Expert;
use Emutoday\ExpertCategory;
use Illuminate\Http\Request;

use Emutoday\Http\Requests;
use Emutoday\Helpers\Interfaces\IBug;

use Illuminate\Support\Facades\View;
use JavaScript;

class ExpertCategoryController extends Controller
{

    protected $expertCategory;
    protected $bugService;

    public function __construct(ExpertCategory $expertCategory, IBug $bugService)
    {
        $this->expertCategory = $expertCategory;
        $this->bugService = $bugService;

        View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
        View::share('bugEvents', $this->bugService->getUnapprovedEvents());
        View::share('bugStories', $this->bugService->getUnapprovedStories());
        View::share('bugExperts', $this->bugService->getUnapprovedExperts());
        View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
      $categoriesPaginated = ExpertCategory::orderBy('category', 'asc')->paginate(10);
      return view('admin.expertcategory.index', compact('categoriesPaginated'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $expertCategory = $this->expertCategory->findOrFail($id);

        return view('admin.expertcategory.form', compact('expertCategory'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function form()
    {
        $expertCategory = $this->expertCategory;

        return view('admin.expertcategory.form', compact('expertCategory'));
    }

}
