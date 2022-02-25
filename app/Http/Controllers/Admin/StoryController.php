<?php

namespace Emutoday\Http\Controllers\Admin;

use Emutoday\Story;
use Emutoday\StoryImage;
use Emutoday\Tag;
use Emutoday\User;
use Emutoday\Imagetype;
use Emutoday\StoryType;
// use Emutoday\Emutoday\Transformers\FractalStoryTransformer;
// use Emutoday\Emutoday\Transformers\FractalStoryExtraTransformer;
// use Emutoday\Emutoday\Transformers\StoryTransformer;

use League\Fractal\Manager;
use League\Fractal;
use Illuminate\Http\Request;
use Emutoday\Http\Requests;
use DB;
use JavaScript;

use Emutoday\Helpers\Interfaces\IBug;
use Illuminate\Support\Facades\View;

class StoryController extends Controller
{
    private $story;
    private $bugService;

    public function __construct(Story $story, IBug $bugService)
    {
        $this->story = $story;

        $this->bugService = $bugService;
        View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
        View::share('bugEvents', $this->bugService->getUnapprovedEvents());
        View::share('bugStories', $this->bugService->getUnapprovedStories());
        View::share('bugExperts', $this->bugService->getUnapprovedExperts());
        View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
    }


    public function queueAll(Story $story) {
        $storys = $this->story;
        $stypes  = collect(\Emutoday\StoryType::select('name','shortname')->get());
        $sroute = 'story';
        $qtype  = 'queueall';
        \JavaScript::put([
            'records' => $storys
        ]);
        return view('admin.story.queue', compact('storys','sroute', 'stypes', 'qtype'));
    }
    public function queueType(Story $story, $stype) {
        $storys = $this->story;
        $sroute = 'story';
        $stypes  = 'news';
        $qtype  = 'queuenews';
        \JavaScript::put([
            'records' => $storys
        ]);
        return view('admin.story.queue', compact('storys','sroute', 'stypes', 'qtype'));
    }

    public function updateFromPreview(Request $request, $id)
    {
      $story = $this->story->findOrFail($id);
      $story->content = $request->get('content');
      $story->save();
      flash()->success('Story Content has been updated.');
      return redirect()->back();
    }

    public function promoteStory(Request $request)
        {
            $story = $this->story->findOrFail($request->id);
            $story->story_type = $request->new_story_type;
            $story->save();
            $storyGroup = $story->storyType->group;
            $qtype = $request->qtype;
            $gtype = $request->gtype;

            $requiredImages = Imagetype::ofGroup($storyGroup)->isRequired(1)->get();
            $stype = $story->story_type;
            foreach ($requiredImages as $img) {
							// Since we can now demote stories, don't create image types if they already exist! CP (2/25/22)
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
            $rurl = '/admin/'.$qtype.'/'.$gtype.'/'.$stype.'/'.$story->id.'/edit';
            return redirect($rurl);
        }

	public function demoteStory(Request $request)
	{
		{
			$story = $this->story->findOrFail($request->id);
			$story->story_type = 'news';
			$story->save();

			$qtype = $request->qtype;
			$gtype = $request->gtype;
			$stype = $story->story_type;

			flash()->success("Story has been demoted to 'News'.");
			$rurl = '/admin/'.$qtype.'/'.$gtype.'/'.$stype.'/'.$story->id.'/edit';
			return redirect($rurl);

		}

	}

}
