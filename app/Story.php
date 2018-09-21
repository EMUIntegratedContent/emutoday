<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Sofa\Eloquence\Eloquence;
use Emutoday\StoryType;

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
     ];
     protected $dates = ['start_date', 'end_date'];

    /**
     * Vendor Package
     */
    use PresentableTrait;
    protected $presenter = 'Emutoday\Presenters\StoryPresenter';

    use Eloquence;
    protected $searchableColumns = ['title', 'subtitle', 'teaser', 'content'];

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



}
