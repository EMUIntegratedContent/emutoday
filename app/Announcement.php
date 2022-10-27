<?php

namespace Emutoday;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Laracasts\Presenter\PresentableTrait;
use DateTimeInterface;

class Announcement extends Model
{

    protected $fillable = [
        'user_id',
        'submitter',
        'title',
        'announcement',
        'start_date',
        'end_date',
        'link_txt',
        'link',
        'is_promoted',
        'is_approved',
        'link_txt',
        'link',
        'email_link_txt',
        'email_link',
        'phone'
    ];
    protected $dates = [
        'end_date', 'start_date',
        'submission_date', 'approved_date'
    ];

    use PresentableTrait;
    protected $presenter = 'Emutoday\Presenters\AnnouncementPresenter';

//    use Eloquence;
//    protected $searchableColumns = ['title', 'announcement', 'submitter'];

    /**
     * Custom search created by Chris Puzzuoli for EMU Today. Uses mysql FULLTEXT to match columns against the search term.
     * @param $searchTerm
     * @return mixed
     */
    public static function runSearch($searchTerm) {
        $items = DB::select(
            "
                    SELECT title, announcement, submitter, id, MATCH(title, announcement) AGAINST (:search_term) AS search_score
                    FROM announcements
                    WHERE is_approved = 1
                        AND is_archived = 0
                        AND MATCH(title, announcement) AGAINST (:search_term2)
                    HAVING search_score >= 3
                    ORDER BY start_date DESC, search_score DESC
                ",
            array(
                'search_term' => "%$searchTerm%",
                'search_term2' => "%$searchTerm%"
            )
        );
        return self::hydrate($items); // takes the raw query and turns it into a collection of models
    }

    public function user()
    {
        return $this->belongsTo('Emutoday\User');
    }

    public function announcementType()
    {
        return $this->belongsTo('Emutoday\AnnouncementType', 'shortname', 'type');
    }

    public function emails()
    {
        return $this->belongsToMany('Emutoday\Email', 'email_announcement');
    }

    /**
     * ADDED FOR LARAVEL 7+ TO KEEP EXISTING DATETIME FORMAT
     * https://laravel.com/docs/7.x/upgrade#date-serialization
     * Prepare a date for array / JSON serialization.
     *
     * @param DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
