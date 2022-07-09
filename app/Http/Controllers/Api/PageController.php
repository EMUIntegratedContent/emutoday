<?php

namespace Emutoday\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Input;

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
     * Get the specified page
     */
     public function edit(Page $page){
       $fractal = new Manager();
       $resource = new Fractal\Resource\Item($page, new FractalPageTransformer);

       return $this->setStatusCode(200)
       ->respondUpdatedWithData('Got page.', $fractal->createData($resource)->toArray() );
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

        $stories = $stories->where($criteria)->with('images', 'storyGroup')->get();

        return $this->setStatusCode(200)
        ->respondUpdatedWithData('Got stories for page queue', $stories );
    }

    /**
     * Save a new hub page
     * NOTE: Request object will have TWO sub-objects: "page" and "stories"
     */
    public function store(Request $request){
        $validation = \Validator::make( $request->get('page'), [
            'start_date' => 'date_format:Y-m-d H:i:s',
            'end_date' => 'date_format:Y-m-d H:i:s'
           ]);

        if( $validation->fails() ){
            return $this->setStatusCode(422)
                        ->respondWithError($validation->errors()->getMessages());
        }

        // Create a new hub page
        $page = new Page();
        $page->is_live = $request->get('page')['live'];
        $page->start_date = $request->get('page')['start_date'];
        $page->end_date = $request->get('page')['end_date'];
        $page->user_id = auth()->user()->id;
        $page->template = 'home-emutoday';
        $page->template_elements = 5;
        $page->save(); // SAVE THE NEW PAGE

        // Associated stories with this page.
        $this->syncStoriesWithPage($page, $request->get('stories'));

        $fractal = new Manager();
        $resource = new Fractal\Resource\Item($page, new FractalPageTransformer);

        return $this->setStatusCode(201)
            ->respondSavedWithData('The new hub page was successfully created.', $fractal->createData($resource)->toArray());
    }

    /**
     * Update an existing hub page
     * NOTE: Request object will have TWO sub-objects: "page" and "stories"
     */
    public function update(Request $request){
        $validation = \Validator::make( $request->get('page'), [
            'start_date' => 'date_format:Y-m-d H:i:s',
            'end_date' => 'date_format:Y-m-d H:i:s'
           ]);

        if( $validation->fails() ){
            return $this->setStatusCode(422)
                        ->respondWithError($validation->errors()->getMessages());
        }

        $page = $this->page->findOrFail($request->get('page')['id']);

        $page->start_date = $request->get('page')['start_date'];
        $page->end_date = $request->get('page')['end_date'];
        $page->save(); // SAVE THE NEW PAGE

        // Associated stories with this page.
        $this->syncStoriesWithPage($page, $request->get('stories'));

        $fractal = new Manager();
        $resource = new Fractal\Resource\Item($page, new FractalPageTransformer);

        return $this->setStatusCode(201)
            ->respondUpdatedWithData('The hub page was successfully updated.', $fractal->createData($resource)->toArray());
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

    /**
     * Delete a hub page.
     *
     * @param int $id
     * @return array
     */
    public function destroy($id)
    {
      $page = $this->page->findOrFail($id);
      $page->delete();
      return $this->setStatusCode(200)->respond('Page successfully deleted!');
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

    /**
     * Sync EMU Today stories with the appropriate hub page
     */
    private function syncStoriesWithPage(Page $page, $stories){
        $storyIDsForPivotArr = array();

        // Loop through each of the stories to be associated
        foreach($stories as $position => $story){
            // Some story slots might not have a story
            if($story != null){
                $attributeArr = array();
                // set the story's position on the hub paged based on the story position from the builder
                switch($position){
                    case 'main_story':
                        $attributeArr["page_position"] = 0;
                        break;
                    case 'sub_story_1':
                        $attributeArr["page_position"] = 1;
                        break;
                    case 'sub_story_2':
                        $attributeArr["page_position"] = 2;
                        break;
                    case 'sub_story_3':
                        $attributeArr["page_position"] = 3;
                        break;
                    case 'sub_story_4':
                        $attributeArr["page_position"] = 4;
                        break;
                }
                $attributeArr["note"] = 'nothing to see here';

                // Add the story id as a key to the array, Add the attributes as the value
                $storyIDsForPivotArr[$story["id"]] = $attributeArr;
            }
        }

        // Determine if page is ready for public viewing based on the number of associated stories
        if (empty($storyIDsForPivotArr)) {
            $page->is_ready = 0;
        } else {
            if(count($storyIDsForPivotArr) < $page->template_elements){
                $page->is_ready = 0;
            } else {
                $page->is_ready = 1;
            }

            // Finally, associate the stories with this hub page
            $page->storys()->sync($storyIDsForPivotArr);
        }

        $page->save();
    }

}
