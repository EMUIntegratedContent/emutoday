<?php

namespace Emutoday\Today\Transformers;

use Emutoday\Announcement;
use League\Fractal;
use Carbon\Carbon;

class FractalAnnouncementTransformerModel extends Fractal\TransformerAbstract
{
    public function transform(Announcement $announcement)
    {
        return [
            'id'      => (int) $announcement->id,
            'title'    =>  $announcement->title,
            'announcement' => $announcement->announcement,
            'submission_date' => $announcement->submission_date ? $announcement->submission_date->toDateString(): $announcement->created_at->toDateString(),
            'is_approved' => $announcement->is_approved,
            'approved_date' => $announcement->approved_date ? $announcement->approved_date->toDateString() : null,
            'is_promoted' => $announcement->is_promoted,
            'priority' =>  $announcement->priority,
            'start_date'   => $announcement->start_date->toDateTimeString(),
            'end_date'   => $announcement->end_date ? $announcement->end_date->toDateTimeString() : $announcement->start_date->addDays(1)->toDateString(),
            'link'      => $announcement->link,
            'link_txt' => $announcement->link_txt,
            'email_link'      => $announcement->email_link,
            'email_link_txt' => $announcement->email_link_txt,
            'is_archived' => $announcement->is_archived,
            'user_id'  => $announcement->user_id,
            'user_name'  => $announcement->user->full_name,
            'user_phone'  => $announcement->user->phone,
            'user_email'  => $announcement->user->email

        ];
    }
}
