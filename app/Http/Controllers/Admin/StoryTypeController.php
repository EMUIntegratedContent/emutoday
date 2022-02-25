<?php

namespace Emutoday\Http\Controllers\Admin;

use Emutoday\Story;
use Emutoday\StoryImage;
use Emutoday\Tag;
use Emutoday\User;
use Emutoday\Imagetype;
use Emutoday\StoryType;

use League\Fractal\Manager;
use League\Fractal;
use Illuminate\Http\Request;
use Emutoday\Http\Requests;
use DB;
use JavaScript;

use Emutoday\Helpers\Interfaces\IBug;
use Illuminate\Support\Facades\View;

class StoryTypeController extends Controller
{
    private $story;

    public function __construct(Story $story, StoryType $storyType, IBug $bugService)
    {
        $this->story = $story;
        $this->storyType = $storyType;

        $this->bugService = $bugService;
        View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
        View::share('bugEvents', $this->bugService->getUnapprovedEvents());
        View::share('bugStories', $this->bugService->getUnapprovedStories());
        View::share('bugExperts', $this->bugService->getUnapprovedExperts());
        View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());

    }
    public function queueAll(Story $story) {
        $gtype = 'story';
        $qtype = 'queueall';
        $stype = 'all';
        $sroute = 'story';
        if ($qtype === 'queueall') {
            $stypes  = collect(\Emutoday\StoryType::select('name','shortname')->orderBy('display_order', 'asc')->get());
        } else {
            $stypes  = $stype;
        }
        return view('admin.story.queue', compact('sroute', 'gtype', 'stypes', 'stype', 'qtype'));
    }
    public function queue($gtype, $stype, $qtype) {

        $gtype = $gtype;
        $stype = $stype;
        $qtype = $qtype;

        $sroute = 'story';
        if ($qtype === 'queueall') {
            $stypes  = collect(\Emutoday\StoryType::select('name','shortname')->orderBy('display_order', 'asc')->get());
        } else {
            $stypes  = $stype;
        }

        return view('admin.story.queue', compact('sroute', 'gtype', 'stypes', 'stype', 'qtype'));
    }
    /**
     * Route to setup article specific queue
     * @param  Story  $story [description]
     * @return [type]        [description]
     */
        public function queueArticle(Story $story) {
            // $storys = $this->story;
            $sroute = 'magazine';
            $gtype = 'magazine';
            $stypes  = 'article';
            $stype= 'article';
            $qtype  = 'queuearticle';

            return view('admin.magazine.article.queue', compact('sroute', 'gtype', 'stypes', 'stype', 'qtype'));
        }

    public function storyTypeForm($qtype,$gtype,$stype){
        $sroute = 'x';
        $story = new Story;

            $stypelist = \Emutoday\StoryType::where('level', 1)->pluck('name','shortname')->all();
            $stypes  = collect(\Emutoday\StoryType::select('name','shortname')->orderBy('display_order', 'asc')->get());

        $user = \Auth::user();
            if ($user->hasRole('contributor_1')){
                // dd($user->id);
                $stypelist = 'news';
                $stype = 'news';
                $stypes = 'news';
                $qtype = 'queuenews';
            } else {
                if($gtype === 'story'){
                    $stypelist =  $stypelist;
                    $stypes = $stypes;

                } elseif ($gtype === 'magazine') {
                    $stypelist = 'article';
                    $stype = 'article';
                    $stypes = 'article';

                } else {
                    $stypes = $stype;
                    $stypelist =  $stypelist;
                }


            }
            JavaScript::put([
                'cuser' => $user,
                'stypes' => $stypes,
                'storytype' => $stype,
                'stypelist' => $stypelist
            ]);

            return view('admin.story.form', compact('story','qtype', 'sroute','gtype','stype' ,'stypes', 'stypelist' ));

    }

    /**
    * [storyTypeSetUp description]
    * @param  [type] $stype [description]
    * @return [type]        [description]
    */
    public function storyTypeSetUp($stype)
    {
        $sroute = 'story';
        $story = new Story;
        $stypelist = \Emutoday\StoryType::where('level', 1)->pluck('name','shortname')->all();

        $stypes  = collect(\Emutoday\StoryType::select('name','shortname')->orderBy('display_order', 'asc')->get());

        $user = \Auth::user();
            if ($user->hasRole('contributor_1')){
                // dd($user->id);
                $stypelist = 'news';
                $stype = 'news';
                $stypes = 'news';
            } else {
                if($stype == 'new') {
                    $stypelist =  $stypelist;
                    $stypes = $stypes;
                } else {
                    $stypes = $stype;
                    $stypelist =  $stypelist;
                }
            }
            JavaScript::put([
                'cuser' => $user,
                'stypes' => $stypes,
                'storytype' => $stype,
                'stypelist' => $stypelist
            ]);

            return view('admin.story.form', compact('story','sroute','stype' ,'stypes', 'stypelist' ));

    }


    /**
    * Route::get('magazine/article/setup', ['as' => 'admin_magazine_article_setup', 'uses' => 'Admin\StoryController@articleSetup']);
    * @return [type]        [Direct route for creating a magazine article]
    */
    public function articleSetup()
    {
        $user = \Auth::user();
        $story = null;
        $sroute = 'magazine';
        $stypelist = 'article';
        $stype = 'article';
        $stypes = 'article';
        $story->story_type = $stypes;

        JavaScript::put([
            'cuser' => $user,
            'stypes' => $stypes,
            'storytype' => $stype,
            'stypelist' => $stypelist
        ]);
        return view('admin.story.form', compact('story','sroute','stype' ,'stypes', 'stypelist' ));
    }

    public function storyTypeEdit($qtype, $gtype,$stype, Story $story)
    {
        $urlprev = \URL::previous();

        if(str_contains($urlprev, 'magazine')) {
            $sroute = 'magazine';
        } else {
            $sroute = 'story';
        }

        $user = \Auth::user();
        $stypelist = \Emutoday\StoryType::where('level', 1)->pluck('name','shortname');
        $stypes  = collect(\Emutoday\StoryType::select('name','shortname')->orderBy('display_order', 'asc')->get());

        $tags = \Emutoday\Tag::pluck('name', 'id');

        if ($stype == 'emutoday'){
            $stype = 'story';
        }

        $storyGroup = $story->storyType->group;

        JavaScript::put([
            'story' => $story,
            'stype' => $stype,
            'storytype' => $story->story_type,
            'is_featured' => $story->is_featured,
        ]);

        if ($user->hasRole('contributor_1')){
            $stypelist = 'news';
            $stype = 'news';
            $stypes = 'news';
        } else {
            $requiredImageListCollection = Imagetype::ofGroup($storyGroup)->isRequired(1)->get();
            $otherImageListCollection = Imagetype::ofGroup($storyGroup)->isRequired(0)->get();

            // List out the  required image types  needed
            $requiredImageList = Imagetype::ofGroup($storyGroup)->isRequired(1)->pluck('type', 'id');

            //create array of required images to compare with actual images
            $requiredImageCollect = Imagetype::ofGroup($storyGroup)->isRequired(1)->pluck('id');//keyBy('id');
            $requiredImageKeyArray = $requiredImageCollect->toArray();

            $currentRequiredImages = $story->storyImages->whereIn('imagetype_id',$requiredImageKeyArray);

            $remainingRequiredImagesNeeded = $requiredImageList->count() - $currentRequiredImages->count();

            if($remainingRequiredImagesNeeded > 0) {
								$canDemote = true;
                $currentRequiredImagesIdsList = $currentRequiredImages->pluck('imagetype_id');
                $currentRequiredImagesIdsListArray = $currentRequiredImagesIdsList->toArray();

                $stillNeedTheseImgs = $requiredImageListCollection->except($currentRequiredImagesIdsListArray);

                $currentOtherImages = null;

                return view('admin.story.form', compact('story','qtype','gtype','sroute','stype' ,'stypes', 'stypelist' ,'currentRequiredImages','currentOtherImages', 'stillNeedTheseImgs', 'canDemote'));

            } else {
								// $stillNeedTheseImgs does NOT take into account if the filename field is blank in story_images. This does.
								$canDemote = DB::table('story_images')
									->select('story_images.image_name')
									->join('imagetypes', function ($join) {
										$join->on('imagetypes.id', '=', 'story_images.imagetype_id')
											->where('imagetypes.is_required', '=', 1);
									})
									->where('story_images.story_id', '=', $story->id)
									->where('story_images.filename', '=', '')
									->where('story_images.group', '=', $storyGroup)
									->count();
                $otherImageCollect = Imagetype::ofGroup($storyGroup)->isRequired(0)->pluck('id');//keyBy('id');
                $otherImageKeyArray = $otherImageCollect->toArray();

                $currentOtherImages = $story->storyImages->whereIn('imagetype_id',$otherImageKeyArray);

                $remainingOtherImagesNeeded = $otherImageCollect->count() - $currentOtherImages->count();

                if ($remainingOtherImagesNeeded > 0) {
                        $currentOtherImagesIdsList = $currentOtherImages->pluck('imagetype_id');
                        $currentOtherImagesIdsListArray = $currentOtherImagesIdsList->toArray();
                        $stillNeedTheseImgs = $otherImageListCollection->except($currentOtherImagesIdsListArray);

                        return view('admin.story.form', compact('story','qtype','gtype','sroute','stype' ,'stypes', 'stypelist' ,'currentRequiredImages','currentOtherImages', 'stillNeedTheseImgs', 'canDemote'));

                } else {
                    $stillNeedTheseImgs = null;
                    return view('admin.story.form', compact('story','qtype','gtype','sroute','stype' ,'stypes', 'stypelist' ,'currentRequiredImages','currentOtherImages', 'stillNeedTheseImgs', 'canDemote'));
                }
            }
        }
        $currentRequiredImages = null;
        $currentOtherImages = null;
        $stillNeedTheseImgs = null;

        return view('admin.story.form', compact('story','qtype','gtype','sroute','stype' ,'stypes', 'stypelist' ,'currentRequiredImages','currentOtherImages', 'stillNeedTheseImgs'));
    }



