<?php

namespace Emutoday\Http\Controllers\Today;

use Emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Emutoday\Story;
use Emutoday\Event;
use Emutoday\Services\RSSFeedBuilder;
use Illuminate\Http\Request;



class RSSFeedController extends Controller {
  private $builder;

  public function __construct(RSSFeedBuilder $builder)
  {
      $this->builder = $builder;
  }

  //We're making atom default type
  public function getNews($type = "atom")
  {
      if ($type === "rss" || $type === "atom") {
          return $this->builder->render($type);
      }

      //If invalid feed requested, redirect home
      return redirect()->home();
  }
}
