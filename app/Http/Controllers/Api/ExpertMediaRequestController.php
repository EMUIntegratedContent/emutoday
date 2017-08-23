<?php

namespace Emutoday\Http\Controllers\Api;

use Emutoday\ExpertMediaRequest;
use Emutoday\Expert;
use Emutoday\User;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Input as Input;
use Carbon\Carbon;

use League\Fractal\Manager;
use League\Fractal;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

use Emutoday\Today\Transformers\FractalExpertRequestTransformerModel;

class ExpertMediaRequestController extends ApiController
{
  function __construct()
  { //
  }

  /**
   * Create and save a new expert request
   */
  public function store(Request $request)
  {
    $validation = \Validator::make( Input::all(), [
        'expert_id'      => 'required',
        'name'           => 'required|max:70|min:2',
        'title'          => 'required|max:100|min:2',
        'phone'          => 'required',
        'email'          => 'required|email',
        'interview_type' => 'required',
        'description'    => 'required'
    ]);

    // Honeypot is a method to catch bots filling out forms.
    if( $validation->fails() || ($request->get('honeypot') != ''))
    {
      return $this->setStatusCode(422)
      ->respondWithError($validation->errors()->getMessages());
    }

    if($validation->passes())
    {
        $expertMediaRequest = new ExpertMediaRequest;

        $expertMediaRequest->expert_id           = $request->get('expert_id');
        $expertMediaRequest->name      	         = $request->get('name');
        $expertMediaRequest->title      	     = $request->get('title');
        $expertMediaRequest->phone     	         = $request->get('phone');
        $expertMediaRequest->email               = $request->get('email');
        $expertMediaRequest->interview_type      = $request->get('interview_type');
        $expertMediaRequest->description         = $request->get('description');
        $expertMediaRequest->media_outlet        = $request->get('media_outlet', null);
        $expertMediaRequest->city                = $request->get('city', null);
        $expertMediaRequest->state               = $request->get('state', null);
        $expertMediaRequest->deadline            = $request->get('deadline', null);

        if($expertMediaRequest->save()) {
          return $this->setStatusCode(201)
          ->respondSavedWithData('Expert media request successfully submitted!',[ 'record_id' => $expertMediaRequest->id ]);
        }
    }
  }

  public function getExpertMediaRequest($id){
      $result = ExpertMediaRequest::findOrFail($id);

      return $this->setStatusCode(200)
      ->respondUpdatedWithData('Got expert media request', $result );
  }

  /**
  * [API Call from Expert form to change some variables]
  * @param  [type]  $id      [description]
  * @param  Request $request [description]
  * @return [type]           [description]
  */
  public function updateItem($id, Request $request)
  {
    $expertMediaRequest = ExpertMediaRequest::findOrFail($id);
    $expertMediaRequest->expert_id           = $request->get('expert_id');
    $expertMediaRequest->name      	         = $request->get('name');
    $expertMediaRequest->title      	     = $request->get('title');
    $expertMediaRequest->phone     	         = $request->get('phone');
    $expertMediaRequest->email               = $request->get('email');
    $expertMediaRequest->interview_type      = $request->get('interview_type');
    $expertMediaRequest->description         = $request->get('description');
    $expertMediaRequest->media_outlet        = $request->get('media_outlet', null);
    $expertMediaRequest->city                = $request->get('city', null);
    $expertMediaRequest->state               = $request->get('state', null);
    $expertMediaRequest->deadline            = $request->get('deadline', null);
    $expertMediaRequest->is_acknowledged            = $request->get('is_acknowledged', 0);

    if($expertMediaRequest->save()) {
      return $this->setStatusCode(201)
      ->respondUpdatedWithData('Expert media request updated.',[ 'record_id' => $expertMediaRequest->id ] );
    }
  }
}