public function index(){
    $stypes = \Emutoday\StoryType::all()->pluck('group','group');
    $stypes = $stypes->prepend('all', 'all');
    $stype = 'all';
    \JavaScript::put([
        'stype' => 'all'
    ]);


    return view('admin.story.index', compact('stype','stypes'));
}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create($stype)
{
    $story = new Story;
    $sroute = 'story';
    if ($stype != 'story' ) {
        if ($stype == 'external'){
            return view('admin.story.external', compact('story', 'stype'));
        } else {
            return view('admin.story.create', compact('story', 'stype'));
        }
    } else {
        $stypes = $stype;
        $stypelist = \Emutoday\StoryType::where('level', 1)->pluck('name','shortname');

        return view('admin.story.form', compact('story','sroute', 'stypes','stypelist'));


    }

}
public function imageBrowse(Request $request)
{
    dd($request->all());
    $this->validate($request, [
        'image' => 'required|dimensions:max_width=900,max_height=500|size:3000|'
    ]);
    $CKEditor = Input::get('CKEditor');
    $funcNum = Input::get('CKEditorFuncNum');
    $message = $url = '';
    $uploadDestination = public_path() . '/imgs/uploads/story/';

    if (Input::hasFile('upload')) {
        $file = Input::file('upload');
        if ($file->isValid()) {
            $filename = $file->getClientOriginalName();
            $file->move($uploadDestination, $filename);
            $url = $uploadDestination . $filename;
        } else {
            $message = 'An error occured while uploading the file.';
        }
    } else {
        $message = 'No file uploaded.';
    }
    return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';

}

