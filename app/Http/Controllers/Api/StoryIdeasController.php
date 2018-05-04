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

  public function index(Request $request){
      $ideas = StoryIdea::where('is_archived', 0)->orderBy('deadline', 'asc')->get();

      $fractal = new Manager();
      $resource = new Fractal\Resource\Collection($ideas->all(), new FractalStoryIdeaTransformerModel);

      return $this->setStatusCode(200)
      ->respondUpdatedWithData('Got story ideas', $fractal->createData($resource)->toArray() );
  }

  public function edit($id){
    $fractal = new Manager();
    $idea = StoryIdea::findOrFail($id);

    $resource = new Fractal\Resource\Item($idea, new FractalStoryIdeaTransformerModel);
    // Turn all of that into a JSON string
    return $fractal->createData($resource)->toArray();
  }

  public function store(Request $request){
      $idea = new StoryIdea;

      // Validation rules
      $validation = \Validator::make( Input::all(), [
        'title'           => 'required',
        'idea'            => 'required',
        'medium'          => 'required',
      ]);

      // Check against Validation rules
      if( $validation->fails()){
        return $this->setStatusCode(422)
        ->respondWithError($validation->errors()->getMessages());
      }

      // Patch record if Valid
      if($validation->passes()){
        $idea->title        = Input::get('title');
        $idea->idea         = Input::get('idea');
        $idea->creator      = \Auth::user()->id; // the currently logged-in user
        $idea->medium       = Input::get('medium')['value'];
        $idea->assignee     = Input::get('assignee')['value'];
        $idea->deadline     = Carbon::parse(Input::get('deadline')['date']);

        $idea->save();

        $fractal = new Manager();
        $resource = new Fractal\Resource\Item($idea, new FractalStoryIdeaTransformerModel);

        return $this->setStatusCode(201)
        ->respondSavedWithData('Story idea successfully saved!',[ 'record_id' => $idea->id ]);
      }

      return $this->setStatusCode(400)
      ->respondWithError('Bad Request.');
  }

  public function update(Request $request, $id){
      $idea = StoryIdea::findOrFail($id);

      // Validation rules
      $validation = \Validator::make( Input::all(), [
        'title'           => 'required',
        'idea'            => 'required',
        'medium'          => 'required',
      ]);

      // Check against Validation rules
      if( $validation->fails()){
        return $this->setStatusCode(422)
        ->respondWithError($validation->errors()->getMessages());
      }

      // Patch record if Valid
      if($validation->passes()){
        $idea->title        = Input::get('title');
        $idea->idea         = Input::get('idea');
        $idea->creator      = Input::get('creator')['value'];
        $idea->assignee     = Input::get('assignee')['value'];
        $idea->medium       = Input::get('medium')['value'];
        $idea->deadline     = Carbon::parse(Input::get('deadline')['date']);
        $idea->is_completed = Input::get('is_completed');
        $idea->is_archived  = Input::get('is_archived');

        $idea->save();

        $fractal = new Manager();
        $resource = new Fractal\Resource\Item($idea, new FractalStoryIdeaTransformerModel);

        return $this->setStatusCode(200)
        ->respondUpdatedWithData('Updated story idea.', $fractal->createData($resource)->toArray() );
      }

      return $this->setStatusCode(400)
      ->respondWithError('Bad Request.');
  }

  public function destroy($id){
    $idea = StoryIdea::findOrFail($id);
    $idea->delete();
    return $this->setStatusCode(200)->respond('Story idea successfully deleted!');
  }
}
