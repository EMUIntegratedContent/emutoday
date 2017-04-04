<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\Expert;
use Emutoday\ExpertCategory;
use Emutoday\User;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Input as Input;
use Carbon\Carbon;
use League\Fractal\Manager;
use League\Fractal;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

use Emutoday\Today\Transformers\FractalExpertCategoryTransformerModel;
class ExpertCategoryController extends ApiController
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
    $category = ExpertCategory::findOrFail($id);
    $category->category = $request->get('category',null);

    if($category->save()) {

      $returnData = ['category' => $category->category];
      return $this->setStatusCode(201)
      ->respondUpdatedWithData('announcement updated',$returnData );
    }
  }

  public function store(Request $request)
  {
    $category = new ExpertCategory;
    $validation = \Validator::make( Input::all(), [
      'category'          => 'required|max:80|min:3',
    ]);

    if( $validation->fails() )
    {
      return $this->setStatusCode(422)
      ->respondWithError($validation->errors()->getMessages());
    }
    if($validation->passes())
    {
      $category->category           = $request->get('first_name');

      if($category->save()) {
        return $this->setStatusCode(201)
        ->respondSavedWithData('Expert category successfully saved!',[ 'record_id' => $category->id ]);
      }
    }
  }

  public function edit($id)
  {
    $fractal = new Manager();
    $category = ExpertCategory::findOrFail($id);

    $resource = new Fractal\Resource\Item($category, new FractalExpertCategoryTransformerModel);
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
    $category = ExpertCategory::findOrFail($id);

    $validation = \Validator::make( Input::all(), [
      'category'          => 'required|max:80|min:3',
    ]);

    if( $validation->fails() )
    {
      return $this->setStatusCode(422)
      ->respondWithError($validation->errors()->getMessages());
    }
    if($validation->passes())
    {
        $category->category         = $request->get('category');

        if($category->save()) {
            return $this->setStatusCode(201)
            ->respondSavedWithData('Expert category successfully updated!',[ 'record_id' => $category->id ]);
        }
    }
  }
}
