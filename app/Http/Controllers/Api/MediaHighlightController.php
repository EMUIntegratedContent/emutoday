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
      $highlight->url      	    = $request->get('url');
      $highlight->source      	= $request->get('source');
      $highlight->start_date    = $request->get('start_date');
      $highlight->added_by      = $user_id;

      if($highlight->save()) {
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
    $author = Author::findOrFail($id);

    $validation = \Validator::make( Input::all(), [
      'first_name'          => 'required|max:80|min:2',
      'last_name'           => 'required|max:80|min:2',
      'email'               => 'required',
    ]);

    if( $validation->fails() )
    {
      return $this->setStatusCode(422)
      ->respondWithError($validation->errors()->getMessages());
    }
    if($validation->passes())
    {
      $author->first_name           = $request->get('first_name');
      $author->last_name      	    = $request->get('last_name');
      $author->email      	        = $request->get('email');
      $author->phone     	        = $request->get('phone');
      $author->user_id              = $request->get('user_id', null);

      //If this author is set as the PRIMARY STORY contact, set all other authors' is_principal_contact fields to 0 and mark this author as a contact automatically
      if($request->get('is_principal_contact') == 1){
          $author->is_principal_contact = 1;
          $author->is_contact = 1;
          Author::where('id', '!=', $author->id)->update(['is_principal_contact'=> 0]);
      } else {
        $author->is_principal_contact = 0;
        if($request->get('is_contact') == 1){
            $author->is_contact = 1;
        } else {
            $author->is_contact = 0;
        }
      }

      //If this author is set as the PRIMARY MAGAZINE contact, set all other authors' is_principal_magazine_contact fields to 0 and mark this author as a contact automatically
      if($request->get('is_principal_magazine_contact') == 1){
          $author->is_principal_magazine_contact = 1;
          $author->is_contact = 1;
          Author::where('id', '!=', $author->id)->update(['is_principal_magazine_contact'=> 0]);
      } else {
        $author->is_principal_magazine_contact = 0;
        if($request->get('is_contact') == 1){
            $author->is_contact = 1;
        } else {
            $author->is_contact = 0;
        }
      }

      if($author->save()) {
        return $this->setStatusCode(201)
        ->respondSavedWithData('Author successfully Updated!',[ 'record_id' => $author->id ]);
      }
    }
  }

  public function getTaglist(){
    $tags = MediaHighlightTag::orderBy('name', 'asc')->get();

    return $this->setStatusCode(201)
    ->respondUpdatedWithData('All media highlight tags.', $tags);
  }

  /**
   * Save a previously-unlisted tag.
   */
  public function storeTag(Request $request){
    $validation = \Validator::make( Input::all(), [
        'name'   => 'required|unique:media_highlight_tags,name' ]);

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

  /**
   *  Get the one user in the authors table set as the PRINCIPAL STORY contact
   */
  public function getCurrentPrimaryContact(){
    $author = Author::select(\DB::raw('CONCAT(first_Name, " ", last_Name) AS name'))->where('is_principal_contact', 1)->first();

    if($author){
      $primaryContact = $author;
    } else {
      $primaryContact = null;
    }
    return $this->setStatusCode(201)
    ->respondUpdatedWithData('Primary Contact', $primaryContact );
  }

  /**
   *  Get the one user in the authors table set as the PRINCIPAL MAGAZINE contact
   */
  public function getCurrentPrimaryMagazineContact(){
    $author = Author::select(\DB::raw('CONCAT(first_Name, " ", last_Name) AS name'))->where('is_principal_magazine_contact', 1)->first();

    if($author){
      $primaryContact = $author;
    } else {
      $primaryContact = null;
    }
    return $this->setStatusCode(201)
    ->respondUpdatedWithData('Primary Magazine Contact', $primaryContact );
  }

  /**
   *  Get the one user in the authors table set as the PRINCIPAL MAGAZINE contact
   */
  public function getUsers($selectedUser = null){
    $users = User::leftJoin('authors', 'users.id', '=', 'authors.user_id')->select('users.id', 'users.first_name', 'users.last_name')->whereNull('authors.user_id')->orWhere('authors.user_id', $selectedUser)->orderby('last_name')->get();

    return $this->setStatusCode(201)
    ->respondUpdatedWithData($selectedUser, $users);
  }

  /**
   * Get the author tied to the corresponding user id
   */
  public function getAuthorByUser($userId){
      $author = Author::select('id', 'last_name', 'first_name', 'email', 'phone')->where('user_id', $userId)->first();

      return $this->setStatusCode(201)
      ->respondUpdatedWithData('Author conntected to user', $author);
  }

}
