# Athletics RSS Sync — Implementation Plan

## Context
EMU Today needs to periodically import athletic events from the EMU Athletics Sidearm Sports RSS feed (`https://admin.emueagles.com/services/calendar_type.ashx?type=rss`) and keep them in sync. Events can be created, updated, or removed on the Sidearm side and must be reflected in `cea_events`.

The project already has a CampusLife external sync pattern using `external_record_id`. We'll follow that same approach but with a dedicated `sidearm_permalink` column (since that field is integer-based for CampusLife and the athletics key is a URL string).

## Decisions
- **Auto-approve**: `is_approved = 1` on create and update
- **Removed events**: `is_canceled = 1` (but only for events within the RSS window — see below)
- **Mini-calendar**: ID 117
- **RSS window**: feed starts ~30 days before today; events older than that window must NOT be canceled just because they've aged off the feed

## Files to Create/Modify

### 1. Migration — add `sidearm_permalink` to `cea_events`
New file: `database/migrations/[timestamp]_add_sidearm_permalink_to_cea_events.php`

```php
Schema::table('cea_events', function (Blueprint $table) {
    $table->string('sidearm_permalink', 500)->nullable()->after('external_record_id');
});
```

### 2. Event model — `app/Event.php`
Add `sidearm_permalink` to `$fillable` array.

### 3. Artisan command — `app/Console/Commands/SyncAthleticsEvents.php`
Signature: `cea_events:sync_athletics`

**handle() logic:**

```
1. Fetch RSS XML from Sidearm URL via file_get_contents / Http facade
2. Parse XML, register sidearm 's' and 'ev' namespaces
   NOTE: <description> uses LITERAL "\n" (backslash-n text), not real newlines.
   Split/regex on the literal "\n" string when parsing markers and links.
3. Build $rssPermalinks = [] of all guid values from RSS
4. For each RSS item:
   a. Extract fields:
      - sidearm_permalink  ← <guid>
      - title              ← <title>, prefix stripped: take from first "EMU" to end
                             (drops the "4/28 8:00 AM [N] " date/time/status prefix).
                             If no "EMU" present, fall back to the full title.
      - location           ← <ev:location>
      - description        ← <description>, CLEANED: convert literal "\n" to real
                             newlines and strip the "TV:", "Streaming Video:",
                             "Streaming Audio:", "Tickets:" lines (those move to links)
      - start_date         ← date part of <s:localstartdate>
      - start_time         ← time part of <s:localstartdate>
      - end_date           ← date part of <s:localenddate>
      - end_time           ← time part of <s:localenddate>
      - related_link_1     ← <link> (back to emueagles.com)
      - related_link_1_txt ← "EMU Athletics"
      - related_link_2     ← URL following "Streaming Video:" marker in <description> (often ESPN+)
      - related_link_2_txt ← "ESPN+ Streaming Video" (only if related_link_2 found)
      - related_link_3     ← URL following "Streaming Audio:" marker in <description>
      - related_link_3_txt ← "Streaming Audio" (only if related_link_3 found)
   b. updateOrCreate(['sidearm_permalink' => $permalink], [all fields above plus:
      - contact_person  = "EMU Athletics"
      - contact_email   = "athletics@emich.edu"
      - contact_phone   = ""
      - cost            = "0"
      - free            = 1
      - is_approved     = 1
      - is_canceled     = 0  ← un-cancel if it reappears in feed
      - submitter       = "athletics_sync"
      - submission_date = today (only on create, via firstOrCreate semantics)
   ])
5. Cancel logic — only touch events within the RSS window:
   $rssWindowStart = Carbon::today()->subDays(30)
   Event::whereNotNull('sidearm_permalink')
        ->where('start_date', '>=', $rssWindowStart)
        ->whereNotIn('sidearm_permalink', $rssPermalinks)
        ->update(['is_canceled' => 1])
6. Log::info() with counts: created, updated, canceled
```

### 4. Console Kernel — `app/Console/Kernel.php`
- Add `Commands\SyncAthleticsEvents::class` to `$commands` array
- Add to schedule: `$schedule->command(Commands\SyncAthleticsEvents::class)->cron('0 */6 * * *');`
  (runs every 6 hours)

### 5. Mini-calendar attachment
After `updateOrCreate`, attach mini-calendar 117:
```php
$event->minicalendars()->syncWithoutDetaching([117]);
```
Use `syncWithoutDetaching` so manually-added mini-cals on the event aren't wiped.

## Field Mapping Reference (RSS → cea_events)
| RSS field | DB column | Notes |
|---|---|---|
| `<guid>` | `sidearm_permalink` | Unique key, full URL |
| `<title>` | `title` | Remove prefix (always take from first instance of "EMU" to the end of the title) |
| `<ev:location>` | `location` | |
| `<s:localstartdate>` | `start_date` + `start_time` | Local ET, split on T |
| `<s:localenddate>` | `end_date` + `end_time` | Local ET, split on T |
| `<description>` | `description` | Cleaned: literal `\n`→newlines, strip TV/Streaming/Tickets lines |
| `<description>` | `related_link_2` | URL following `Streaming Video:` marker (NOT "ESPN+ Streaming Video:") |
| - | `related_link_2_txt` | Hardcoded "ESPN+ Streaming Video" (only if link found) |
| `<description>` | `related_link_3` | URL following `Streaming Audio:` marker |
| - | `related_link_3_txt` | Hardcoded "Streaming Audio" (only if link found) |
| `<link>` | `related_link_1` | Link back to athletics page |
| — | `related_link_1_txt` | Hardcoded "EMU Athletics" |

## Verification
1. Run migration in container: `php artisan migrate`
2. Run command manually: `php artisan cea_events:sync_athletics`
3. Check logs: `storage/logs/laravel.log` for counts
4. Confirm events appear in admin queue at `/admin/event/queue`
5. Verify mini-calendar 117 is attached to imported events
6. Test cancel logic: temporarily remove a `sidearm_permalink` from a future event in DB and re-run — confirm it gets `is_canceled=1`
