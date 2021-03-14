<?php

namespace Emutoday\Http\Controllers\Today;

use Emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Emutoday\Expert;
use Emutoday\ExpertMediaRequest;
use Illuminate\Http\Request;

use Carbon\Carbon;
use JavaScript;


class ExpertMediaRequestController extends Controller
{
  protected $expertMediaRequest; // Disabled because I wanted to use POST request

  public function __construct(ExpertMediaRequest $expertMediaRequest)
  {
    $this->expertMediaRequest = $expertMediaRequest;
  }

  /**
   * Index page of experts system. Visible to public.
   */
  public function index($expertId = null)
  {
      $experts = Expert::orderBy('last_name')->where('is_media_expert', 1)->get();
      return view('public.expertrequest.mediarequest', compact('experts', 'expertId'));
  }
 }
