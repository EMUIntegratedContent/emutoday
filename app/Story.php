<?php

namespace Emutoday;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Laracasts\Presenter\PresentableTrait;
use DateTimeInterface;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Illuminate\Support\Facades\DB;

class Story extends Model implements Feedable
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
     protected $table = 'storys';


     protected $fillable = [
         'user_id', 'title',
         'slug','subtitle',
         'teaser','content',
         'external_link',
         'start_date','end_date',
         'is_featured','is_ready',
         'is_approved', 'is_live' ,
         'story_type',
         'author_id', 'author_info',
         'priority', 'contact_id',
		 		 'clicks'
     ];
     protected $dates = ['start_date', 'end_date'];

    /**
     * Vendor Package
     */
    use PresentableTrait;
    protected $presenter = 'Emutoday\Presenters\StoryPresenter';

    /**
     * Custom search created by Chris Puzzuoli for EMU Today. Uses mysql FULLTEXT to match columns against the search term.
     * @param $searchTerm
     * @return mixed
     */
    public static function runSearchNonMagazine($searchTerm) {
        $items = DB::select(
            "
                    SELECT title, subtitle, story_type, teaser, id, start_date, MATCH(title, subtitle, teaser, content) AGAINST (:search_term WITH QUERY EXPANSION) AS score
                    FROM storys 
                    WHERE is_approved = 1 
                      AND start_date <= :start_date
                      AND story_type NOT IN ('article', 'external')
                      AND MATCH(title, subtitle, teaser, content) AGAINST (:search_term2 WITH QUERY EXPANSION)
                    ORDER BY score DESC, start_date DESC
                ",
            array(
                'search_term' => "%$searchTerm%",
                'start_date' => date('Y-m-d'),
                'search_term2' => "%$searchTerm%"
            )
        );
        return self::hydrate($items); // takes the raw query and turns it into a collection of models
    }

    /**
     * Custom search created by Chris Puzzuoli for EMU Today. Uses mysql FULLTEXT to match columns against the search term.
     * @param $searchTerm
     * @return mixed
     */
    public static function runSearchMagazine($searchTerm) {
        $items = DB::select(
            "
                    SELECT title, subtitle, story_type, teaser, id, start_date
                    FROM storys 
                    WHERE is_approved = 1 
                      AND start_date <= :start_date
                      AND story_type IN ('article')
                      AND MATCH(title, subtitle, teaser, content) AGAINST (:search_term)
                    ORDER BY start_date DESC
                ",
            array(
                'start_date' => date('Y-m-d'),
                'search_term' => "%$searchTerm%"
            )
        );
        return self::hydrate($items); // takes the raw query and turns it into a collection of models
    }

    public function toFeedItem(): FeedItem
    {
        // set story info
        if(!$this->author) {
            $author = '';
        } else {
            $author = $this->author['first_name'].' '.$this->author['last_name'];
        }

        $daysAgo = Carbon::parse($this->start_date)->diffInDays();
        $authorInfo = "$author ($daysAgo days ago)";
        // Spatie feed absolutely refuses to show these chars properly (title only)...
        $title = str_replace(array('"', '&', "'"), array("`", 'and', "`"), $this->title);

        return FeedItem::create([
            'id' => $this->id,
            'title' => $title,
            'summary' => $this->content,
            'link' => URL::to('/story/'.$this->story_type.'/'.$this->id),
            'authorName' => $authorInfo,
            'updated' => $this->updated_at
        ]);
    }

    public function getAllFeedItems() {
        return Story::where([['is_approved', 1], ['is_archived', 0]])->whereIn('story_type', ['news', 'advisory', 'statement', 'story', 'article'])->orderBy('created_at', 'desc')->get();
    }

    /**
    *
    *   RELATIONSHIPS
    ***/

    /**
     * [author description]
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * [author description]
     * @return [type] [description]
     */
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    /**
     * [author description]
     * @return [type] [description]
     */
    public function contact()
    {
        return $this->belongsTo(Author::class, 'contact_id');
    }

    /**
     * [storyImages description]
     * @return [type] [description]
     */
    public function storyImages()
    {
        return $this->hasMany(StoryImage::class);
    }

    public function images()
    {
        return $this->hasMany('Emutoday\StoryImage');
    }
    /**
     * Inverse Many-to-Many relationship for page layouts
     * @return [type] [description]
     */
    public function pages()
    {
        return $this->belongsToMany('Emutoday\Page');
    }

/*
    public function emails()
    {
        return $this->belongsToMany('Emutoday\Email');
    }
*/
    public function magazines()
    {
      return $this->belongsToMany('Emutoday\Magazine');
    }
    /**
     * [storyTypes description]
     * @return [type] [description]
     */
    public function storyType()
    {
        return $this->belongsTo('Emutoday\StoryType', 'story_type', 'shortname');
    }

    public function storyGroup()
    {
        return $this->belongsTo('Emutoday\StoryType', 'story_type', 'shortname');
    }


    /**
     * [tags description]
     * @return [type] [description]
     */
    public function tags()
    {
        return $this->belongsToMany('Emutoday\Tag', 'story_tag', 'story_id','tag_id')->withTimestamps();
    }



    public function addImage($stype)
        {
            return $this->storyImages()->create([
                'image_name'=> 'img' . $this->id . '_'. $stype,
                'image_type'=> 'image'.$stype,
            ]);
        }



        /**
         * [grabStoryImageByType description]
         * @param  [type] $value [description]
         * @return [type]        [description]
         */
        public function grabStoryImageByType($value)
        {
            return $storyImage = $this->storyImages()->where('image_type', $value)->first();
        }



        /**
         * get a list of the tags associated with this Story
         * @return [Array]
         */
        public function getTagListAttribute()
        {
          return $this->tags->lists('id')->all();
        }

        public function getPrettyStartDateAttribute()
        {
          return $this->start_date->toDateString();
        }
        public function getPrettyEndDateAttribute()
        {
          return $this->end_date->toDateString();
        }

        public function getStoryFolderAttribute()
        {

          switch ($this->story_type) {
              case 'news':
                $type = 'news';
                break;
              case 'story':
                $type = 'story';
                break;
              case 'student':
                $type = 'student';
                break;
              case 'magazine':
                $type = 'magazine';
                break;
              case 'external':
                $type = 'external';
                break;
              case 'bulletin':
                $type = 'bulletin';
                break;
              case 'featurephoto':
                $type = 'featurephoto';
                break;
              default:
                $type = $this->story_type;
              }

              return $type;

        }

        /* External stories have links to the story in the external_small image type */
        public function getExternalLink(){
          if($this->story_type == 'external' || $this->story_type == 'article'){
            $imgType = $this->grabStoryImageByType('small');

            return $imgType->link;
          }

          return;
        }



        /** ************* ACCESSORS ************** */

        /**
         * [setPublishedAtAttribute description]
         * @param [type] $value [description]
         */
        public function setStartDateAttribute($value)
        {
            $this->attributes['start_date'] = $value ?: null;
        }
        /** ************* QUERY SCOPES ************** */
        /**
         * Scope a query by story_type
         *
         * @return \Illuminate\Database\Eloquent\Builder
         */
        public function scopeOfType($query, $type)
        {
            return $query->where('story_type', $type);
        }

        public function scopeOfStoryType($query, $group)
        {
                return $query->storyType->where('group', $group);
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
