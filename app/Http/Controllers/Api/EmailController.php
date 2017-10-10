<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\Email;
use Emutoday\Story;
use Emutoday\User;
use Emutoday\ImageType;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Input as Input;
use Carbon\Carbon;

use League\Fractal\Manager;
use League\Fractal;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

//use Emutoday\Today\Transformers\FractalEmailTransformerModel;
use Emutoday\Today\Transformers\FractalStoryTransformerModel;

class EmailController extends ApiController
{
  function __construct()
  { //
  }

  public function getAllEmailReadyStories(Request $request, $fromDate = null, $toDate = null){
      if($fromDate && !$toDate){
          $stories  = Story::whereHas('storyImages', function($query){
                        $query->where('name', '=', 'emutoday_email');
                      })
                      ->where([['start_date', '>=', $fromDate], ['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->get();
      } elseif($fromDate && $toDate){
          $stories  = Story::where([['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->whereBetween('start_date', array($fromDate, $toDate))->get();
      } else {
          $stories  = Story::where([['is_archived', 0], ['is_approved', 1], ['is_ready', 1]])->get();
      }

      $fractal = new Manager();
      $resource = new Fractal\Resource\Collection($stories->all(), new FractalStoryTransformerModel);

      return $this->setStatusCode(200)
      ->respondUpdatedWithData('Got stories with email photo', $fractal->createData($resource)->toArray() );
  }

  /**
   * Delete an email.
   *
   * @param int $id
   * @return array
   */
  public function delete($id)
  {
    $expert = Email::findOrFail($id);
    $expert->delete();
    return $this->setStatusCode(200)->respond('Email successfully deleted!');
  }
}
