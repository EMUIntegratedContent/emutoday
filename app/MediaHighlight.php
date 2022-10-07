<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Emutoday\MediaHighlight\Searchable;
use Illuminate\Support\Facades\DB;
use Sofa\Eloquence\Eloquence;
use DateTimeInterface;

class MediaHighlight extends Model
{
//    use Eloquence;
    
    protected $fillable = [
      'title',
      'url',
      'source',
      'priority',
      'is_archived',
      'added_by'
    ];

//    protected $searchableColumns = [
//        'title' => 100,
//        'source' => 90
//    ];

    protected $dates = [
      'start_date'
    ];

    public function tags(){
      return $this->belongsToMany('Emutoday\MediaHighlightTag', 'mediahighlights_tags', 'mediahighlight_id', 'tag_id')->withTimestamps();
    }

    public function addedBy(){
        return $this->belongsTo('Emutoday\User', 'added_by');
    }

    public function getFullNameAttribute(){
        return $this->addedBy()->first()->first_name . ' '. $this->addedBy()->first()->last_name;
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

    /**
     * Custom search created by Chris Puzzuoli for EMU Today. Uses mysql FULLTEXT to match columns against the search term.
     * @param $searchTerm
     * @return mixed
     */
    public static function runSearch($searchTerm) {
        $items = DB::select(
            "
                    SELECT title, `source`, url, start_date
                    FROM media_highlights 
                    WHERE is_archived = 0 
                      AND MATCH(title, `source`) AGAINST (:search_term)
                    ORDER BY start_date DESC
                ",
            array(
                'search_term' => "%$searchTerm%"
            )
        );

        if($searchTerm == '') {
            $items = DB::select(
                "
                    SELECT title, `source`, url, start_date
                    FROM media_highlights 
                    WHERE is_archived = 0
                    ORDER BY start_date DESC
                ",
                array()
            );
        }
        return self::hydrate($items); // takes the raw query and turns it into a collection of models
    }
}
