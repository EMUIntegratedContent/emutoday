<?php

namespace Emutoday\Http\Controllers\Today;

use Emutoday\Announcement;
use Emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Emutoday\Story;
use Emutoday\Event;
use Illuminate\Http\Request;


class RSSFeedController extends Controller
{

    public function __construct()
    {

    }

    public function getNews()
    {
        $items = Story::where([['is_approved', 1], ['is_archived', 0]])
            ->whereIn('story_type', ['news', 'advisory', 'statement', 'story', 'article'])
            ->orderBy('created_at', 'desc')->get();
        return response()->view('public.rss.news', [
            'items' => $items,
        ])->header('Content-Type', 'text/xml');
    }

    public function getEvents()
    {
        $items = Event::where([['is_approved', 1], ['start_date', '>=', date('Y-m-d H:i:s')]])
            ->orderBy('start_date', 'asc')->get();
        return response()->view('public.rss.events', [
            'items' => $items,
        ])->header('Content-Type', 'text/xml');
    }

    public function getAnnouncements()
    {
        $now = date('Y-m-d H:i:s');
        $items = Announcement::where([
            ['is_approved', 1],
            ['is_archived', 0],
            ['start_date', '<=', $now],
            ['end_date', '>=', $now]
        ])->whereIn('type', ['general'])->orderBy('created_at', 'desc')->get();
        return response()->view('public.rss.announcements', [
            'items' => $items,
        ])->header('Content-Type', 'text/xml');
    }

    public function getEventsICal()
    {
        // Get all future events and past events of two months ago or less
        $events = Event::where([['is_approved', 1], ['start_date', '>=', date('Y-m-d', strtotime(date("Y-m-d", strtotime("-2 months"))))]])->orderBy('start_date', 'asc')->get();
        // the iCal date format. Note the Z on the end indicates a UTC timestamp.
        define('DATE_ICAL', 'Ymd\THis');

        $output =
            "BEGIN:VCALENDAR\r\nMETHOD:PUBLISH\r\nVERSION:2.0\r\nPRODID:-//Eastern Michigan University//EMU Today Events//EN\r\n";

        // loop over events
        foreach ($events as $event):
            $status = "CONFIRMED";
            if ($event->is_canceled) {
                $status = "CANCELLED";
            }

            // Descriptions can't be sent with special characters or else it'll mess up the iCal feed
            // Tutorial: https://stackoverflow.com/questions/30220243/php-creating-ics-file-hidden-characters-and-line-breaks-breaking-output
            $description = str_replace("\xA0", " ", $event->description); //nbsp - make space
            $description = str_replace("\x0A", "", $description); //cr - remove
            $desc_html = str_replace("\x0D", "<br>", $description);//lf - html break
            $description = str_replace("\x0D", "\\n", $description);//lf - text: escaped new line
            $description = strip_tags(htmlspecialchars_decode($description));//clear html for plain text version

            $start_date = date('Y-m-d', strtotime($event->start_date)) . date('H:i:s', strtotime($event->start_time));
            $end_date = date('Y-m-d', strtotime($event->end_date)) . date('H:i:s', strtotime($event->end_time));

            $output .=
                "BEGIN:VEVENT\r\nSUMMARY:$event->title\r\nUID:$event->id\r\nSTATUS:$status\r\nDTSTART:" . date(DATE_ICAL, strtotime($start_date)) . "\r\nDTEND:" . date(DATE_ICAL, strtotime($end_date)) . "\r\nDTSTAMP:" . date(DATE_ICAL, strtotime($event->created_at)) . "\r\nLAST-MODIFIED:"
                . date(DATE_ICAL, strtotime($event->updated_at)) . "\r\nORGANIZER:" . $event->contact_person . "\r\nLOCATION:$event->location\r\nDESCRIPTION:$description\r\nEND:VEVENT\r\n";
        endforeach;

        // close calendar
        $output .=
            "END:VCALENDAR\r\n";

        return $output;
    }
}
