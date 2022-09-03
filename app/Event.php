<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Laracasts\Presenter\PresentableTrait;
use Carbon\Carbon;
use Sofa\Eloquence\Eloquence;
use DateTimeInterface;

use Emutoday\Category;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Event extends Model implements Feedable
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cea_events';

    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = ['user_id', 'title', 'short_title', 'description',
        'location', 'building', 'room',
        'start_date', 'start_time', 'end_date', 'end_time', 'all_day', 'no_end_time',
        'contact_person', 'contact_phone', 'contact_email',
        'related_link_1', 'related_link_1_txt',
        'related_link_2', 'related_link_2_txt',
        'related_link_3', 'related_link_3_txt',
        'reg_deadline', 'cost', 'free', 'participants', 'lbc_approved',
        'is_promoted', 'is_featured', 'is_approved', 'is_canceled',
        'homepage', 'submitter',
        'tickets', 'ticket_details_online', 'ticket_details_phone', 'ticket_details_office', 'ticket_details_other',
        'submission_date', 'approved_date', 'contact_fax', 'mini_calendar', 'lbc_reviewed', 'ensemble',
        'mba', 'mini_calendar_alt', 'feature_image',
        'hsc_rewards', 'hsc_reviewed',
        'on_campus', 'mediafile_id', 'building_id', 'priority', 'is_hidden'];

    /**
     * [$dates description]
     * @var [type]
     */
    protected $dates = ['start_date', 'end_date', 'submission_date', 'approved_date', 'reg_deadline', 'created_at', 'updated_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

    ];
    use PresentableTrait;

    protected $presenter = 'Emutoday\Presenters\EventPresenter';

//    use Eloquence;
//
//    protected $searchableColumns = [
//        'title', 'short_title',
//        'description', 'submitter'
//    ];

    /**
     * Custom search created by Chris Puzzuoli for EMU Today. Uses mysql FULLTEXT to match columns against the search term.
     * @param $searchTerm
     * @return mixed
     */
    public static function runSearch($searchTerm) {
        $items = DB::select(
            "
                    SELECT *
                    FROM cea_events 
                    WHERE is_approved = 1 
                      AND MATCH(title) AGAINST (:search_term)
                ",
            array(
                'search_term' => "%$searchTerm%"
            )
        );
        return self::hydrate($items); // takes the raw query and turns it into a collection of models
    }

    public function toFeedItem(): FeedItem
    {
        $author = $this->contact_person;
        $startDate = date('n/j/Y', strtotime($this->start_date));

        $authorInfo = "$author (Event Date: $startDate)";
        $urlPath = '/calendar/' . $this->start_date->format('Y') . '/' . $this->start_date->format('n') . '/' . $this->start_date->format('j') . '/' . $this->id;
        // Spatie feed absolutely refuses to show these chars properly (title only)...
        $title = str_replace(array('"', '&', "'"), array("`", 'and', "`"), $this->title);

        return FeedItem::create([
            'id' => $this->id,
            'title' => $title,
            'summary' => $this->description,
            'link' => URL::to($urlPath),
            'authorName' => $authorInfo,
            'updated' => $this->updated_at
        ]);
    }

    public function getAllFeedItems() {
        return Event::where([['is_approved', 1], ['start_date', '>=', date('Y-m-d H:i:s')]])->orderBy('start_date', 'asc')->get();
    }


    public function mediaFile()
    {
        return $this->belongsTo('Emutoday\Mediafile', 'mediafile_id');
    }

    public function minicalendars()
    {
        return $this->belongsToMany('Emutoday\MiniCalendar', 'cea_event_minicalendar', 'event_id', 'mini_calendar_id');
    }

    public function emails()
    {
        return $this->belongsToMany('Emutoday\Email', 'email_event');
    }

    /**
     * get a list of the mini calendars associated with this Event * @return [Array]
     */
    public function getMiniCalendarListAttribute()
    {
        return $this->minicalendars->lists('id')->all();
    }

    public function eventcategories()
    {
        return $this->belongsToMany('Emutoday\Category', 'cea_event_categories', 'event_id', 'category_id');
    }

    public function doNothing()
    { //
        // do nothing
    }


    /**
     * get a list of the categories associated with this Event
     * @return [Array]
     */
    public function getCategoryListAttribute()
    {
        return $this->categories->lists('id')->all();
    }

    public function getEndDateTimeAttribute()
    {
        $endtime = (is_null($this->end_time)) ? '23:59:59' : $this->end_time;
        $enddatestring = $this->end_date->toDateString() . ' ' . $endtime;
        return Carbon::parse($enddatestring);
        //    return Carbon::parse($this->end_date)->toDateString() . ' ' . $endtime;
    }

    public function getStartDateTimeAttribute()
    {
        $starttime = (is_null($this->start_time)) ? '00:00:00' : $this->start_time;
        $startdatestring = $this->start_date->toDateString() . ' ' . $starttime;
        return Carbon::parse($startdatestring);
    }

    public function getStartDateYearAttribute()
    {
        $dt = $this->start_date;
        return $dt->year;
    }

    public function getStartTimeAttribute($value)
    {
        if ($value != NULL) {
            $formatted = Carbon::parse($value)->format('g:i a');
            return str_replace(array('am', 'pm'), array('a.m.', 'p.m.'), $formatted);
        } else {
            return NULL;
        }
    }

    public function getEndTimeAttribute($value)
    {
        if ($value != NULL) {
            $formatted = Carbon::parse($value)->format('g:i a');
            return str_replace(array('am', 'pm'), array('a.m.', 'p.m.'), $formatted);
        } else {
            return NULL;
        }
    }

    public function scopeAfterThisDate($query, $date)
    {
        return $query->where('start_date', '>', $date);
    }


    /**
     * ADDED FOR LARAVEL 7 TO KEEP EXISTING DATETIME FORMAT
     * https://laravel.com/docs/7.x/upgrade#date-serialization
     * Prepare a date for array / JSON serialization.
     *
     * @param \DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
