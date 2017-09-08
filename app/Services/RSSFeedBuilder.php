<?php

namespace Emutoday\Services;

use Illuminate\Support\Facades\App;
use Emutoday\Story;

class RSSFeedBuilder
{
    private $config;

    public function __construct()
    {
        $this->config = config()->get('feed');
    }

    public function render($type)
    {
        $feed = App::make("feed");
        if ($this->config['use_cache']) {
            $feed->setCache($this->config['cache_duration'], $this->config['cache_key']);
        }

        if (!$feed->isCached()) {
            $storys = $this->getFeedData();
            $feed->title = $this->config['feed_title'];
            $feed->description = $this->config['feed_description'];
            $feed->logo = $this->config['feed_logo'];
            $feed->link = url('feed');
            $feed->setDateFormat('datetime');
            $feed->lang = 'en';
            $feed->setShortening(true);
            $feed->setTextLimit(250);

            if (!empty($storys)) {
                $feed->pubdate = $storys[0]->created_at;
                foreach ($storys as $story) {
                    $link = route('/', ["id" => $story->id]);

                    // set story info
                    $feed->add($story->title, $story->start_date, $story->created_at, $story->updated_at, $story->is_approved);
                }
            }
        }

        return $feed->render($type);
    }

    /**
     * Creating rss feed with our most recent posts.
     * The size of the feed is defined in feed.php config.
     *
     * @return mixed
     */
    private function getFeedData()
    {
        $maxSize = $this->config['max_size'];
        $storys = Story::paginate($maxSize);
        return $storys;
    }
}