// Route::post('/upload_image', function() {
public function imageUpload(Request $request)
{


    $file = $request->file('upload');


    $uploadDestination = public_path() . '/imgs/uploads/story/';
    $filename = preg_replace('/\s+/', "", $file->getClientOriginalName());
    $fileName = md5($filename) . "_" . $filename;
    $file->move($uploadDestination, $fileName);
}



public function addImage($id)
{
    $story = $this->story->findOrFail($id);
    $storyImage = $story->addImage('hero');
    flash()->success('New Image Added.');
    return redirect(route('admin_story_edit', $story->id));
}

public function addNewImage($id, Request $request)
{
    $story = $this->story->findOrFail($id);
    $storyGroup = $story->storyType->group;
    $story->storyImages()->create([
        'imagetype_id'=> $request->img_id,
        'group'=> $storyGroup,
        'image_type'=> $request->img_type,
        'image_name'=> 'img' . $story->id . '_' . $request->img_type

    ]);
    if($request->img_type == 'front') {
        $story->is_featured = 1;
        $story->save();
    }
    flash()->success('New Image Added.');
    return redirect(route('admin_story_edit', $story->id));
}
public function promoteStory($id, Request $request)
{
    $story = $this->story->findOrFail($id);
    $story->story_type = $request->new_story_type;
    $story->save();
    $storyGroup = $story->storyType->group;


    $requiredImages = Imagetype::ofGroup($storyGroup)->isRequired(1)->get();
    $otherImages = Imagetype::ofGroup($storyGroup)->isRequired(0)->get();
    $stypelist = StoryType::where('level', 1)->pluck('name','shortname');
    $stypes = $story->story_type;

    foreach ($requiredImages as $img) {
			$existingImg = StoryImage::where([
				['story_id', '=', $story->id],
				['imagetype_id', '=', $img->id]
			])->first();
			if(!$existingImg) {
				$story->storyImages()->create([
					'imagetype_id'=> $img->id,
					'group'=> $storyGroup,
					'image_type'=> $img->type,
					'image_name'=> 'img' . $story->id . '_' . $img->type

				]);
			}
    }


    flash()->success('Story has been Promoted.');

    return redirect(route('admin_story_edit', $story->id));

}

