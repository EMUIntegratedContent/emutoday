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
    //$this->middleware('auth:api');
  }

  public function postClick(Request $request){
    //Log::info('MAILGUN WUZ HERE');
    $mailgun_post_data = $request->all();

    /**
     * Secure the Webhook endpoint
     * TUTORIAL: https://documentation.mailgun.com/en/latest/user_manual.html#webhooks
     * Note: API key comes from .env file
     **/
    if($this->verify(env('MAILGUN_SECRET'), $mailgun_post_data['token'], $mailgun_post_data['timestamp'], $mailgun_post_data['signature'])){
      return $this->setStatusCode(200)
      ->respond('Hello API world!');
    }

    return $this->setStatusCode(401)
    ->respond('Unauthenticated usage of this route!');

  }

  private function verify($apiKey, $token, $timestamp, $signature){
    //check if the timestamp is fresh
    if (abs(time() - $timestamp) > 15) {
        return false;
    }

    //returns true if signature is valid
    return hash_hmac('sha256', $timestamp.$token, $apiKey) === $signature;
  }
}
