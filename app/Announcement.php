<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Sofa\Eloquence\Eloquence;

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

    use Eloquence;
    protected $searchableColumns = ['title', 'announcement', 'submitter'];

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
}
