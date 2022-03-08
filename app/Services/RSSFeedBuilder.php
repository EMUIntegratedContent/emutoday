<?php

namespace Emutoday\Services;

use Illuminate\Support\Facades\App;
use Emutoday\Story;
use Emutoday\Event;
use Emutoday\Announcement;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class RSSFeedBuilder{
	private $config;

	public function __construct(){
		$this->config = config()->get('feed');
	}

	public function render($format, $type = 'news'){
		$feed = App::make("feed");
		if($this->config['use_cache']){
			$feed->setCache($this->config['cache_duration'], $this->config['cache_key']);
		}

		if($type == 'events'){
			if(!$feed->isCached()){
				$events = $this->getEventsData();
				$feed->title = "EMU Today - Events";
				$feed->description = "A listing of events from EMU Today";
				$feed->logo = null;
				$feed->link = url('feed');
				$feed->setDateFormat('datetime');
				$feed->lang = 'en';
				$feed->setShortening(true);
				$feed->setTextLimit(140);

				if(!empty($events)){
					$feed->pubdate = $events[0]->created_at;
					foreach($events as $event){
						$urlPath = '/calendar/'.$event->start_date->format('Y').'/'.$event->start_date->format('n').'/'.$event->start_date->format('j').'/'.$event->id;
						// set event info
						$feed->add($event->title, $event->contact_person, URL::to($urlPath), $event->start_date, $event->location, $event->description);
					}
				}
			}
		} else if ($type == 'announcements') {
			if(!$feed->isCached()){
				$announcements = $this->getAnnouncementsData();
				$feed->title = "EMU Today - Announcements";
				$feed->description = "A listing of announcements from EMU Today";
				$feed->logo = null;
				$feed->link = url('feed');
				$feed->setDateFormat('Y-m-D');
				$feed->lang = 'en';
				$feed->setShortening(true);
				$feed->setTextLimit(140);

				if(!empty($announcements)){
					$feed->pubdate = $announcements[0]->created_at;
					foreach($announcements as $announcement){
						$txt = $announcement->announcement;
						if($announcement->link) {
							$txt .= "<br><br>";
							$txt .= 'Link: <a href="'. $announcement->link . '">'. $announcement->link_txt .'</a>';
						}
						if($announcement->email_link) {
							$txt .= "<br><br>";
							$txt .= 'Email: <a href="mailto:'. $announcement->email_link . '">'. $announcement->email_link_txt .'</a>';
						}
						if($announcement->phone) {
							$txt .= "<br><br>";
							$txt .= 'Phone: ' . $announcement->phone;
						}
						// set announcement info
						$feed->add($announcement->title, $announcement->email_link_txt, '', $announcement->start_date, $announcement->announcement, $txt);
					}
				}
			}
		} else {
			if(!$feed->isCached()){
				$storys = $this->getNewsData();
				$feed->title = $this->config['feed_title'];
				$feed->description = $this->config['feed_description'];
				$feed->logo = $this->config['feed_logo'];
				$feed->link = url('feed');
				$feed->setDateFormat('datetime');
				$feed->lang = 'en';
				$feed->setShortening(true);
				$feed->setTextLimit(140);

				if(!empty($storys)){
					$feed->pubdate = $storys[0]->created_at;
					foreach($storys as $story){
						// set story info
						$feed->add($story->title, $story->author['first_name'].' '.$story->author['last_name'], URL::to('/story/'.$story->story_type.'/'.$story->id), $story->created_at, $story->teaser, $story->content);
					}
				}
			}
		}


		return $feed->render($format);
	}

	/**
	 * Creating rss feed with our most recent news.
	 * The size of the feed is defined in feed.php config.
	 *
	 * @return mixed
	 */
	private function getNewsData(){
		$maxSize = $this->config['max_size'];
		$storys = Story::where([['is_approved', 1], ['is_archived', 0]])->whereIn('story_type', ['news', 'advisory', 'statement'])->orderBy('created_at', 'desc')->paginate($maxSize);
		return $storys;
	}

	/**
	 * Creating rss feed with our most recent announcements.
	 * The size of the feed is defined in feed.php config.
	 *
	 * @return mixed
	 */
	private function getAnnouncementsData(){
		$maxSize = $this->config['max_size'];
		$now = date('Y-m-d H:i:s');
		$announcements = Announcement::where([
			['is_approved', 1],
			['is_archived', 0],
			['start_date', '<=', $now],
			['end_date', '>=', $now]
		])->whereIn('type', ['general'])->orderBy('created_at', 'desc')->paginate($maxSize);
		return $announcements;
	}

}
