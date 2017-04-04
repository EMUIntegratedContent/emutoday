<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\Expert;
use Emutoday\User;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Input as Input;
use Carbon\Carbon;
// use emutoday\Emutoday\Transformers\FractalAnnouncementTransformer;

// use emutoday\Emutoday\Transformers\AnnouncementTransformer;
use League\Fractal\Manager;
use League\Fractal;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

use Emutoday\Today\Transformers\FractalExpertsTransformerModel;
class ExpertsController extends ApiController
{
  function __construct()
  { //
  }

  /**
  * [API Call from AnnouncementItem to change some variables]
  * @param  [type]  $id      [description]
  * @param  Request $request [description]
  * @return [type]           [description]
  */
  public function updateItem($id, Request $request)
  {
    $announcement = Announcement::findOrFail($id);
    $announcement->is_approved = $request->get('is_approved',0);
    $announcement->priority = $request->get('priority', 0);
    $announcement->is_archived = $request->get('is_archived',0);
    if (is_null($announcement->approved_date)) {
      $announcement->approved_date  = Carbon::now();
    }

    if($announcement->save()) {

      $returnData = ['is_approved' => $announcement->is_approved,'priority'=> $announcement->priority, 'is_archived'=> $announcement->is_archived];
      return $this->setStatusCode(201)
      ->respondUpdatedWithData('announcement updated',$returnData );
    }
  }

  public function store(Request $request)
  {
    $expert = new Expert;
    $validation = \Validator::make( Input::all(), [
      'first_name'          => 'required|max:80|min:2',
      'last_name'           => 'required|max:80|min:2',
      'title'               => 'required',
      'about'               => 'required',
      'education'           => 'required',
    ]);

    if( $validation->fails() )
    {
      return $this->setStatusCode(422)
      ->respondWithError($validation->errors()->getMessages());
    }
    if($validation->passes())
    {
      $expert->first_name           = $request->get('first_name');
      $expert->last_name      	    = $request->get('last_name');
      $expert->title      	        = $request->get('title');
      $expert->about     	        = $request->get('about');
      $expert->education            = $request->get('education');
      $expert->expertise            = $request->get('expertise', null);

      if($expert->save()) {
        return $this->setStatusCode(201)
        ->respondSavedWithData('Expert successfully saved!',[ 'record_id' => $expert->id ]);
      }
    }
  }

  public function edit($id)
  {
    $fractal = new Manager();
    $author = Author::findOrFail($id);

    $resource = new Fractal\Resource\Item($author, new FractalAuthorTransformerModel);
    // Turn all of that into a JSON string
    return $fractal->createData($resource)->toArray();
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
    $expert = Expert::findOrFail($id);

    $validation = \Validator::make( Input::all(), [
      'first_name'          => 'required|max:80|min:2',
      'last_name'           => 'required|max:80|min:2',
      'title'               => 'required',
      'about'               => 'required',
      'education'           => 'required',
    ]);

    if( $validation->fails() )
    {
      return $this->setStatusCode(422)
      ->respondWithError($validation->errors()->getMessages());
    }
    if($validation->passes())
    {
        $expert->first_name         = $request->get('first_name');
        $expert->last_name      	= $request->get('last_name');
        $expert->title      	    = $request->get('title');
        $expert->about     	        = $request->get('about');
        $expert->education          = $request->get('education');
        $expert->expertise          = $request->get('expertise', null);

        if($expert->save()) {
            return $this->setStatusCode(201)
            ->respondSavedWithData('Expert successfully updated!',[ 'record_id' => $expert->id ]);
        }
    }
  }
}
