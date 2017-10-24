<?php

namespace Emutoday\Http\Controllers\Api;

use Log;
use Emutoday\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as Input;
use Carbon\Carbon;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

class MailgunApiController extends ApiController
{
  function __construct()
  {
  }

  public function postClick(Request $request){
    Log::info('MAILGUN CLICK REGISTERED. Info below:');
    Log::info($request->all());
    $mailgun_post_data = $request->all();

    // Secure the Webhook endpoint (Note: API key comes from .env file)
    if($this->verify(env('MAILGUN_SECRET'), $mailgun_post_data['token'], $mailgun_post_data['timestamp'], $mailgun_post_data['signature'])){
      if(!$this->incrementOpen()){
        return $this->setStatusCode(400)
        ->respond('Email not found.');
      }
      return $this->setStatusCode(200)
      ->respond('Email open counted.');
    }
    return $this->setStatusCode(401)
    ->respond('Unauthenticated usage of this route!');
  }

  /**
   * Increase the number of times this email has been opened by incrementing the mailgun_opens field
   * @param int $email_id   The EMU Today database ID of the email
   *
   * @return boolean
   */
  private function incrementOpen($email_id){
    $email = Email::find($email_id);

    if($email){
      $email->mailgun_opens += 1;
      if($email->save()){
        return true;
      }
    }
    return false;
  }
  /**
   * To ensure the authenticity of event requests, Mailgun signs them and posts the signature along with other webhook parameters:
   * DOCS: https://documentation.mailgun.com/en/latest/user_manual.html#webhooks
   * @param String token      "token" property sent in mailgun POST request
   * @param String timestamp  "timestamp" property sent in mailgun POST request
   * @param String signature  "signature" property sent in mailgun POST request
   *
   * @return boolean
   */
  private function verify($apiKey, $token, $timestamp, $signature){
    //check if the timestamp is fresh
    if (abs(time() - $timestamp) > 15) {
        return false;
    }

    //returns true if signature is valid
    return hash_hmac('sha256', $timestamp.$token, $apiKey) === $signature;
  }
}
