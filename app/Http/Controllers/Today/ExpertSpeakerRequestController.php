<?php

namespace Emutoday\Http\Controllers\Today;

use Emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Emutoday\Expert;
use Emutoday\ExpertSpeakerRequest;
use Illuminate\Http\Request;

use Carbon\Carbon;
use JavaScript;


class ExpertSpeakerRequestController extends Controller
{
  protected $expertSpeakerRequest; // Disabled because I wanted to use POST request

  public function __construct(ExpertSpeakerRequest $expertSpeakerRequest)
  {
    $this->expertSpeakerRequest = $expertSpeakerRequest;
  }

  /**
   * Index page of experts system. Visible to public.
   */
  public function index($expertId = null)
  {

      $experts = Expert::orderBy('last_name')->where('is_community_speaker', 1)->get();
      return view('public.expertrequest.speakerrequest', compact('experts', 'expertId'));
  }
 }
