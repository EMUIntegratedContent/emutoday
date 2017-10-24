<?php

namespace Emutoday\Http\Controllers\Api;

use Log;
use Emutoday\Announcement;
use Emutoday\Event;
use Emutoday\Story;
use Emutoday\MiniCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as Input;
use Carbon\Carbon;
use League\Fractal\Manager;
use League\Fractal;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

use Emutoday\Today\Transformers\FractalAnnouncementTransformerModel;
class MailgunApiController extends ApiController
{
  function __construct()
  {
    $this->middleware('cors');
  }

  public function postClick(Request $request){
    Log::info('MAILGUN WUZ HERE');
    
    return $this->setStatusCode(200)
    ->respondUpdatedWithData('Hello API world!',[]);
  }
}
