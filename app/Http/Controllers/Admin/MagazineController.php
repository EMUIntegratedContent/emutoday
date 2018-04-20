<?php

namespace Emutoday\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Emutoday\Magazine;
use Emutoday\Story;
use Emutoday\StoryImage;
use Emutoday\Mediafile;
use Emutoday\Mediatype;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\File;
// import the Intervention Image Manage
use Intervention\Image\ImageManagerStatic as Image;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use JavaScript;
use Emutoday\Http\Requests;

use Emutoday\Helpers\Interfaces\IBug;
use Illuminate\Support\Facades\View;

class MagazineController extends Controller
{

  protected $magazines;
  protected $articleCount = 6;
  protected $bugService;

  public function __construct(Magazine $magazine, Story $story,StoryImage $storyImage, Mediafile $mediafile, IBug $bugService)
  {
      $this->magazine = $magazine;
      $this->story = $story;
      $this->storyImage = $storyImage;
      $this->mediafile = $mediafile;

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
        $magazines_complete = Magazine::where('is_ready',1)->orderBy('start_date', 'desc')->get();
                  $magazines_incomplete = Magazine::where('is_ready',0)->orderBy('start_date', 'desc')->get();


         return view('admin.magazine.index',compact('magazines_incomplete','magazines_complete'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form(Magazine $magazine)
    {
          return view('admin.magazine.form', compact('magazine'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $magazine = $this->magazine->create(
            [ 'user_id' => auth()->user()->id ]
            + $request->only( 'year', 'season','title','subtitle','teaser')
                            );
      flash()->success('Magazine has been setup.');
      return redirect()->route('admin_magazine_edit', $magazine->id);
    }

    public function addCoverImage($id, Request $request)
    {
        $group = 'magazine';
        $type = 'cover';
        $mediafile = $this->mediafile->findOrFail($id);
        //define the image paths
        $destinationFolder = '/imgs/'. $group .'/'.$type;
        $mediafile = new Mediafile();
        //Find mediatype for this type of media file
        $mediatype = Mediatype::where([
                ['group',$group],
                ['type', $type]
            ])->first();
                //Define mediatype to mediafile relationship
        $mediafile->mediatype()->associate($mediatype);

        $mediafile->group = $group;
        $mediafile->type = $type;
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

         $mediafile->name = 'cover'. '-' .$magazine->year . '-' . $magazine->season  . '-' . date('YmdHis');
         $mediafile->ext = $imgFileExtension;

         $imgFileName = $mediafile->name . '.' . $mediafile->ext;


        $image = Image::make($imgFilePath)
                        ->save(public_path() . $destinationFolder . $imgFileName);

        $mediafile->filename = $imgFileName;
        $mediafile->headline = $request->input('headline');
        $mediafile->caption = $request->input('caption');
        $mediafile->teaser = $request->input('teaser');
        $mediafile->link = $request->input('link');
        $mediafile->link_text = $request->input('link_text');
        $mediafile->note = $request->input('note');
        $mediafile->save();
        $magazine->mediafiles()->save($mediafile);
        flash()->success('Cover Image has been added');
        return redirect(route('admin_magazine_edit', $magazine->id));
    }

    public function updateCoverImage($id, Request $request)
    {
        $mediafile = $this->mediafile->findOrFail($id);
        $magazine = $mediafile->magazines()->first();
        $destinationFolder = '/imgs/'. $mediafile->group .'/';

        if ( ! empty(Input::file('photo'))) {
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
            $mediafile->path = $destinationFolder;
            $mediafile->name = $mediafile->type .'-'. $magazine->year . '-' . $magazine->season . '-' . date('YmdHis');
            $mediafile->ext = $imgFileExtension;
            $imgFileName = $mediafile->name . '.' . $mediafile->ext;
            $mediafile->filename = $imgFileName;
            $image = Image::make($imgFilePath)
                      ->save(public_path() . $destinationFolder . $imgFileName);
        }
            $mediafile->headline = $request->input('headline');
            $mediafile->caption = $request->input('caption');
            $mediafile->teaser = $request->input('teaser');
            $mediafile->link = $request->input('link');
            $mediafile->link_text = $request->input('link_text');
            $mediafile->note = $request->input('note');
            $mediafile->save();

            flash()->success('The Cover Image has been updated');
            return redirect()->back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $magazine = $this->magazine->findOrFail($id);
      $storyImages = $this->magazine->storyImages();
            $magazineCover = $magazine->mediafiles()->where('type','cover')->first();
            $magazineExtra = $magazine->mediafiles()->where('type','extra')->first();
            // dd($storyImages);
      $barImgs = collect();


      foreach ($magazine->storys as $story) {
          if ($story->pivot->story_position === 0) {
              $heroImg = $story->storyImages()->where('image_type', 'front')->first();
          } else {
              $barImgs->push( $story->storyImages()->where('image_type', 'small')->first() );
          }

      }
      JavaScript::put([
          'jsis' => 'hi',
      ]);

      return view('public.magazine.index', compact('magazine', 'storyImages', 'heroImg', 'barImgs', 'magazineCover','magazineExtra'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $magazine = $this->magazine->findOrFail($id);
            $storys = Story::where([
                ['story_type', 'article'],
                ['is_approved',1]
                ])
                ->with(['images' => function($query){
                    $query->where('group','=','article');
                  }])->orderBy('id', 'desc')->get();



            $storyimgs = $this->storyImage->where([
                        ['group','article'],
                        ['image_type', 'small'],
                        ])
                        ->orderBy('updated_at', 'desc')->get();
      // $storys =  $this->story->where('story_type', 'article')->orderBy('updated_at', 'desc')->get();
            $mediatypes = Mediatype::where('group','magazine')->pluck('type','id');

            // foreach ($mediatypes as $mediatype) {
            // 	$magazinefile = $magazine->mediafiles->firstOrCreate(['mediatype_id' => $mediatype->id]);
            // }
            $magazineMedia = Mediatype::ofGroup('magazine')->get();
            // $otherImages = Imagetype::ofGroup('magazine')->isRequired(0)->get();
            foreach ($magazineMedia as $img) {
                    $magazine->mediafiles()->firstorCreate([
                        'mediatype_id'=> $img->id,
                        'group'=> $img->group,
                        'type'=> $img->type
                ]);
            }

            $mediafile = $this->mediafile;
            $mediafiles = $magazine->mediafiles;
            $magazineStorys = $magazine->storys;
            $original_story_ids = $magazineStorys->pluck('id');
            // dd($original_story_ids);

            JavaScript::put([
                    'mainrecordid' => $magazine->id,
                    'mediatypes' => $mediatypes,
                    'original_story_ids' => $original_story_ids,
                    'magazinestorys' => $magazineStorys->toArray(),
                    'storyimgs' => $storyimgs->toArray(),
                    'storys' => $storys->toArray()
      ]);

      return view('admin.magazine.edit', compact('magazine', 'storys','storyimgs','mediatypes', 'mediafiles','mediafile','original_story_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $magazine = $this->magazine->findOrFail($id);
      $storyIDString =  $request->get('story_ids');
      $storyIDarray = explode(",", $storyIDString);
      $storyIDarrayCount = count($storyIDarray);
      $storyIDsForPivotArray =[];

       for ($x = 0; $x < $storyIDarrayCount; $x++) {
          $namedKey = $storyIDarray[$x];
           if($namedKey != 0) {
           $attributeArray = array();
           $attributeArray["story_position"] = intval($x);
           $storyIDsForPivotArray[intval($namedKey)] = $attributeArray;
            }

       }
       $magazine->is_ready = 1;

       if (empty($storyIDsForPivotArray)) {
           $magazine->is_ready = 0;
       } else {
           if(count($storyIDsForPivotArray) < $this->articleCount){
               $magazine->is_ready = 0;
           } else {
            //    $page->is_ready = 1;
           }
           $magazine->storys()->sync($storyIDsForPivotArray);

       }

       $magazineMediaCount = Mediatype::ofGroup('magazine')->where('is_required',1)->count();


       if($magazine->mediafiles->count() < $magazineMediaCount){
           $magazine->is_ready = 0;
       }

      $magazine->year = $request->year;
      $magazine->season   = $request->season;
      $magazine->title = $request->title;
      $magazine->subtitle   = $request->subtitle;
      $magazine->teaser = $request->teaser;
      $magazine->ext_url = $request->ext_url;
      $magazine->start_date = \Carbon\Carbon::parse($request->start_date);
      $magazine->end_date = \Carbon\Carbon::parse($request->end_date);

      $magazine->cover_art = $request->cover_art;
      $magazine->is_published = $request->is_published;
      $magazine->is_archived = $request->is_archived;
      $magazine->save();
      flash()->success('Magazine has been updated.');
      return redirect(route('admin_magazine_edit', $magazine->id));
    }

    /**
     * Confirm the deletion of magazine model / record
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function confirm($id)
    {
        $magazine = $this->magazine->findOrFail($id);
        return view('admin.magazine.confirm', compact('magazine'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
      $magazine = $this->magazine->findOrFail($id);
      $magazine->delete();
      flash()->warning('Magazine has been deleted.');
      return redirect()->route('admin_magazine_index');//->with('status', 'Story has been deleted.');
    }
}
