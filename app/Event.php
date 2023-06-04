<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Laracasts\Presenter\PresentableTrait;
use Carbon\Carbon;
use DateTimeInterface;

use Emutoday\Category;

class Event extends Model
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
			'start_date' => 'datetime',
			'end_date' => 'datetime',
			'submission_date' => 'datetime',
			'approved_date' => 'datetime',
			'reg_deadline' => 'datetime',
			'start_time' => 'datetime',
			'end_time' => 'datetime',
			'created_at' => 'datetime',
			'updated_at' => 'datetime'
    ];

    use PresentableTrait;

    protected $presenter = 'Emutoday\Presenters\EventPresenter';

    /**
     * Custom search created by Chris Puzzuoli for EMU Today. Uses mysql FULLTEXT to match columns against the search term.
     * Note that the composite field 'search_score' is required for proper sorting of search results!
     * @param $searchTerm
     * @return mixed
     */
    public static function runSearch($searchTerm) {
        $items = DB::select(
            "
                    SELECT id, title, description, start_date, 
                        SUM(
                            (MATCH(title) AGAINST (:search_term))*2 +
                            (MATCH(description) AGAINST (:search_term2))*2
                        ) AS search_score
                        FROM cea_events
                        WHERE is_approved = 1   
                            AND is_archived = 0
                            AND (
                                MATCH(title) AGAINST (:search_term3)
                                OR MATCH(description) AGAINST (:search_term4)
                            )
                        GROUP BY id
                        HAVING search_score >= 3
                        ORDER BY search_score DESC
                ",
            array(
                'search_term' => "%$searchTerm%",
                'search_term2' => "%$searchTerm%",
                'search_term3' => "%$searchTerm%",
                'search_term4' => "%$searchTerm%"
            )
        );
        return self::hydrate($items); // takes the raw query and turns it into a collection of models
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
