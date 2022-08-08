<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Sofa\Eloquence\Eloquence;
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
