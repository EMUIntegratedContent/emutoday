<?php

namespace Emutoday\Http\Controllers\Api;



use Illuminate\Support\Facades\Input;
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

use Carbon\Carbon;

use Emutoday\Today\Transformers\FractalAnnouncementTransformerModel;
use Emutoday\Today\Transformers\FractalEventTransformerModelFull;

use Illuminate\Http\Request;

class ArchiveController extends ApiController
{

  function __construct()
  {
    $this->middleware(['web','auth'], ['only' => [
      'queueLoad',
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
                default;
                    $archivedItems = array();
                    return $archivedItems;
            }

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
                    break;
            }

            if( $validation->fails() )
            {
              return $this->setStatusCode(422)
              ->respondWithError($validation->errors()->getMessages());
            }
            if($validation->passes()){
                $item->is_archived = 0;
                $item->is_approved = 0;

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
              }

              if($item->save()) {
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
