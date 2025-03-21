<?php

namespace Emutoday\Today\Transformers;

use Emutoday\Event;
use League\Fractal;
use Carbon\Carbon;

class FractalEventTransformerModelFull extends Fractal\TransformerAbstract{
	public function transform(Event $event){
		$user_id = null;

		if($event->user_id != null){
			$user_id = $event->user_id;
		}

		$start_time = $event->start_time ? $event->start_time->format('H:i:s') : '00:00:00';
		$end_time = $event->end_time ? $event->end_time->format('H:i:s') : '00:00:00';

		$start_date_time = $event->start_date->toDateString() . ' ' . $start_time;
		$end_date_time = $event->end_date->toDateString() . ' ' . $end_time;

		return [
			'id' => (int)$event->id,
			'user_id' => $user_id,
			'title' => $event->title,
			'short_title' => $event->short_title,
			'description' => $event->description,
			'location' => $event->location,
			'building' => $event->building,
			'room' => $event->room,
			'start_date' => $event->start_date->toDateString(),
			'start_time' => $event->start_time->format('g:i A'),
			'start_date_time' => $start_date_time,
			'end_date' => $event->end_date->toDateString(),
			'end_time' => $event->end_time->format('g:i A'),
			'end_date_time' => $end_date_time,
			'all_day' => $event->all_day,
			'no_end_time' => $event->no_end_time,
			'contact_person' => $event->contact_person,
			'contact_phone' => $event->contact_phone,
			'contact_email' => $event->contact_email,
			'related_link_1' => $event->related_link_1,
			'related_link_1_txt' => $event->related_link_1_txt,
			'related_link_2' => $event->related_link_2,
			'related_link_2_txt' => $event->related_link_2_txt,
			'related_link_3' => $event->related_link_3,
			'related_link_3_txt' => $event->related_link_3_txt,
			'reg_deadline' => is_null($event->reg_deadline) ? null : $event->reg_deadline->toDateString(),
			// 'reg_deadline'           => $event->reg_deadline,
			'cost' => $event->cost,
			'free' => $event->free,
			'participants' => $event->participants,
			'lbc_approved' => $event->lbc_approved,
			'is_promoted' => $event->is_promoted,
			'is_featured' => $event->is_featured,
			'is_approved' => $event->is_approved,
			'is_canceled' => $event->is_canceled,
			'is_hidden' => $event->is_hidden,
			'homepage' => $event->homepage,
			'submitter' => $event->submitter,
			'tickets' => $event->tickets,
			'ticket_details_online' => $event->ticket_details_online,
			'ticket_details_phone' => $event->ticket_details_phone,
			'ticket_details_office' => $event->ticket_details_office,
			'ticket_details_other' => $event->ticket_details_other,
			'submission_date' => is_null($event->submission_date) ? null : $event->submission_date->toDateString(),
			'approved_date' => is_null($event->approved_date) ? null : $event->approved_date->toDateString(),

			'hsc_reviewed' => $event->hsc_reviewed,
			'hsc_rewards' => $event->hsc_rewards,

			'contact_fax' => $event->contact_fax,
			'mini_calendar' => $event->mini_calendar,
			'lbc_reviewed' => $event->lbc_reviewed,
			'ensemble' => $event->ensemble,
			'mba' => $event->mba,
			'mini_calendar_alt' => $event->mini_calendar_alt,
			'eventimage' => ($event->mediafile_id > 0) ? $event->mediaFile->filename : null,
			'caption' => ($event->mediafile_id > 0) ? $event->mediaFile->caption : null,
			'alt_text' => ($event->mediafile_id > 0) ? str_replace('"', "", $event->mediaFile->alt_text) : null,

			'feature_image' => $event->feature_image,
			'on_campus' => $event->on_campus,
			'mediafile_id' => $event->mediafile_id,
			'building_id' => $event->building_id,
			'priority' => $event->priority,
			'home_priority' => $event->home_priority,
			'minicalendars' => $event->minicalendars()->select('calendar', 'id as value')->get(),
			'eventcategories' => $event->eventcategories()->select('category', 'id as value')->get(),
			'full_url' => url('/').'/calendar/'.$event->start_date->format('Y').'/'.$event->start_date->format('m').'/'.$event->start_date->format('d').'/'.$event->id,
			'is_archived' => $event->is_archived,
		];
	}
}
