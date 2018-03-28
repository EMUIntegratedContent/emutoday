<?php

namespace Emutoday\Http\Controllers\Admin;


use Emutoday\Expert;
use Emutoday\Imagetype;
use Illuminate\Http\Request;

use Emutoday\Http\Requests;
use Emutoday\Helpers\Interfaces\IBug;

use Illuminate\Support\Facades\View;
use JavaScript;
use Emutoday\User;

class ExpertsController extends Controller
{

    protected $expert;
    protected $bugService;

    public function __construct(Expert $expert, IBug $bugService)
    {
        $this->expert = $expert;
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
      $expertsPaginated = Expert::orderBy('last_name', 'asc')->paginate(10);
      return view('admin.experts.index', compact('expertsPaginated'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $expert = $this->expert->findOrFail($id);

        $currentRequiredImages = null;
        $currentOtherImages = null;
        $stillNeedTheseImgs = null;

        $imagetypeNames = Imagetype::ofGroup('experts')->get()->keyBy('id');

        $requiredImageListCollection = Imagetype::ofGroup('experts')->isRequired(1)->get();
        $otherImageListCollection = Imagetype::ofGroup('experts')->isRequired(0)->get();

        // List out the  required image types  needed
        $requiredImageList = Imagetype::ofGroup('experts')->isRequired(1)->pluck('type', 'id');
        $requiredImageListArray = $requiredImageList->toArray();

        // List out all the possible other image types
        $otherImageList = Imagetype::ofGroup('experts')->isRequired(0)->pluck('type', 'id');
        $otherImageListArray = $otherImageList->toArray();

        //create array of requireed images to compare with actual iamges
        $requiredImageCollect = Imagetype::ofGroup('experts')->isRequired(1)->pluck('id');
        $requiredImageKeyArray = $requiredImageCollect->toArray();

        $currentRequiredImages = $expert->expertImages->whereIn('imagetype_id',$requiredImageKeyArray);

        $remainingRequiredImagesNeeded = $requiredImageList->count() - $currentRequiredImages->count();

        if($remainingRequiredImagesNeeded > 0) {
            $currentRequiredImagesIdsList = $currentRequiredImages->pluck('imagetype_id');
            $currentRequiredImagesIdsListArray = $currentRequiredImagesIdsList->toArray();

            $stillNeedTheseImgs = $requiredImageListCollection->except($currentRequiredImagesIdsListArray);

            $currentOtherImages = null;

            return view('admin.experts.form', compact('expert','currentRequiredImages','currentOtherImages','stillNeedTheseImgs'));
        }

        $otherImageCollect = Imagetype::ofGroup('experts')->isRequired(0)->pluck('id');
        $otherImageKeyArray = $otherImageCollect->toArray();

        $currentOtherImages = $expert->expertImages->whereIn('imagetype_id', $otherImageKeyArray);
        $remainingOtherImagesNeeded = $otherImageCollect->count() - $currentOtherImages->count();

        if ($remainingOtherImagesNeeded > 0) {
                $currentOtherImagesIdsList = $currentOtherImages->pluck('imagetype_id');
                $currentOtherImagesIdsListArray = $currentOtherImagesIdsList->toArray();
                $stillNeedTheseImgs = $otherImageListCollection->except($currentOtherImagesIdsListArray);

                return view('admin.experts.form', compact('expert','currentRequiredImages','currentOtherImages', 'stillNeedTheseImgs'));
        } else {
            $stillNeedTheseImgs = null;
            return view('admin.experts.form', compact('expert','currentRequiredImages','currentOtherImages', 'stillNeedTheseImgs'));
        }
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function form()
    {
      echo "WONK";
        $expert = $this->expert;

        $user = \Auth::user();

        JavaScript::put([
            'cuser' => $user,
        ]);

        return view('admin.experts.form', compact('expert'));
    }

    /**
     *  Update the expert from the admin/preview view (which uses CKEDITOR)
     */
    public function updateFromPreview(Request $request, $id)
    {
        $expert = $this->expert->findOrFail($id);
        $expert->biography = $request->get('biography');
        $expert->save();
        flash()->success('Expert biography has been updated.');
        return redirect()->back();
    }

}
