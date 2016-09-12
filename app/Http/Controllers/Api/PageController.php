<?php

namespace Emutoday\Http\Controllers\Api;

use Illuminate\Http\Request;

use Emutoday\Http\Requests;
use Emutoday\Page;

use Emutoday\Today\Transformers\FractalPageTransformer;
use Emutoday\Today\Transformers\FractalPageChartTransformer;
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
                // Turn all of that into a JSON string
                return $fractal->createData($resource)->toJson();
            // return $this->respond([
            //     'data' => $this->storyTransformer->transformCollection($storys->all())
            // ]);
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

    // this.$http.get('/api/story/queueload')
    public function chartLoad()
    {

        // $pgs = \DB::table('pages')->select('id', 'uri','start_date', 'end_date')->get();
        // $strys = \DB::table('storys')->select('id', 'title', 'start_date', 'end_date')->get();
        //$page = Page::has('storys', '>=', 5)->get();
        // $page = Page::all();
        $currentDate = Carbon::now();
        $page = Page::where('end_date','>=',$currentDate );
        $fractal = new Manager();
        // $storys = Story::all();
        $resource = new Fractal\Resource\Collection($page->get(), new FractalPageChartTransformer);
        // Turn all of that into a Array string
        return $fractal->createData($resource)->toArray();

    }




}
