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

  //We're making rss default type
  public function getNews($type = "rss")
  {
      if ($type === "rss" || $type === "atom") {
          return $this->builder->render($type, 'news');
      }

      //If invalid feed requested, redirect home
      return redirect()->home();
  }

  //We're making rss default type
  public function getEvents($type = "rss")
  {
      if ($type === "rss" || $type === "atom") {
          return $this->builder->render($type, 'events');
      }

      //If invalid feed requested, redirect home
      return redirect()->home();
  }

  public function getEventsICal(){
    $events = Event::where([['is_approved', 1], ['start_date', '>=', date('Y-m-d H:i:s')]])->orderBy('start_date', 'asc')->paginate(30);
    // the iCal date format. Note the Z on the end indicates a UTC timestamp.
    define('DATE_ICAL', 'Ymd\THis\Z');

    $output =
"BEGIN:VCALENDAR\r\nMETHOD:PUBLISH\r\nVERSION:2.0\r\nPRODID:-//Eastern Michigan University//EMU Today Events//EN\r\n";

    // loop over events
    foreach ($events as $event):
      $status = "CONFIRMED";
      if($event->is_canceled){
        $status = "CANCELED";
      }

     $output .=
"BEGIN:VEVENT
SUMMARY:$event->title
UID:$event->id
STATUS:$status
DTSTART:" . date(DATE_ICAL, strtotime($event->start_date)) . "
DTEND:" . date(DATE_ICAL, strtotime($event->end_date)) . "
DTSTAMP:" . date(DATE_ICAL, strtotime($event->created_at)) . "
LAST-MODIFIED:" . date(DATE_ICAL, strtotime($event->updated_at)) . "
ORGANIZER:" . date(DATE_ICAL, strtotime($event->contact_person)) . "
LOCATION:$event->location
END:VEVENT\n";
    endforeach;

    // close calendar
    $output .=
"END:VCALENDAR\n";

    return $output;
  }
}
