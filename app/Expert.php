<?php

namespace Emutoday;

use Illuminate\Database\Eloquent\Model;
use Emutoday\StoryImage;
use Emutoday\Experts\Searchable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Sofa\Eloquence\Eloquence;
use DateTimeInterface;

class Expert extends Model
{
    /* elasticsearch trait (not in use as of 5/15/17...using Sofa/Eloquence instead) */
    //use Searchable; //elasticsearch trait

    protected $fillable = [
        'display_name',
        'first_name',
        'last_name',
        'title',
        'biography',
        'teaser',
        'is_media_expert',
        'is_community_speaker',
        'interviews',
        'office_phone',
        'cell_phone',
        'release_cell_phone',
        'email',
        'is_approved',
        'submitter_name',
        'submitter_phone',
        'submitter_email'
    ];

//  use Eloquence;
//  protected $searchableColumns = [
//      'display_name' => 100,
//      'first_name' => 95,
//      'last_name' => 100,
//      'title' => 100,
//      'biography' => 50,
//      'teaser' => 40,
//      'office_phone' => 10,
//      'email' => 40,
//      'education.education' => 20,
//      'expertCategories.category' => 80,
//      'expertise.expertise' => 250,
//      'languages.language' => 20,
//      'previousTitles.title' => 20,
//      'socialMediaLinks.title' => 10,
//      'socialMediaLinks.url' => 10,
//  ];

    /**
     * Custom search created by Chris Puzzuoli for EMU Today. Uses mysql FULLTEXT to match columns against the search term.
     * @param $searchTerm
     * @param null $catetory
     * @return mixed
     */
    public static function runSearch($searchTerm, $catetory = null)
    {
        $conditions = [
            'search_term' => "%$searchTerm%",
            'search_term2' => "%$searchTerm%",
            'search_term3' => "%$searchTerm%",
            'search_term4' => "%$searchTerm%",
            'search_term5' => "%$searchTerm%",
            'search_term6' => "%$searchTerm%",
            'search_term7' => "%$searchTerm%",
            'search_term8' => "%$searchTerm%",
            'search_term9' => "%$searchTerm%",
            'search_term10' => "%$searchTerm%",
            'search_term11' => "%$searchTerm%",
            'search_term12' => "%$searchTerm%",
            'search_term13' => "%$searchTerm%"
        ];

        $sql = "
            SELECT DISTINCT e.id AS id, e.first_name, e.last_name, e.display_name, e.title, ei.id AS imgId,
                        GROUP_CONCAT(MATCH(e.first_name, e.last_name, e.display_name) AGAINST (:search_term) +
                        MATCH(e.title) AGAINST (:search_term2) +
                        MATCH(ee.education) AGAINST (:search_term3) +
                        MATCH(ex.expertise) AGAINST (:search_term4) +
                        MATCH(el.language) AGAINST (:search_term5) +
                        MATCH(es.title) AGAINST (:search_term6) +
                        MATCH(et.title) AGAINST (:search_term7) SEPARATOR '@@') AS score_fld
                    FROM experts e";

        if($catetory) {
            $sql .= " JOIN experts_expertcategory ec ON ec.expert_id = e.id AND ec.cat_id = 
                (SELECT DISTINCT id FROM expertscategory WHERE category = :category)
            ";
            $conditions['category'] = $catetory;
        }
        $sql .= " LEFT JOIN expertseducation ee ON ee.expert_id = e.id
            LEFT JOIN expertsexpertise ex ON ex.expert_id = e.id
            LEFT JOIN expertslanguages el ON el.expert_id = e.id
            LEFT JOIN expertssocial es ON es.expert_id = e.id
            LEFT JOIN expertstitles et ON et.expert_id = e.id
            LEFT JOIN experts_images ei ON ei.expert_id = e.id
        ";
        $sql .= "
                    WHERE is_approved = 1 
                      AND 
                      (
                        MATCH(e.title, e.first_name, e.last_name, e.display_name) AGAINST (:search_term8)
                        OR MATCH(ee.education) AGAINST (:search_term9)
                        OR MATCH(ex.expertise) AGAINST (:search_term10)
                        OR MATCH(el.language) AGAINST (:search_term11)
                        OR MATCH(es.title) AGAINST (:search_term12)
                        OR MATCH(et.title) AGAINST (:search_term13)
                      )
                    GROUP BY e.id, e.last_name
                    ORDER BY e.last_name ASC
        ";
        $items = DB::select($sql, $conditions);
        $numRows = count($items);
        $items = self::hydrate($items);
        return new LengthAwarePaginator($items, $numRows, 10);
    }

    public function getFullNameAttribute()
    {
        return $this->last_name . ', ' . $this->first_name;
    }

    public function addImage()
    {
        return $this->expertImages()->create([
            'image_name' => 'img' . $this->id . '_expert',
            'image_type' => 'headshot',
        ]);
    }

    public function expertImages()
    {
        return $this->hasMany('Emutoday\ExpertImage');
    }

    public function images()
    {
        return $this->hasMany('Emutoday\ExpertImage');
    }

    public function expertCategories()
    {
        return $this->belongsToMany('Emutoday\ExpertCategory', 'experts_expertcategory', 'expert_id', 'cat_id');
    }

    public function education()
    {
        return $this->hasMany('Emutoday\ExpertEducation');
    }

    public function languages()
    {
        return $this->hasMany('Emutoday\ExpertLanguages');
    }

    public function expertise()
    {
        return $this->hasMany('Emutoday\ExpertExpertise');
    }

    public function socialMediaLinks()
    {
        return $this->hasMany('Emutoday\ExpertSocial');
    }

    public function previousTitles()
    {
        return $this->hasMany('Emutoday\ExpertTitles');
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
