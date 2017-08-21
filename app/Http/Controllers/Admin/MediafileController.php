<?php

namespace Emutoday\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Emutoday\Http\Requests;
use Emutoday\User;
use Emutoday\Mediafile;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
// use Illuminate\Routing\Route;

use Emutoday\Helpers\Interfaces\IBug;
use Illuminate\Support\Facades\View;

class MediafileController extends Controller
{
      protected $mediafile;
      protected $bugService;

            public function __construct(Mediafile $mediafile, User $user, IBug $bugService)
            {
                    $this->mediafile = $mediafile;
                    $this->user = $user;

                    $this->bugService = $bugService;
                    View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
                    View::share('bugEvents', $this->bugService->getUnapprovedEvents());
                    View::share('bugStories', $this->bugService->getUnapprovedStories());

                    parent::__construct();
            }
            public function index()
        {
                $mediafiles = $this->mediafile->paginate(10);
                return view('admin.mediafile.index', compact('mediafiles'));
        }



            public function addMediafileUser($id, Request $request)
            {

                    $group = 'user';
                    $user = $this->user->findOrFail($id);
                    //define the image paths
                    $destinationFolder = '/imgs/user/';

                    $mediafile = new Mediafile();
                    //assign the image paths to new model, so we can save them to DB
                    $mediafile->path = $destinationFolder;


                        //parts of the image we will need
                    // if ( ! empty(Input::file('photo'))){
                        $imgFile = $request->file('photo');

                        // $imgFile = Input::file('photo');
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
                         $mediafile->name = 'user'. '-' .$user->id;
                         $mediafile->ext = $imgFileExtension;

                         $imgFileName = $mediafile->name . '.' . $mediafile->ext;



                    $image = Image::make($imgFilePath)
                     ->save(public_path() . $destinationFolder . $imgFileName);
                    //  ->fit(100)
                    //  ->save(public_path() . $destinationFolder . 'thumbnails/' . 'thumb-' . $imgFileName);

                // 	}
                //
                    $mediafile->filename = $imgFileName;
                    $mediafile->type = 'avatar';
                    $mediafile->group = $group;
                    // $mediafile->caption = $request->input('caption');
                    // $mediafile->note = $request->input('note');
                    $mediafile->save();
                    $user->mediaFiles()->save($mediafile);
                    flash()->success('User Image has been added');
                    return redirect()->action('Admin\UserController@edit', $user->id);//->with('status', 'Story has been created.');


            }

            public function update($id, Request $request)
            {

                    $mediafile = $this->mediafile->findOrFail($id);
                    $path_old = $mediafile->path;
                    $type_old = $mediafile->type;
                    $group_old = $mediafile->group;
                    $name_old = $mediafile->name;

                    $user = $mediafile->users->first();
                    if ($request->hasFile('photo'))
                    {
                        $imgFile = $request->file('photo');

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

                     $mediafile->name = $name_old;
                     $mediafile->ext = $imgFileExtension;

                     $imgFileName = $mediafile->name . '.' . $mediafile->ext;
                     $image = Image::make($imgFilePath)
                                         ->save(public_path() . $mediafile->path . $imgFileName);

                }
                $mediafile->filename = $mediafile->name . '.' . $mediafile->ext;
                $user->mediaFiles()->save($mediafile);
                flash()->success('Mediafile has been updated');

                return redirect()->action('Admin\UserController@edit', $user->id);

            }
            public function removeMediafileUser($id)
        {
            $mediafile = $this->mediafile->findOrFail($id);

            $pathToImageForDelete = public_path() . $mediafile->path . $mediafile->name . '.' . $mediafile->ext;
            \File::delete($pathToImageForDelete);

            $mediafile->delete();
            flash()->warning('Record has been deleted');

            return redirect()->back();//->with('status', 'Record has been deleted.');
        }




    public function create(Mediafile $mediafile)
    {
        return view('admin.mediafile.form', compact('mediafile'));
    }

    public function store(Request $request)
    {

        //return redirect(route('backend.users.index'))->with('status', 'User has been created.');
    }

    public function edit($id)
    {
        $mediafile = $this->generalImages->findOrFail($id);
        return view('admin.generalImages.edit', compact('generalImage'));
    }


    public function show($id)
    {
        $mediafile = $this->generalImages->findOrFail($id);

       return view('admin.generalImages.show', compact('generalImage'));
    }
    public function confirm($id)
    {
        $mediafile = $this->generalImages->findOrFail($id);

        return view('admin.generalImages.confirm', compact('generalImage'));
    }

    public function destroy($id)
    {
        $mediafile = $this->generalImages->findOrFail($id);

        $pathToImageForDelete = public_path() . $mediafile->image_path . $mediafile->image_name . '.' . $mediafile->image_extension;
        File::delete($pathToImageForDelete);

        $pathToImageThumbForDelete = public_path() . $mediafile->image_path . 'thumbnails/' . 'thumb-' . $mediafile->image_name . '.' . $mediafile->image_extension;
        File::delete($pathToImageThumbForDelete);

        $mediafile->delete();
        flash()->warning('Record has been deleted');

        return redirect(route('admin.generalImages.index'));//->with('status', 'Record has been deleted.');
    }
    public function formatCheckboxValue($mediafile)
    {

       $mediafile->is_active = ($mediafile->is_active == null) ? 0 : 1;

    }


}
