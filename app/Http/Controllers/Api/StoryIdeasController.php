<?php

namespace Emutoday\Http\Controllers\Api;

use Emutoday\StoryIdea;
use Emutoday\StoryIdeaMedium;
use Emutoday\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input as Input;
use Carbon\Carbon;

use League\Fractal\Manager;
use League\Fractal;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

use Emutoday\Today\Transformers\FractalStoryIdeaTransformerModel;

class StoryIdeasController extends ApiController
{
  function __construct()
  { //
  }

  public function getIdeas(Request $request){
      $ideas = StoryIdea::where('is_archived', 0)->orderBy('created_at', 'desc')->get();

      $fractal = new Manager();
      $resource = new Fractal\Resource\Collection($ideas->all(), new FractalStoryIdeaTransformerModel);

      return $this->setStatusCode(200)
      ->respondUpdatedWithData('Got story ideas', $fractal->createData($resource)->toArray() );
  }

  public function updateIdea(Request $request, $id){
      $idea = StoryIdea::findOrFail($id);

      // Validation rules
      $validation = \Validator::make( Input::all(), [
        'title'           => 'required',
        'idea'            => 'required',
        'creator'         => 'required',
        'deadline'        => 'required',
      ]);

      // Check against Validation rules
      if( $validation->fails()){
        return $this->setStatusCode(422)
        ->respondWithError($validation->errors()->getMessages());
      }

      // Patch record if Valid
      if($validation->passes()){
        //cas()->authenticate(); //run authentication before calling cas->user

        $idea->title        = Input::get('title');
        $idea->idea         = Input::get('idea');
        $idea->creator      = Input::get('creator')['id'];
        $idea->deadline     = Carbon::parse(Input::get('deadline')['date']);
        $idea->is_completed = Input::get('is_completed');
        $idea->is_archived  = Input::get('is_archived');

        $idea->save();

        $fractal = new Manager();
        $resource = new Fractal\Resource\Item($idea, new FractalStoryIdeaTransformerModel);

        return $this->setStatusCode(200)
        ->respondUpdatedWithData('Patched story idea ' . $id, $fractal->createData($resource)->toArray() );
      }

      return $this->setStatusCode(400)
      ->respondWithError('Bad Request.');
  }
}
