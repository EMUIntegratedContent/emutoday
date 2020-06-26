<?php

namespace Emutoday\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Foundation\Bus\DispatchesJobs;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


abstract class Controller extends BaseController
{
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
  {
    $this->middleware('auth');
  }
}
