<?php

namespace Emutoday\Today\Transformers;

use Emutoday\Email;
use Emutoday\Story;
use League\Fractal;
use Carbon\Carbon;

use League\Fractal\Manager;
use Emutoday\Today\Transformers\FractalStoryTransformerModel;

class FractalEmailTransformerModel extends Fractal\TransformerAbstract
{
    public function transform(Email $email)
    {
        // Other stories and main stories need to be packaged as a fractal to access the 'group' field
        $otherStories = $email->stories()->orderBy('email_story.order', 'asc')->get();
        $fractal = new Manager();
        $resource = new Fractal\Resource\Collection($otherStories->all(), new FractalStoryTransformerModel);
        $otherStories = $fractal->createData($resource)->toArray();

        $mainStories = $email->mainstories()->orderBy('email_mainstory.order', 'asc')->get();
        $fractal = new Manager();
        $resource = new Fractal\Resource\Collection($mainStories->all(), new FractalStoryTransformerModel);
        $mainStories = $fractal->createData($resource)->toArray();
        $sendAt = null;
        if($email->send_at){
          $sendAt = $email->send_at->toDateTimeString();
        }

        return [
            'id'      => (int) $email->id,
            'title'    =>  $email->title,
            'subheading' => $email->subheading,
            'is_approved' => $email->is_approved,
            'is_ready' => $email->is_ready,
            'mainStories' => $mainStories['data'],
            'announcements' => $email->announcements()->orderBy('email_announcement.order', 'asc')->get(),
            'events' => $email->events()->orderBy('email_event.order', 'asc')->get(),
            'otherStories' => $otherStories['data'],
            'send_at' => $sendAt,
            'recipients' => $email->recipients()->get(),
            'is_sent' => $email->is_sent,
            'mailgun_opens' => $email->mailgun_opens,
            'mailgun_clicks' => $email->mailgun_clicks,
            'mailgun_spam' => $email->mailgun_spam,
            'clone' => $email->clonedEmail()->select('id', 'title')->get(),
            'created_at' => $email->created_at->format('n/j/y @ g:i A'),
            'is_president_included' => $email->is_president_included,
            'president_teaser' => $email->president_teaser,
            'president_url' => $email->president_url,
						'exclude_events' => $email->exclude_events,
            'is_emu175_included' => $email->is_emu175_included,
            'emu175_teaser' => $email->emu175_teaser,
            'emu175_url' => $email->emu175_url,
        ];
    }
}
