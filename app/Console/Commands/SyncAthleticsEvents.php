<?php

namespace Emutoday\Console\Commands;

use Carbon\Carbon;
use Emutoday\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncAthleticsEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cea_events:sync_athletics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import and sync EMU Athletics events from the Sidearm Sports RSS feed.';

    /**
     * Sidearm calendar RSS feed.
     */
    const FEED_URL = 'https://admin.emueagles.com/services/calendar_type.ashx?type=rss';

    /**
     * Mini calendar that imported athletics events are attached to.
     */
    const ATHLETICS_MINICAL_ID = 117;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $xmlString = $this->fetchFeed();
        if ($xmlString === false) {
            Log::error('SyncAthleticsEvents: could not fetch RSS feed.');
            $this->error('Could not fetch RSS feed.');
            return 1;
        }

        $xml = simplexml_load_string($xmlString);
        if ($xml === false) {
            Log::error('SyncAthleticsEvents: could not parse RSS feed XML.');
            $this->error('Could not parse RSS feed XML.');
            return 1;
        }

        $created = 0;
        $updated = 0;
        $rssPermalinks = [];

        foreach ($xml->channel->item as $item) {
            $sdNs = $item->children('http://sidearmsports.com/schemas/cal_rss/1.0/');
            $evNs = $item->children('http://purl.org/rss/1.0/modules/event/');

            $permalink = trim((string) $item->guid);
            if ($permalink === '') {
                continue;
            }
            $rssPermalinks[] = $permalink;

            $localStart = (string) $sdNs->localstartdate;
            $localEnd   = (string) $sdNs->localenddate;

            list($startDate, $startTime) = $this->splitLocalDateTime($localStart);
            list($endDate, $endTime)     = $this->splitLocalDateTime($localEnd);

            $rawDescription = (string) $item->description;
            $links = $this->extractStreamingLinks($rawDescription);

            $event = Event::firstOrNew(['sidearm_permalink' => $permalink]);
            if (! $event->exists) {
                $event->submission_date = Carbon::today();
                $event->submitter = 'athletics_sync';
                $created++;
            } else {
                $updated++;
            }

            $event->title       = $this->cleanTitle((string) $item->title);
            $event->location    = (string) $evNs->location;
            $event->description = $this->cleanDescription($rawDescription);

            $event->start_date = $startDate;
            $event->end_date   = $endDate ?: $startDate;

            if ($startTime) {
                $event->all_day    = 0;
                $event->start_time = $startTime;
                $event->end_time   = $endTime ?: $startTime;
            } else {
                // Time is TBA (feed sent a date-only localstartdate). Treat as all-day.
                $event->all_day    = 1;
                $event->start_time = '00:00:00';
                $event->end_time   = '23:59:59';
            }

            $event->related_link_1     = (string) $item->link;
            $event->related_link_1_txt = 'EMU Athletics';

            $event->related_link_2     = $links['video'];
            $event->related_link_2_txt = $links['video'] ? 'ESPN+ Streaming Video' : null;

            $event->related_link_3     = $links['audio'];
            $event->related_link_3_txt = $links['audio'] ? 'Streaming Audio' : null;

            $event->contact_person = 'EMU Athletics';
            $event->contact_email  = 'athletic_marketing@emich.edu';
            $event->contact_phone  = '';

            $event->cost        = '0';
            $event->free        = 1;
            $event->is_approved = 1;
            $event->is_canceled = 0;

            $event->save();
            $event->minicalendars()->syncWithoutDetaching([self::ATHLETICS_MINICAL_ID]);
        }

        $canceled = $this->cancelStaleEvents($rssPermalinks);

        $summary = "SyncAthleticsEvents complete. Created: {$created}, Updated: {$updated}, Canceled: {$canceled}.";
        Log::info($summary);
        $this->info($summary);

        return 0;
    }

    /**
     * Fetch the raw RSS feed body.
     *
     * @return string|false
     */
    protected function fetchFeed()
    {
        $context = stream_context_create([
            'http' => [
                'timeout' => 30,
                'user_agent' => 'EMUToday-AthleticsSync/1.0',
            ],
            'https' => [
                'timeout' => 30,
                'user_agent' => 'EMUToday-AthleticsSync/1.0',
            ],
        ]);

        return @file_get_contents(self::FEED_URL, false, $context);
    }

    /**
     * Split a Sidearm local datetime (e.g. "2026-04-28T08:00:00.0000000") into
     * a [Y-m-d, H:i:s] pair.
     *
     * @param  string  $value
     * @return array
     */
    protected function splitLocalDateTime($value)
    {
        $value = trim($value);
        if ($value === '') {
            return [null, null];
        }

        // Some feed entries are date-only (time TBA), e.g. "2026-11-20".
        if (strpos($value, 'T') === false) {
            return [$value, null];
        }

        list($datePart, $timePart) = explode('T', $value, 2);
        $timePart = substr($timePart, 0, 8); // strip fractional seconds / Z

        return [$datePart, $timePart];
    }

    /**
     * Strip the date/time/status prefix from a feed title.
     * Titles look like "4/28 8:00 AM [N] EMU Women's Golf at MAC Championships".
     * Take from the first "EMU" to the end; fall back to the full title.
     *
     * @param  string  $title
     * @return string
     */
    protected function cleanTitle($title)
    {
        $title = trim($title);
        $pos = stripos($title, 'EMU');

        return $pos !== false ? trim(substr($title, $pos)) : $title;
    }

    /**
     * Sidearm descriptions use literal "\n" (backslash-n text), not real newlines.
     * Drop the TV/Streaming/Tickets marker lines and re-join with real newlines.
     *
     * @param  string  $raw
     * @return string
     */
    protected function cleanDescription($raw)
    {
        $lines = explode('\n', $raw);
        $kept = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }
            if ($this->isMarkerLine($line)) {
                continue;
            }
            $kept[] = $line;
        }

        return implode("\n", $kept);
    }

    /**
     * Pull the Streaming Video / Streaming Audio URLs out of the raw description.
     *
     * @param  string  $raw
     * @return array  ['video' => ?string, 'audio' => ?string]
     */
    protected function extractStreamingLinks($raw)
    {
        $lines = explode('\n', $raw);
        $video = null;
        $audio = null;

        foreach ($lines as $line) {
            $line = trim($line);
            if (stripos($line, 'Streaming Video:') === 0) {
                $url = trim(substr($line, strlen('Streaming Video:')));
                $video = $url !== '' ? $url : null;
            } elseif (stripos($line, 'Streaming Audio:') === 0) {
                $url = trim(substr($line, strlen('Streaming Audio:')));
                $audio = $url !== '' ? $url : null;
            }
        }

        return ['video' => $video, 'audio' => $audio];
    }

    /**
     * Marker lines that should not appear in the stored description.
     *
     * @param  string  $line
     * @return bool
     */
    protected function isMarkerLine($line)
    {
        $markers = ['TV:', 'Streaming Video:', 'Streaming Audio:', 'Tickets:'];

        foreach ($markers as $marker) {
            if (stripos($line, $marker) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Cancel athletics events that have dropped out of the feed, but only within
     * the feed window (it starts ~30 days before today). Older events that have
     * simply aged off the feed must not be canceled.
     *
     * @param  array  $rssPermalinks
     * @return int
     */
    protected function cancelStaleEvents(array $rssPermalinks)
    {
        $windowStart = Carbon::today()->subDays(30)->toDateString();

        $query = Event::whereNotNull('sidearm_permalink')
            ->where('start_date', '>=', $windowStart)
            ->where('is_canceled', 0);

        if (! empty($rssPermalinks)) {
            $query->whereNotIn('sidearm_permalink', $rssPermalinks);
        }

        return $query->update(['is_canceled' => 1, 'is_archived' => 1, 'is_hidden' => 1]);
    }
}
