<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\Announcement;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Input as Input;
use Carbon\Carbon;
// use emutoday\Emutoday\Transformers\FractalAnnouncementTransformer;

// use emutoday\Emutoday\Transformers\AnnouncementTransformer;
use League\Fractal\Manager;
use League\Fractal;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

use Emutoday\Today\Transformers\FractalAnnouncementTransformerModel;
class AnnouncementController extends ApiController
{
  function __construct()
  { //
    $this->middleware('web', ['only' => [ 'queueLoad' ]]);
  }

  public function queueLoad($atype, $fromDate = null, $toDate = null)
  {
    $currentDate = Carbon::now();
    if (\Auth::check()) {

      $user = \Auth::user();
      if ($user->hasRole('contributor_1')){
          if($fromDate && !$toDate){
              $announcements = $user->announcements()->where([['start_date', '>=', $fromDate], ['is_archived', 0], ['type', $atype]])->get();
          } elseif($fromDate && $toDate){
              $announcements = $user->announcements()->where([['is_archived', 0], ['type', $atype]])->whereBetween('start_date', array($fromDate, $toDate))->get();
          } else {
              $announcements = $user->announcements()->where(['is_archived' => 0, 'type' => $atype])->get();
          }
      } else {
            if($fromDate && !$toDate){
                $announcements  = Announcement::where([['start_date', '>=', $fromDate], ['is_archived', 0], ['type', $atype]])->get();
            } elseif($fromDate && $toDate){
                $announcements  = Announcement::where([['is_archived', 0], ['type', $atype]])->whereBetween('start_date', array($fromDate, $toDate))->get();
            } else {
                $announcements  = Announcement::where(['is_archived' => 0, 'type' => $atype])->get();
            }
      }

      $fractal = new Manager();
      $resource = new Fractal\Resource\Collection($announcements->all(), new FractalAnnouncementTransformerModel);
      // Turn all of that into a Array string
      return $fractal->createData($resource)->toArray();

    } else {
      return $this->setStatusCode(501)->respondWithError('Error');
    }
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
      // return $this->setStatusCode(201)
      //             ->respondUpdated('Announcement successfully Updated!');
    }
  }

  public function store(Request $request)
  {
    if($request->get('link') != ''){
        $link_txt_rules = 'required';
    } else {
        $link_txt_rules = '';
    }

    // Validate and store announcement request submission
    $validation = \Validator::make( Input::all(), [
      // Give validator request input, and rule to check against
      'title'           => 'required|max:80|min:10',
      'start_date'      => 'required|date',
      'end_date'        => 'required|date',
      'announcement'     => 'required|max:255',
      'link_txt'        => $link_txt_rules
    ]);

    if($validation->fails() )
    { // If validation fails, send back error messages
      return $this->setStatusCode(422)
      ->respondWithError($validation->errors()->getMessages());
    }

    if($validation->passes())
    { // Okay validation passes. create the announcement
      cas()->authenticate(); //run authentication before calling cas->user

      $announcement = new Announcement;
      $announcement->submitter         	= cas()->user(); // don't work so well on production
      $announcement->title             	= $request->get('title');
      $announcement->start_date        	= Carbon::parse($request->get('start_date'));
      $announcement->end_date      	= Carbon::parse($request->get('end_date'))->endOfDay();
      $announcement->announcement     	= $request->get('announcement');

      $announcement->link               = trim($request->get('link', null));
      $announcement->link_txt           = $request->get('link_txt', null);
      $announcement->email_link         = $request->get('email_link', null);
      $announcement->email_link_txt     = $request->get('email_link_txt', null);
      $announcement->phone              = $request->get('phone', null);
      $announcement->approved_date      =  null;
      $announcement->is_promoted       	=  0;
      $announcement->type               = $request->get('type', 'general');

      $announcement->priority     	    = 0; //priority can be set in the queue after creation
      $announcement->is_archived      	= $request->get('is_archived', 0);

      // Reset Approvals
      if($request->input('admin_pre_approved')){
        $announcement->is_approved       = 1;
        $createMessage = "Announcement successfully created and approved.";
      } else {
        $createMessage = "Announcement successfully created.";
      }

      if($announcement->save())
      { // Now save to db and return success
        return $this->setStatusCode(201)
        ->respondSavedWithData($createMessage, [ 'record_id' => $announcement->id ]);
      }
    }
  }

  public function edit($id)
  {
    $fractal = new Manager();
    // $fractal->setSerializer(new ArraySerializer());
    // $fractal->setSerializer(new DataArraySerializer());
    $announcement = Announcement::findOrFail($id);

    $resource = new Fractal\Resource\Item($announcement, new FractalAnnouncementTransformerModel);
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
    $announcement = Announcement::findOrFail($id);

    if($request->get('link') != ''){
        $link_txt_rules = 'required';
    } else {
        $link_txt_rules = '';
    }

    $validation = \Validator::make( Input::all(), [
      'title'           => 'required|max:80|min:10',
      'start_date'      => 'required|date',
      'end_date'        => 'required|date',
      'announcement'     => 'required|max:255',
      'link_txt'        => $link_txt_rules,
    ]);

    if( $validation->fails() )
    {
      return $this->setStatusCode(422)
      ->respondWithError($validation->errors()->getMessages());
    }
    if($validation->passes())
    {
      $announcement->title           	= $request->get('title');
      $announcement->start_date      	= $request->get('start_date');
      $announcement->end_date      	=  \Carbon\Carbon::parse($request->get('end_date'))->endOfDay();
      $announcement->announcement     	= $request->get('announcement');
      $announcement->link              = trim($request->get('link', null));
      $announcement->link_txt          = $request->get('link_txt', null);
      $announcement->email_link              = $request->get('email_link', null);
      $announcement->email_link_txt          = $request->get('email_link_txt', null);
      $announcement->phone              = $request->get('phone', null);

      $announcement->submission_date   = $request->get('submission_date');
      $announcement->approved_date     = $request->get('approved_date', null);
      $announcement->is_promoted     	= $request->get('is_promoted', 0);

      $announcement->is_archived     	= $request->get('is_archived', 0);
      $announcement->type             = $request->get('type', 'general');

      // Reset Approvals
      if($request->input('admin_pre_approved')){
        $announcement->is_approved       = 1;
        $updateMessage = "Announcement successfully updated and approved.";
      } else {
        $announcement->is_approved       = 0; // announcements must go back into approver queue when updated
        $announcement->priority          = 0; // announcements requiring re-approval lose priority
        $updateMessage = "Announcement successfully updated.";
      }

      if($announcement->save()) {
        return $this->setStatusCode(201)
        ->respondSavedWithData($updateMessage, [ 'record_id' => $announcement->id ]);
      }
    }
  }

  /**
  * [API Call from AnnouncementItem to change some variables]
  * @param  [type]  $id      [description]
  * @param  Request $request [description]
  * @return [type]           [description]
  */
  public function archiveItem($id, Request $request)
  {
    $announcement = Announcement::findOrFail($id);
    $announcement->is_approved = $request->get('is_approved',0);
    $announcement->priority = 0; // archived items lose priority
    $announcement->is_archived = 1;
    if($announcement->save()) {
      $returnData = ['is_approved' => $announcement->is_approved,'priority'=> $announcement->priority, 'is_archived'=> $announcement->is_archived];
      return $this->setStatusCode(201)
      ->respondUpdatedWithData('announcement archived',$returnData );
    }
  }

  /**
   * Any announcement with a 'priority' > 0
   * @param string $atype    'general' or 'hr' announcement
   */
  public function getElevatedAnnouncements($atype = 'general')
  {
    $currentDate = Carbon::now();
    if (\Auth::check()) {

      $user = \Auth::user();
      if ($user->hasRole('contributor_1')){
          return $this->setStatusCode(401)->respondWithError('You do not have sufficient privileges to see elevated announcements.');
      } else {
          $announcements  = Announcement::where([['priority', '>', 0], ['type', '=', $atype]])->orderBy('priority', 'desc')->get();
      }

      $fractal = new Manager();
      $resource = new Fractal\Resource\Collection($announcements->all(), new FractalAnnouncementTransformerModel);
      // Turn all of that into a Array string
      return $fractal->createData($resource)->toArray();

    } else {
      return $this->setStatusCode(501)->respondWithError('Error');
    }
  }

  /**
   * Takes in elevated announcements and re-arranges their priority in array order.
   */
  public function reorderElevatedAnnouncements(Request $request, $atype = 'general')
  {
    $elevatedAnnouncements = $request->all();
    $elevatedAnnouncementIds = array();
    for($i = 0; $i < count($elevatedAnnouncements); $i++){
      $announcement = Announcement::findOrFail($elevatedAnnouncements[$i]['id']);

      // Set new priority.
      if($elevatedAnnouncements[$i]['priority'] == 1000000){
        $announcement->priority = 1000000; //this was checked as a special announcement
      } else {
        $announcement->priority = count($elevatedAnnouncements) - $i;
      }

      $announcement->save();
      $elevatedAnnouncementIds[] = $announcement->id; //prevent this announcement's priority from being set to 0
    }

    // Set all other announcement priorities to 0
    Announcement::where('type', $atype)->whereNotIn('id', $elevatedAnnouncementIds)->update(['priority' => 0]);

    // Get updated list of priority announcements
    $announcements  = Announcement::where([['priority', '>', 0], ['type', '=', $atype]])->orderBy('priority', 'desc')->get();
    $fractal = new Manager();
    $resource = new Fractal\Resource\Collection($announcements->all(), new FractalAnnouncementTransformerModel);
    // Turn all of that into a Array string
    return $fractal->createData($resource)->toArray();
  }

  public function delete($id)
  {
    $announcement = Announcement::findOrFail($id);
    $announcement->delete();
    return 'Announcement Deleted';
  }
}
