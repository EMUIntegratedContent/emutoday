<?php

namespace Emutoday\Http\Controllers\Api;


use Emutoday\Announcement;
use Emutoday\Event;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Input as Input;
use Carbon\Carbon;
use League\Fractal\Manager;
use League\Fractal;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\DataArraySerializer;

use Emutoday\Today\Transformers\FractalAnnouncementTransformerModel;
class ExternalApiController extends ApiController
{
  function __construct()
  {
    $this->middleware('cors');
  }

  public function getEvents(){
    return response()->json([
        'name' => 'Abigail',
        'state' => 'CA'
    ]);
  }
}
