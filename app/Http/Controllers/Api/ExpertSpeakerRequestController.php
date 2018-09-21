<?php

namespace Emutoday\Http\Controllers\Api;

use Emutoday\ExpertSpeakerRequest;
use Emutoday\Expert;
use Emutoday\User;
use Illuminate\Http\Request;
use Snowfire\Beautymail\Beautymail;


use Illuminate\Support\Facades\Input as Input;
use Carbon\Carbon;

use League\Fractal\Manager;
use League\Fractal;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

use Emutoday\Today\Transformers\FractalExpertRequestTransformerModel;

class ExpertSpeakerRequestController extends ApiController
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
        'expert_id'                 => 'required',
        'organization'              => 'required|max:70|min:2',
        'contact_name'              => 'required|max:100|min:2',
        'contact_phone'             => 'required',
        'contact_email'             => 'required|email',
        'time_needed'               => 'required|date',
        'length_of_presentation'    => 'required',
        'topic'                     => 'required'
    ]);

    // Honeypot is a method to catch bots filling out forms.
    if( $validation->fails() || ($request->get('honeypot') != ''))
    {
      return $this->setStatusCode(422)
      ->respondWithError($validation->errors()->getMessages());
    }

    if($validation->passes())
    {
        $speakerDate = \DateTime::createFromFormat('Y-m-d h:i A', $request->get('time_needed'));

        $expertSpeakerRequest = new ExpertSpeakerRequest;

        $expertSpeakerRequest->expert_id                = $request->get('expert_id');
        $expertSpeakerRequest->organization             = $request->get('organization');
        $expertSpeakerRequest->org_description          = $request->get('org_description', null);
        $expertSpeakerRequest->org_website     	        = $request->get('org_website', null);
        $expertSpeakerRequest->contact_name             = $request->get('contact_name');
        $expertSpeakerRequest->contact_phone            = $request->get('contact_phone');
        $expertSpeakerRequest->contact_email            = $request->get('contact_email');
        $expertSpeakerRequest->time_needed              = $speakerDate->format('Y-m-d H:i:s');
        $expertSpeakerRequest->length_of_presentation   = $request->get('length_of_presentation');
        $expertSpeakerRequest->location                 = $request->get('location');
        $expertSpeakerRequest->event_description        = $request->get('event_description', null);
        $expertSpeakerRequest->topic                    = $request->get('topic');

        // Don't need to save the request...you can if you want, but there's no backend to manage them
        //if($expertSpeakerRequest->save()) {
            // Send an email to the expert
            $beautymail = app()->make(Beautymail::class);
            $beautymail->send('public.expertrequest.speakeremail.requesttoexpert', ['invitation' => $expertSpeakerRequest], function($message) use($expertSpeakerRequest)
            {
                $message
        			->from('noreply@today.emich.edu')
        			//->to('cpuzzuol@emich.edu', 'Chris Puzzuoli')
                    ->to($expertSpeakerRequest->expert->email, $expertSpeakerRequest->expert->first_name . ' ' . $expertSpeakerRequest->expert->last_name)
        			->subject('You have been requested for a speaking engagement through EMU Today.');
            });

            // Send an email to the requestee
            $beautymail = app()->make(Beautymail::class);
            $beautymail->send('public.expertrequest.speakeremail.requestreceipt', ['invitation' => $expertSpeakerRequest], function($message) use($expertSpeakerRequest)
            {
                $message
        			->from('noreply@today.emich.edu')
        			//->to('cpuzzuol@emich.edu', 'Chris Puzzuoli')
                    ->to($expertSpeakerRequest->contact_email, $expertSpeakerRequest->contact_name )
        			->subject('Your request for an Eastern Expert.');
            });

          return $this->setStatusCode(201)
          ->respondSavedWithData('Expert speaker request successfully submitted. The expert has been notified and you should receive a confirmation copy of this request soon.',[ 'record_id' => $expertSpeakerRequest->id ]);
        //}
    }
  }
}
