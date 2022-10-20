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
                    SELECT title, announcement, submitter, id
                    FROM announcements 
                    WHERE is_approved = 1 
                      AND MATCH(title, announcement) AGAINST (:search_term)
                    ORDER BY start_date DESC
                ",
            array(
                'search_term' => "%$searchTerm%"
            )
        );
        return self::hydrate($items); // takes the raw query and turns it into a collection of models
    }

    public function toFeedItem(): FeedItem
    {
        $txt = $this->announcement;
        if($this->link) {
            $txt .= "<br><br>";
            $txt .= 'Link: <a href="'. $this->link . '">'. $this->link_txt .'</a>';
        }
        if($this->email_link) {
            $txt .= "<br><br>";
            $txt .= 'Email: <a href="mailto:'. $this->email_link . '">'. $this->email_link_txt .'</a>';
        }
        if($this->phone) {
            $txt .= "<br><br>";
            $txt .= 'Phone: ' . $this->phone;
        }

        // Put the num of days ago along with the author.
        $daysAgo = $this->created_at->diffInDays();
        $author = $this->email_link_txt ?: 'unknown';
        $authorInfo = "$author ($daysAgo days ago)";
        // Spatie feed absolutely refuses to show these chars properly (title only)...
        $title = str_replace(array('"', '&', "'"), array("`", 'and', "`"), $this->title);

        return FeedItem::create([
            'id' => $this->id,
            'title' => $title,
            'summary' => $txt,
            'link' => URL::to('/announcement'),
            'authorName' => $authorInfo,
            'updated' => $this->updated_at
        ]);
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
