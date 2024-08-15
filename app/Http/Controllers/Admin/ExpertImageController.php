<?php

namespace Emutoday\Http\Controllers\Admin;

use Storage;

use Emutoday\ExpertImage;
use Emutoday\Expert;
use Illuminate\Http\Request;
use Emutoday\Http\Requests;

use Illuminate\Support\Facades\Request as Input;
use Illuminate\Support\Facades\File;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

use Emutoday\Helpers\Interfaces\IBug;
use Illuminate\Support\Facades\View;

class ExpertImageController extends Controller
{

  protected $expertImage;
  protected $bugService;

  public function __construct(ExpertImage $expertImage, Expert $expert, IBug $bugService)
  {
    $this->expertImage = $expertImage;
    $this->expert= $expert;

    $this->bugService = $bugService;
    View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
    View::share('bugEvents', $this->bugService->getUnapprovedEvents());
    View::share('bugStories', $this->bugService->getUnapprovedStories());
    View::share('bugExperts', $this->bugService->getUnapprovedExperts());
    View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
		View::share('bugInsideemuIdeas', $this->bugService->getNewInsideemuIdeas());

    parent::__construct();

  }

  public function create(ExpertImage $expertImage)
  {
    return view('admin.expertimages.form', compact('expertImage'));
  }

  public function store(Requests\ExpertImage_StoreRequest $request)
  {
    $this->expertImage->create();
  }

  public function addNewExpertImage(Request $request)
  {
    $expert_id = $request->expert_id;
    $expert = $this->expert->findOrFail($expert_id);

    $expert->expertImages()->create([
      'imagetype_id'=> $request->img_id,
      'group'=> 'experts',
      'image_name'=> 'img' . $expert->id . '_headshot',
      'is_active' => 1
    ]);

    $expert->save();

    flash()->success('New Image Added.');
    $rurl = '/admin/experts/'.$expert->id.'/edit';

    return redirect($rurl);
  }

  public function update($id, Requests\ExpertImage_UpdateRequest $request)
  {
    //create new instance of model to save from form
    $expertImage = $this->expertImage->findOrFail($id);

    $expertImage->is_active = 1;
    $expertImage->title = $request->get('title');
    $expertImage->caption = $request->get('caption');

    //define the image paths
    $destinationFolder = '/imgs/expert/';
    //assign the image paths to new model, so we can save them to DB
    $expertImage->image_path = $destinationFolder;

    $rurl = '/admin/experts/'.$expertImage->expert->id.'/edit';
    $this->formatCheckboxValue($expertImage);
    //parts of the image we will need
    if ( ! empty(Input::file('image'))){
      $imgFile = Input::file('image');
      $imgFilePath = $imgFile->getRealPath();
      $imgFileOriginalExtension = strtolower($imgFile->getClientOriginalExtension());

      switch ($imgFileOriginalExtension) {
        case 'jpg':
        case 'jpeg':
        $imgFileExtension = 'jpg';
        break;
        default:
        $imgFileExtension = $imgFileOriginalExtension;
      }
      $expertImage->image_extension = $imgFileExtension;
      $imgFileName = $expertImage->image_name . '-'. date('YmdHis') . '.' . $expertImage->image_extension;

      Image::make($imgFilePath)
      ->save(public_path() . $destinationFolder . $imgFileName);

      $expertImage->filename = $imgFileName;
    }

    $expertImage->save();
    $expert = $expertImage->expert;

    $expert->save();

    flash()->success('Image has been updated.');

    return redirect($rurl);
  }

  public function edit($id)
  {
    $expertImage = $this->expertImage->findOrFail($id);
    return view('admin.expertimages.edit', compact('expertImage'));
  }

  public function show($id)
  {
    $expertImage = $this->expertImage->findOrFail($id);
    return view('admin.storyimages.show', compact('expertImage'));
  }

  public function confirm($id)
  {
    $expertImage = $this->expertImage->findOrFail($id);
    return view('admin.storyimages.confirm', compact('expertImage'));
  }

  public function destroy($id, Request $request)
  {
    $expertImage = $this->expertImage->findOrFail($id);

    $expert = Expert::findOrFail($expertImage->expert_id);

    $pathToImageForDelete = public_path() . $expertImage->image_path . $expertImage->filename;

    if(File::exists($pathToImageForDelete)){
        //delete the actual file
        File::delete($pathToImageForDelete);
        flash()->warning('Image has been deleted');

        //delete the story_image record
        $expertImage->delete();
    } else {
       flash()->warning('Image was not found and could not be deleted.');
    }

    $expert->save();

    return redirect()->back();//->with('status', 'Record has been deleted.');
  }

  public function formatCheckboxValue($expertImage)
  {
    $expertImage->is_active = ($expertImage->is_active == null) ? 0 : 1;
  }
}
