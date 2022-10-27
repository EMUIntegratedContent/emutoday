<?php

namespace Emutoday;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Laracasts\Presenter\PresentableTrait;
use DateTimeInterface;
use Illuminate\Support\Facades\DB;

class Story extends Model
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
     * Note that the composite field 'search_score' is required for proper sorting of search results!
     * @param $searchTerm
     * @return mixed
     */
    public static function runSearchNonMagazine($searchTerm) {
        $items = DB::select(
            "
                SELECT DISTINCT s.id, s.title, s.subtitle, s.story_type, s.teaser, s.start_date,
                    SUM(
                        (MATCH(s.title) AGAINST (:search_term))*2 +
                        (MATCH(s.content) AGAINST (:search_term2))*1.5 +
                        (MATCH(s.subtitle, s.teaser) AGAINST (:search_term3))*1 +
                        (si.score_imgs)*1.5
                    ) AS search_score
                FROM storys s
                LEFT JOIN (
                    SELECT DISTINCT si.story_id, score_imgs
                    FROM story_images si
                    JOIN (
                        SELECT story_id, MAX(MATCH(title, caption, teaser, moretext) AGAINST (:search_term4)) AS score_imgs
                        FROM story_images
                        WHERE MATCH(title, caption, teaser, moretext) AGAINST (:search_term5)
                        GROUP BY story_id
                    ) si2 ON si2.story_id = si.story_id
                    WHERE MATCH(title, caption, teaser, moretext) AGAINST (:search_term6)
                    GROUP BY si.story_id
                ) si ON si.story_id = s.id
                WHERE s.is_approved = 1
                    AND s.is_archived = 0
                    AND s.start_date <= :start_date
                    AND s.story_type NOT IN ('article', 'external')
                    AND (MATCH(s.title, s.subtitle, s.teaser, s.content) AGAINST (:search_term7) OR score_imgs IS NOT NULL)
                GROUP BY s.id
                HAVING search_score >= 3
                ORDER BY search_score DESC;
                ",
            array(
                'search_term' => "%$searchTerm%",
                'search_term2' => "%$searchTerm%",
                'search_term3' => "%$searchTerm%",
                'start_date' => date('Y-m-d'),
                'search_term4' => "%$searchTerm%",
                'search_term5' => "%$searchTerm%",
                'search_term6' => "%$searchTerm%",
                'search_term7' => "%$searchTerm%"
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
                    SELECT DISTINCT s.id, s.title, s.subtitle, s.story_type, s.teaser, s.start_date,
                        SUM(
                            (MATCH(s.title) AGAINST (:search_term))*2 +
                            (MATCH(s.content) AGAINST (:search_term2))*1.5 +
                            (MATCH(s.subtitle, s.teaser) AGAINST (:search_term3))*1 +
                            (si.score_imgs)*1.5
                        ) AS search_score
                    FROM storys s
                    LEFT JOIN (
                        SELECT DISTINCT si.story_id, score_imgs
                        FROM story_images si
                        JOIN (
                            SELECT story_id, MAX(MATCH(title, caption, teaser, moretext) AGAINST (:search_term4)) AS score_imgs
                            FROM story_images
                            WHERE MATCH(title, caption, teaser, moretext) AGAINST (:search_term5)
                            GROUP BY story_id
                        ) si2 ON si2.story_id = si.story_id
                        WHERE MATCH(title, caption, teaser, moretext) AGAINST (:search_term6)
                        GROUP BY si.story_id
                    ) si ON si.story_id = s.id
                    WHERE s.is_approved = 1
                        AND s.start_date <= :start_date
                        AND s.story_type IN ('article')
                        AND (MATCH(s.title, s.subtitle, s.teaser, s.content) AGAINST (:search_term7) OR score_imgs IS NOT NULL)
                    GROUP BY s.id
                    HAVING search_score > 3
                    ORDER BY search_score DESC;
                ",
            array(
                'search_term' => "%$searchTerm%",
                'search_term2' => "%$searchTerm%",
                'search_term3' => "%$searchTerm%",
                'start_date' => date('Y-m-d'),
                'search_term4' => "%$searchTerm%",
                'search_term5' => "%$searchTerm%",
                'search_term6' => "%$searchTerm%",
                'search_term7' => "%$searchTerm%"
            )
        );
        return self::hydrate($items); // takes the raw query and turns it into a collection of models
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
