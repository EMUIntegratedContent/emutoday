<?php

namespace Emutoday\Http\Controllers\Api;

use Log;
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
      return $this->setStatusCode(200)
      ->respond('Hello API world!');
    }

    return $this->setStatusCode(401)
    ->respond('Unauthenticated usage of this route!');

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
