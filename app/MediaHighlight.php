<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Emutoday\MediaHighlight\Searchable;
use Illuminate\Support\Facades\DB;
use Sofa\Eloquence\Eloquence;
use DateTimeInterface;

class MediaHighlight extends Model
{

    protected $fillable = [
      'title',
      'url',
      'source',
      'priority',
      'is_archived',
      'added_by'
    ];

    protected $casts = [
      'start_date' => 'datetime'
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
     * @param null $tag
     * @return mixed
     */
    public static function runSearch($searchTerm, $tag = null) {
        $conditions = [];
        $sql = "SELECT h.title, h.source, h.url, h.start_date
                    FROM media_highlights h";
        if($tag) {
            $sql .= " JOIN mediahighlights_tags t ON t.mediahighlight_id = h.id";
        }
        $sql .= " WHERE h.is_archived = 0";
        if($searchTerm) {
            $sql .= " AND MATCH(h.title, h.source) AGAINST (:search_term)";
            $conditions['search_term'] = "%$searchTerm%";
        }
        $sql .= " ORDER BY h.start_date DESC";
        $items = DB::select($sql, $conditions);
        return self::hydrate($items); // takes the raw query and turns it into a collection of models
    }
}