/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
    $story = $this->story->findOrFail($id);
    $stype = $story->story_type;

    if ($stype == 'external') {
        $smallStoryImg = $story->storyImages()->where('image_type', 'small')->first();

        return view('admin.story.previewexternal', compact('story','smallStoryImg'));
    } else if ($stype == 'news') {

        return view('admin.story.preview', compact('story'));
    } else {

        $mainStoryImg = $story->storyImages()->where('image_type', 'story')->first();

        $smallStoryImg = $story->storyImages()->where('image_type', 'small')->first();
        // dd($smallStoryImg);
        return view('admin.story.preview', compact('story','mainStoryImg','smallStoryImg'));
    }


}
public function update(Requests\UpdateStoryRequest $request, $id)
{
    $story = $this->story->findOrFail($id);

    $story->fill($request->only('title', 'slug', 'subtitle', 'teaser','content','external_link', 'story_type','is_approved', 'is_featured'));
    $story->start_date = \Carbon\Carbon::parse($request->start_date);
    $story->end_date = $request->end_date == null ? null:  \Carbon\Carbon::parse($request->end_date);
    $story->save();
    $taglistRequest = $request->input('tag_list') == null ? [] : $request->input('tag_list');
    $story->tags()->sync($taglistRequest);

    $storyGroup = $story->storyGroup->group;
    $requiredImages = Imagetype::ofGroup($storyGroup)->isRequired(1)->get();
    $countRequiredImages = $requiredImages->count();

    $currentStoryImages = $story->storyImages()->where('is_active', 1)->get();
    $countCurrentStoryImages = $currentStoryImages->count();

    if($countCurrentStoryImages >= $countRequiredImages){
        $story->is_ready = 1;
        $story->is_promoted = 1;
    } else {
        $story->is_ready = 0;
        $story->is_promoted = 0;
    }
    $story->save();
    flash()->success('Story has been updated.');
    return redirect(route('admin_story_edit', $story->id));
}

public function destroy($id)
{
    $story = $this->story->findOrFail($id);
    $story->delete();
    flash()->warning('Story has been deleted.');
    return redirect(route('admin.story.index'));
}

public function confirm($id)
{
    $story = $this->story->findOrFail($id);
    return view('admin.story.confirm', compact('story'));
}

public function edit($id)
{
    $story = $this->story->findOrFail($id);
    $sroute = 'story';
    if ($story->story_type == 'emutoday'){
        $story->story_type = 'story';
    }
    $stypes = $story->story_type;
    $tags = \Emutoday\Tag::pluck('name', 'id');
    $stypelist = \Emutoday\StoryType::where('level', 1)->pluck('name','shortname');
    JavaScript::put([
        'stype' => $stypes,
        'storytype' => $story->story_type,
        'is_featured' => $story->is_featured,
    ]);
    $user = auth()->user();
    if($user == null)
    {
        return redirect(route('admin.dashboard'));
    }


    if ($user->hasRole('contributor_1'))
    {
        $stypelist = $story->story_type;
        $storyGroup = $story->storyGroup->group;
        $imagetypeNames = null;
        $currentStoryImages = null;
        $leftOverImages = null;
        $requiredImages = null;
        $otherImages = null;

        return view('admin.story.form', compact('story','sroute', 'stypes', 'tags','stypelist','requiredImages','otherImages', 'leftOverImages'));

    } else {
        $storyGroup = $story->storyGroup->group;
        $imagetypeNames = Imagetype::ofGroup($storyGroup)->get()->keyBy('id');
        $currentStoryImages = $story->storyImages->pluck('image_type','imagetype_id');
        $leftOverImages = $imagetypeNames->diffKeys($currentStoryImages);
        $requiredImages = Imagetype::ofGroup($storyGroup)->isRequired(1)->get();
        $otherImages = Imagetype::ofGroup($storyGroup)->isRequired(0)->get();

        return view('admin.story.form', compact('story','sroute', 'stypes', 'tags','stypelist','requiredImages','otherImages', 'leftOverImages'));
    }


}


    private function syncTags(Story $story, array $tags)
    {
        $story->tags()->sync($tags);

    }



}
