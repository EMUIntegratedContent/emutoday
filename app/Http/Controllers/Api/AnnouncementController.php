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
    {

        $this->middleware('web', ['only' => [
           'queueLoad'
        ]]);

    }
    public function queueLoad($atype)
    {
        $currentDate = Carbon::now();
        if (\Auth::check()) {
            $user = \Auth::user();

            if ($user->hasRole('contributor_1')){
                // dd($user->id);
                $announcements = $user->announcements()->where('type',$atype)->get();
            } else {
                // $announcements = Announcement::where('end_date', '>=', $currentDate)->get();

                $announcements = Announcement::where([
                    ['end_date', '>', $currentDate->subDay(2)],
                    ['type', $atype]
                    ])->get();
                    // Announcement::all();
                }
                $fractal = new Manager();
                // $storys = Story::all();
                $resource = new Fractal\Resource\Collection($announcements->all(), new FractalAnnouncementTransformerModel);
                // Turn all of that into a Array string
                return $fractal->createData($resource)->toArray();
            } else {
                return $this->setStatusCode(501)->respondWithError('Error');

            }


        }
        // public function queueLoadhr()
        // {
        //     $currentDate = Carbon::now();
        //     $announcements = Announcement::where([
        //         ['end_date', '>', $currentDate->subDay(2)],
        //         ['type', 'hr']
        //         ])->get();
        //         // Announcement::all();
        //     }
        //     $fractal = new Manager();
        //     // $storys = Story::all();
        //     $resource = new Fractal\Resource\Collection($announcements->all(), new FractalAnnouncementTransformerModel);
        //     // Turn all of that into a Array string
        //     return $fractal->createData($resource)->toArray();
        //
        //
        //
        //     }

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

        $validation = \Validator::make( Input::all(), [
                    'title'           => 'required|max:80',
                    'start_date'      => 'required|date',
                    'end_date'        => 'required|date',
                    'announcement'     => 'required|max:255'
            ]);

         if( $validation->fails() )
         {
             return $this->setStatusCode(422)
                                     ->respondWithError($validation->errors()->getMessages());
         }
         if($validation->passes())
        {
            $announcement = new Announcement;
            $announcement->user_id       	= $request->get('user_id', 0);
            $announcement->submitter       	= cas()->getCurrentUser();
            $announcement->title           	= $request->get('title');
            $announcement->start_date      	= \Carbon\Carbon::parse($request->get('start_date'));
            $announcement->end_date      		= \Carbon\Carbon::parse($request->get('end_date'))->endOfDay();
            $announcement->announcement     	= $request->get('announcement');
            $announcement->submission_date 				= \Carbon\Carbon::now();

            $announcement->link              = $request->get('link', null);
            $announcement->link_txt          = $request->get('link_txt', null);
            $announcement->email_link              = $request->get('email_link', null);
            $announcement->email_link_txt          = $request->get('email_link_txt', null);
            $announcement->is_approved      	= $request->get('is_approved', 0);
            $announcement->approved_date     =  null;
            $announcement->is_promoted     	=  0;
            $announcement->type             = $request->get('type', 'general');

            $announcement->priority     	    = $request->get('priority', 0);
            $announcement->is_archived     	= $request->get('is_archived', 0);



            if($announcement->save()) {

                    return $this->setStatusCode(201)
                    ->respondSavedWithData('Announcement successfully created!',[ 'record_id' => $announcement->id ]);

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

        $validation = \Validator::make( Input::all(), [
                    'title'           => 'required|max:50',
                    'start_date'      => 'required|date',
                    'end_date'        => 'required|date',
                    'announcement'     => 'required|max:255'
            ]);

            if( $validation->fails() )
            {
                return $this->setStatusCode(422)
                                        ->respondWithError($validation->errors()->getMessages());
            }
            if($validation->passes())
           {

               $announcement->user_id       	= $request->get('user_id');
               $announcement->title           	= $request->get('title');
               $announcement->start_date      	= $request->get('start_date');
               $announcement->end_date      	=  \Carbon\Carbon::parse($request->get('end_date'))->endOfDay();
               $announcement->announcement     	= $request->get('announcement');
               $announcement->link              = $request->get('link', null);
               $announcement->link_txt          = $request->get('link_txt', null);
               $announcement->email_link              = $request->get('email_link', null);
               $announcement->email_link_txt          = $request->get('email_link_txt', null);

               $announcement->submission_date   = $request->get('submission_date');
               $announcement->is_approved      	= $request->get('is_approved', 0);
               $announcement->approved_date     = $request->get('approved_date', null);
               $announcement->is_promoted     	= $request->get('is_promoted', 0);

               $announcement->priority     	    = $request->get('priority', 0);
               $announcement->is_archived     	= $request->get('is_archived', 0);
               $announcement->type             = $request->get('type', 'general');




               if($announcement->save()) {
                    return $this->setStatusCode(201)
                    ->respondSavedWithData('Announcement successfully Updated!',[ 'record_id' => $announcement->id ]);
                        // ->respondUpdated('Announcement Successfully Updated!');
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
              $announcement->priority = $request->get('priority', 0);
              $announcement->is_archived = 1;
              if($announcement->save()) {
                  $returnData = ['is_approved' => $announcement->is_approved,'priority'=> $announcement->priority, 'is_archived'=> $announcement->is_archived];
                  return $this->setStatusCode(201)
                  ->respondUpdatedWithData('announcement archived',$returnData );
                      // return $this->setStatusCode(201)
                      //             ->respondUpdated('Announcement successfully Updated!');
                              }
          }

}
