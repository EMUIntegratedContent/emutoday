<?php

namespace Emutoday\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as Input;

use Emutoday\Http\Requests;
use Emutoday\Page;
use Emutoday\Story;

use Emutoday\Today\Transformers\FractalPageTransformer;
use Emutoday\Today\Transformers\FractalPageChartTransformer;
use Emutoday\Today\Transformers\FractalStoryTransformerModel;
use League\Fractal\Manager;
use League\Fractal;
use Carbon\Carbon;

class PageController extends ApiController
{
    /**
     * @var page
     */
    protected $page;

    function __construct(Page $page)
    {
            $this->page = $page;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $fractal = new Manager();

            $page = Page::all();

            $resource = new Fractal\Resource\Collection($page->all(), new FractalPageTransformer);

            return $fractal->createData($resource)->toJson();
    }

    /**
     * Get stories that can be used in a hub page (stories with emutoday_front and/or emutoday_small image types)
     */
    public function getHubReadyStories(Request $request, $fromDate = null, $toDate = null){
        $criteria = array(
            ['story_type','!=' ,'news'],
            ['is_approved',1],
            ['is_approved', 1],
            ['is_ready', 1]
        );

        $stories = Story::orderBy('start_date', 'desc');

        if($fromDate && !$toDate){
            $criteria[] = ['start_date', '>=', $fromDate];
        } elseif($fromDate && $toDate){
            $criteria[] = ['start_date', '>=', $fromDate];
            $stories  = $stories->whereBetween('start_date', array($fromDate, $toDate));
        }

        $stories = $stories->where($criteria)->with('images')->get();

        $fractal = new Manager();
        $resource = new Fractal\Resource\Collection($stories->all(), new FractalStoryTransformerModel);

        return $this->setStatusCode(200)
        ->respondUpdatedWithData('Got stories for page queue', $fractal->createData($resource)->toArray() );
    }

    public function saveHubPage(Request $request){
        $validation = \Validator::make( Input::all(), [
            'start_date' => 'date_format:Y-m-d H:i:s',
            'end_date' => 'date_format:Y-m-d H:i:s'
           ]);

        if( $validation->fails() ){
            return $this->setStatusCode(422)
                        ->respondWithError($validation->errors()->getMessages());
        }

        $page = new Page();
        $page->is_live = $request->get('live');
        $page->start_date = $request->get('start_date');
        $page->end_date = $request->get('end_date');
        $page->user_id = auth()->user()->id;
        $page->template = 'home-emutoday';
        $page->save();

        $fractal = new Manager();
        $resource = new Fractal\Resource\Item($page, new FractalPageTransformer);

        return $this->setStatusCode(201)
            ->respondSavedWithData('The new hub page was successfully created.', $fractal->createData($resource)->toArray());
    }

    public function updateHubPage(Request $request){

    }

    public function saveAs(Request $request, $id)
    {
            $page = Page::findOrFail($id);


            $storyIDString =  $request->get('story_ids');
            $storyIDarray = explode(",", $storyIDString);
            $storyIDarrayCount = count($storyIDarray);

            $storyIDsForPivotArray;

             for ($x = 0; $x < $storyIDarrayCount; $x++) {
                $namedKey = $storyIDarray[$x];
                 $attributeArray = array();
                 $attributeArray["page_position"] = intval($x);
                 $storyIDsForPivotArray[intval($namedKey)] = $attributeArray;

             }
            $page->storys()->sync($storyIDsForPivotArray);
            if($page->save()) {
                    return $this->setStatusCode(201)
                                ->respondCreated('Page Updated');
            }
        }
    public function delete(Request $request)
    {
        $page = $this->page->findOrFail($request->get('id'));
        $page->delete();
        flash()->warning('Page has been deleted.');
        return redirect(route('admin.page.index'));//->with('status', 'Story has been deleted.');
    }

    public function chartLoad()
    {
        $currentDate = Carbon::now();
        $page = Page::where('end_date','>=',$currentDate );
        $fractal = new Manager();
        $resource = new Fractal\Resource\Collection($page->get(), new FractalPageChartTransformer);
        // Turn all of that into a Array string
        return $fractal->createData($resource)->toArray();

    }

}
