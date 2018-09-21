<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\MediaHighlight;
use Emutoday\MediaHighlightTag;
use Emutoday\User;
use Auth;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Input as Input;
use Carbon\Carbon;

use League\Fractal\Manager;
use League\Fractal;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

use Emutoday\Today\Transformers\FractalMediaHighlightTransformerModel;
class MediaHighlightController extends ApiController
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
    $highlight = new MediaHighlight;
    $validation = \Validator::make( Input::all(), [
      'title'          => 'required|max:100',
      'url'            => 'required',
      'source'         => 'required',
      'start_date'     => 'required|date_format:Y-m-d'
    ]);

    if( $validation->fails() )
    {
      return $this->setStatusCode(422)
      ->respondWithError($validation->errors()->getMessages());
    }
    if($validation->passes())
    {
      $user_id = Auth::user()->id;
      $highlight->title         = $request->get('title');
      $highlight->url      	    = trim($request->get('url'));
      $highlight->source      	= $request->get('source');
      $highlight->start_date    = $request->get('start_date');
      $highlight->added_by      = $user_id;

      if($highlight->save()) {
        // Sync tags
        $tagIds = array();
        foreach($request->get('tags') as $tag){
          $tagIds[] = $tag['id'];
        }
        $highlight->tags()->sync($tagIds);

        return $this->setStatusCode(201)
        ->respondSavedWithData('Highlight successfully saved!',[ 'record_id' => $highlight->id ]);
      }
    }
  }

  public function edit($id)
  {
    $fractal = new Manager();
    $highlight = MediaHighlight::findOrFail($id);

    $resource = new Fractal\Resource\Item($highlight, new FractalMediaHighlightTransformerModel);
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
    $highlight = MediaHighlight::findOrFail($id);
    $validation = \Validator::make( Input::all(), [
      'title'          => 'required|max:100',
      'url'            => 'required',
      'source'         => 'required',
      'start_date'     => 'required|date_format:Y-m-d'
    ]);

    if( $validation->fails() )
    {
      return $this->setStatusCode(422)
      ->respondWithError($validation->errors()->getMessages());
    }
    if($validation->passes())
    {
      $highlight->title         = $request->get('title');
      $highlight->url      	    = trim($request->get('url'));
      $highlight->source      	= $request->get('source');
      $highlight->start_date    = $request->get('start_date');

      if($highlight->save()) {
        // Sync tags
        $tagIds = array();
        foreach($request->get('tags') as $tag){
          $tagIds[] = $tag['id'];
        }
        $highlight->tags()->sync($tagIds);

        if($highlight->save()) {
          return $this->setStatusCode(201)
          ->respondSavedWithData('Media highlight successfully Updated!',[ 'record_id' => $highlight->id ]);
        }
      }
    }
  }

  /**
   * Get all tags in the database or, if id is passed, tags that match the highlight id
   */
  public function getTaglist($id = null){
    if($id){
      $tags = MediaHighlight::find($id)->tags;
      $message = "Tags for this record.";
    } else {
      $tags = MediaHighlightTag::orderBy('name', 'asc')->get();
      $message = "All media highlight tags.";
    }


    return $this->setStatusCode(201)
    ->respondUpdatedWithData($message, $tags);
  }

  /**
   * Save a previously-unlisted tag.
   */
  public function storeTag(Request $request){
    $messages = array(
      'name.required' => 'Please specify a tag name.',
      'name.unique' => 'That tag already exists.',
    );
    $validation = \Validator::make( Input::all(), [
        'name'   => 'required|unique:media_highlight_tags,name' ], $messages);

    if( $validation->fails() ){
        return $this->setStatusCode(422)
                    ->respondWithError($validation->errors()->getMessages());
    }

    if($validation->passes()){
        $tag          = new MediaHighlightTag;
        $tag->name    = $request->get('name');

        if($tag->save()) {
            return $this->setStatusCode(201)
            ->respondSavedWithData('Tag has been created.', ['tag' => $tag] );
        }
    }
  }

  public function destroy($id)
  {
    $highlight = MediaHighlight::findOrFail($id);
    $highlight->delete();
    return $this->setStatusCode(200)->respond('Media highlight successfully deleted!');
  }
}
