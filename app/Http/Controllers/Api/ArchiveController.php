<?php

namespace Emutoday\Http\Controllers\Api;



use Illuminate\Support\Facades\Request as Input;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;
use League\Fractal\Manager;
use League\Fractal;

use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\JsonApiSerializer;

use Emutoday\Announcement;
use Emutoday\Event;
use Emutoday\Category;
use Emutoday\Building;
use Emutoday\Mediafile;
use Emutoday\Mediatype;
use Emutoday\Story;
use Emutoday\StoryIdea;

use Carbon\Carbon;

use Emutoday\Today\Transformers\FractalAnnouncementTransformerModel;
use Emutoday\Today\Transformers\FractalEventTransformerModelFull;
use Emutoday\Today\Transformers\FractalStoryTransformerModel;
use Emutoday\Today\Transformers\FractalStoryIdeaTransformerModel;

use Illuminate\Http\Request;

class ArchiveController extends ApiController
{

  function __construct()
  {
    $this->middleware(['web','auth'], ['only' => [
      'queueLoad', 'unarchive', 'delete',
      ]]);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(){

    }

    public function queueLoad($archiveType, $perPage = 10){
      $currentDate = Carbon::now();

      if (\Auth::check()) {
        $user = \Auth::user();

        if ($user->hasRole('admin')){
            $fractal = new Manager();

            switch($archiveType){
                case 'announcements':
                    // How to use pagination with Fractal: http://fractal.thephpleague.com/pagination/
                    $paginator = Announcement::where('is_archived', 1)->orderBy('start_date', 'desc')->paginate($perPage);
                    $archivedItems = $paginator->getCollection();

                    $resource = new Fractal\Resource\Collection($archivedItems, new FractalAnnouncementTransformerModel);
                    $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

                    return $fractal->createData($resource)->toArray();
                case 'stories':
                    $paginator = Story::where('is_archived', 1)->orderBy('start_date', 'desc')->paginate($perPage);
                    break;
                case 'external':
                    $paginator = Story::where(['is_archived' => 1, 'story_type' => 'external'])->orderBy('start_date', 'desc')->paginate($perPage);
                    break;
                case 'news':
                    $paginator = Story::where(['is_archived' => 1, 'story_type' => 'news'])->orderBy('start_date', 'desc')->paginate($perPage);
                    break;
                case 'article':
                    $paginator = Story::where(['is_archived' => 1, 'story_type' => 'article'])->orderBy('start_date', 'desc')->paginate($perPage);
                    break;
                case 'story':
                    $paginator = Story::where(['is_archived' => 1, 'story_type' => 'story'])->orderBy('start_date', 'desc')->paginate($perPage);
                    break;
                case 'student':
                    $paginator = Story::where(['is_archived' => 1, 'story_type' => 'student'])->orderBy('start_date', 'desc')->paginate($perPage);
                    break;
                case 'statement':
                    $paginator = Story::where(['is_archived' => 1, 'story_type' => 'statement'])->orderBy('start_date', 'desc')->paginate($perPage);
                    break;
                case 'advisory':
                    $paginator = Story::where(['is_archived' => 1, 'story_type' => 'advisory'])->orderBy('start_date', 'desc')->paginate($perPage);
                    break;
                case 'storyideas':
                    $paginator = StoryIdea::where('is_archived', 1)->orderBy('deadline', 'desc')->paginate($perPage);
                    $archivedItems = $paginator->getCollection();

                    $resource = new Fractal\Resource\Collection($archivedItems, new FractalStoryIdeaTransformerModel);
                    $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

                    return $fractal->createData($resource)->toArray();
                default;
                    $archivedItems = array();
                    return $archivedItems;
            }

            $archivedItems = $paginator->getCollection();

            $resource = new Fractal\Resource\Collection($archivedItems, new FractalStoryTransformerModel);
            $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

            return $fractal->createData($resource)->toArray();

        }
        return $this->setStatusCode(403)->respondWithError('You do not have permission to access the archives.');

      } else {
        return $this->setStatusCode(501)->respondWithError('Error loading archive queue.');
      }
    }

    public function unarchive(Request $request, $archiveType, $id){
      $currentDate = Carbon::now();

      if (\Auth::check()) {
        $user = \Auth::user();

        if ($user->hasRole('admin')){
            $fractal = new Manager();

            switch($archiveType){
                case 'announcements':
                    $item = Announcement::findOrFail($id);

                    // How to use pagination with Fractal: http://fractal.thephpleague.com/pagination/
                    $validation = \Validator::make( Input::all(), [
                      'title'           => 'required|max:80|min:10',
                      'start_date'      => 'required|date',
                      'end_date'        => 'required|date',
                      'announcement'     => 'required|max:255'
                    ]);

                    $item->is_archived = 0;
                    $item->is_approved = 0;

                    break;

                case 'storyideas':
                    $item = StoryIdea::findOrFail($id);

                    $validation = \Validator::make( Input::all(), [
                      'title'           => 'required',
                      'idea'            => 'required',
                      'creator'         => 'required',
                      'deadline'        => 'required',
                    ]);

                    $item->is_archived = 0;

                    break;

                case 'stories':
                    // Find story
                    $item = Story::findOrFail($id);
                    $validation = \Validator::make( Input::all(), [
                                 'title'           => 'required',
                                 'start_date'      => 'required',
                                 'user_id'   => 'required',
                                 'content'     => 'required'
                    ]);

                    $item->is_archived = 0;
                    $item->is_approved = 0;

                    break;
            }

            if( $validation->fails() )
            {
              return $this->setStatusCode(422)
              ->respondWithError($validation->errors()->getMessages());
            }
            if($validation->passes()){

                if($item->save()) {
                    return $this->setStatusCode(201)
                    ->respondSavedWithData(ucfirst($archiveType) .' successfully unarchived!',[ 'record_id' => $item->id ]);
                }
            }
        }
        return $this->setStatusCode(403)->respondWithError('You do not have permission to access the archives.');

      } else {
        return $this->setStatusCode(501)->respondWithError('Error loading archive queue.');
      }
    }

    public function delete($archiveType, $id){
        $currentDate = Carbon::now();

        if (\Auth::check()) {
          $user = \Auth::user();

          if ($user->hasRole('admin')){
              $fractal = new Manager();

              switch($archiveType){
                  case 'announcements':
                      $item = Announcement::findOrFail($id);
                      break;

                  case 'storyideas':
                      $item = StoryIdea::findOrFail($id);
                      break;

                  case 'stories':
                      $item = Story::findOrFail($id);
                      break;
              }

              if($item->delete()) {
                  return $this->setStatusCode(200)
                  ->respondSavedWithData(ucfirst($archiveType) .' successfully deleted!',[ 'record_id' => $item->id ]);
              } else {
                  return $this->setStatusCode(400)
                  ->respondWithError("Item was not deleted.");
              }
          }
          return $this->setStatusCode(403)->respondWithError('You do not have permission to access the archives.');

        } else {
          return $this->setStatusCode(501)->respondWithError('Error running authorization check.');
        }
    }
}
