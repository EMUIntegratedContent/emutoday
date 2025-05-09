<?php

namespace Emutoday\Http\Controllers\Admin;

use Intervention\Image\Laravel\Facades\Image;
use Storage;

use Emutoday\StoryImage;
use Emutoday\Story;
use Illuminate\Http\Request;
use Emutoday\Http\Requests;

use Illuminate\Support\Facades\Request as Input;
use Illuminate\Support\Facades\File;

use Emutoday\Helpers\Interfaces\IBug;
use Illuminate\Support\Facades\View;

class StoryImageController extends Controller
{

  protected $storyImages;
  protected $bugService;

  public function __construct(StoryImage $storyImages, Story $story, IBug $bugService)
  {
    $this->storyImages = $storyImages;
    $this->story= $story;

    $this->bugService = $bugService;
    View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
    View::share('bugEvents', $this->bugService->getUnapprovedEvents());
    View::share('bugStories', $this->bugService->getUnapprovedStories());
    View::share('bugExperts', $this->bugService->getUnapprovedExperts());
    View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
		View::share('bugInsideemuIdeas', $this->bugService->getNewInsideemuIdeas());

    parent::__construct();


  }

  public function index()
  {
      return "This feature has been removed";
    //$storyImages = $this->storyImages->paginate(10);
    //return view('admin.storyimages.index', compact('storyImages'));
  }

  public function create(StoryImage $storyImage)
  {
    return view('admin.storyimages.form', compact('storyImage'));
  }

  public function store(Requests\StoryImage_StoreRequest $request)
  {
    $this->storyImages->create($request->only('image_type'));
    //return redirect(route('backend.users.index'))->with('status', 'User has been created.');
  }

  public function addNewStoryImage($qtype,$gtype,$stype,$id,Request $request)
  {
    $story_id = $request->story_id;
    $story = $this->story->findOrFail($story_id);
    $stype = $story->story_type;
    $storyGroup = $story->storyType->group;
    $story->storyImages()->create([
      'imagetype_id'=> $request->img_id,
      'group'=> $storyGroup,
      'image_type'=> $request->img_type,
      'image_name'=> 'img' . $story->id . '_' . $request->img_type

    ]);
    if($request->img_type == 'front' || $request->img_type == 'hero') {
      // Stories with 'front' image can be featured story
      // Stories with 'hero' image can be featured story on Today.
      $story->is_featured = 1;
      $story->save();
    }
    flash()->success('New Image Added.');
    $rurl = '/admin/'.$qtype.'/'.$gtype.'/'.$stype.'/'.$story->id.'/edit';


    return redirect($rurl);
  }

  public function update($id, Requests\StoryImage_UpdateRequest $request)
  {
    $qtype = $request->get('qtype');
    $gtype = $request->get('gtype');
    $stype = $request->get('stype');
    //create new instance of model to save from form
    $storyImage = $this->storyImages->findOrFail($id);
    $story = $storyImage->story;
    $rurl = '/admin/'.$qtype.'/'.$gtype.'/'.$stype.'/'.$story->id.'/edit';

    $storyImage->image_type = $request->get('image_type');
    $storyImage->is_active = $request->get('is_active');
    $storyImage->title = $request->get('title');
    $storyImage->caption = $request->get('caption');
    $storyImage->teaser = $request->get('teaser');
    $storyImage->moretext = $request->get('moretext');
    $storyImage->link = $request->get('link');
    $storyImage->link_text = $request->get('link_text');
    $storyImage->alt_text = $request->get('alt_text');

    //define the image paths
    $destinationFolder = '/imgs/story/';

    //assign the image paths to new model, so we can save them to DB
    $storyImage->image_path = $destinationFolder;
    // format checkbox values and save model

    $this->formatCheckboxValue($storyImage);
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
      $storyImage->image_extension = $imgFileExtension;
      $imgFileName = $storyImage->image_name . '-'. date('YmdHis') . '.' . $storyImage->image_extension;

			// Uses intervention\image-laravel to save the image.
			Image::read($imgFilePath)->save(public_path().$destinationFolder.$imgFileName);

      $storyImage->filename = $imgFileName;
    }

    $storyImage->save();
    if($request->img_type == 'front' || $request->img_type == 'hero') {
      // Stories with 'front' image can be featured story on Magazines,
      // Stories with 'hero' image can be featured story on Today.
      $story->is_featured = 1;
      $story->save();
    }
    flash()->success('Image has been updated.');

    return redirect($rurl);
  }

  public function edit($id)
  {
    $storyImage = $this->storyImages->findOrFail($id);
    return view('admin.storyimages.edit', compact('storyImage'));
  }

  public function show($id)
  {
    $storyImage = $this->storyImages->findOrFail($id);
    // $marketingImage = Marketingimage::findOrFail($id);

    return view('admin.storyimages.show', compact('storyImage'));
  }

  public function confirm($id)
  {
    $storyImage = $this->storyImages->findOrFail($id);

    return view('admin.storyimages.confirm', compact('storyImage'));
  }

  public function destroy($id, Request $request)
  {
    $storyImage = $this->storyImages->findOrFail($id);

    $story = Story::findOrFail($storyImage->story_id);

    $pathToImageForDelete = public_path() . $storyImage->image_path . $storyImage->filename;

    if(File::exists($pathToImageForDelete)){
        //delete the actual file
        File::delete($pathToImageForDelete);
        flash()->warning('Image has been deleted');

        //delete the story_image record
        $storyImage->delete();
    } else {
       flash()->warning('Image was not found and could not be deleted.');
    }

    // Determine if the story is should still be set as featured based on the images
    $is_featured_story = false;
    foreach($story->storyImages as $img){
        if($img->image_type == 'front' || $img->image_type == 'hero'){
            $is_featured_story = true;
            break; // When a front or hero image is found, break out of the loop
        }
    }

    if($is_featured_story){
        $story->is_featured = 1;
    } else {
        $story->is_featured = 0;
    }
    $story->save();

    return redirect()->back();//->with('status', 'Record has been deleted.');
  }

  public function formatCheckboxValue($storyImage)
  {
    $storyImage->is_active = ($storyImage->is_active == null) ? 0 : 1;
  }
}
