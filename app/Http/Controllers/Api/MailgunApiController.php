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
    $this->middleware('cors');
  }

  public function postClick(Request $request){
    //Log::info('MAILGUN WUZ HERE');

    return $this->setStatusCode(200)
    ->respondUpdatedWithData('Hello API world!',[]);
  }
}
