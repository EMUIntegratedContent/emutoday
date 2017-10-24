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

    if($this->verify){
      return $this->setStatusCode(200)
      ->respond('Hello API world!');
    }

    return $this->setStatusCode(401)
    ->respond('Unauthenticated usage of this route!');

  }

  protected function verify($api_key, $token, $timestamp, $signature){
    return false;
  }
}
