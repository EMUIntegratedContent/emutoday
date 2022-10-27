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

    /**
     * Custom search created by Chris Puzzuoli for EMU Today. Uses mysql FULLTEXT to match columns against the search term.
     * @param $searchTerm
     * @param null $catetory
     * @param bool $orderByLastName
     * @return mixed
     */
    public static function runSearch($searchTerm, $catetory = null, $orderByLastName = false)
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
            'search_term13' => "%$searchTerm%",
            'search_term14' => "%$searchTerm%",
            'search_term15' => "%$searchTerm%",
            'search_term16' => "%$searchTerm%",
            'search_term17' => "%$searchTerm%"
        ];

        $sql = "
            SELECT DISTINCT e.id AS id, e.first_name, e.last_name, e.display_name, e.title, ei.id AS imgId,
                SUM(
                    MATCH(e.first_name, e.last_name, e.display_name) AGAINST (:search_term) +
                    IF(ee.score_edu IS NOT NULL, (ee.score_edu)*2, 0) +
                    IF(ex.score_exp IS NOT NULL, (ex.score_exp)*3, 0) +
                    IF(el.score_lang IS NOT NULL, (el.score_lang)*1, 0) +
                    IF(es.score_soc IS NOT NULL, (es.score_soc)*1, 0) +
                    IF(et.score_ttl IS NOT NULL, (et.score_ttl)*2, 0)
                ) as search_score
            FROM experts e";

        if($catetory) {
            $sql .= " JOIN experts_expertcategory ec ON ec.expert_id = e.id AND ec.cat_id = 
                (SELECT DISTINCT id FROM expertscategory WHERE category = :category)
            ";
            $conditions['category'] = $catetory;
        }
        $sql .= " 
            LEFT JOIN (
                SELECT DISTINCT ee.expert_id, score_edu
                FROM expertseducation ee
                JOIN (
                    SELECT expert_id, MAX(MATCH(education) AGAINST (:search_term2)) AS score_edu
                    FROM expertseducation
                    WHERE MATCH(education) AGAINST (:search_term3)
                    GROUP BY expert_id
                ) ee2 ON ee2.expert_id = ee.expert_id
                WHERE MATCH(education) AGAINST (:search_term4)
                GROUP BY ee.expert_id
            ) ee ON ee.expert_id = e.id
            LEFT JOIN (
                SELECT DISTINCT ex.expert_id, score_exp
                FROM expertsexpertise ex
                JOIN (
                    SELECT expert_id, MAX(MATCH(expertise) AGAINST (:search_term5)) AS score_exp
                    FROM expertsexpertise
                    WHERE MATCH(expertise) AGAINST (:search_term6)
                    GROUP BY expert_id
                ) ex2 ON ex2.expert_id = ex.expert_id
                WHERE MATCH(expertise) AGAINST (:search_term7)
                GROUP BY ex.expert_id
            ) ex ON ex.expert_id = e.id
            LEFT JOIN (
                SELECT DISTINCT el.expert_id, score_lang
                FROM expertslanguages el
                JOIN (
                    SELECT expert_id, MAX(MATCH(language) AGAINST (:search_term8)) AS score_lang
                    FROM expertslanguages
                    WHERE MATCH(language) AGAINST (:search_term9)
                    GROUP BY expert_id
                ) el2 ON el2.expert_id = el.expert_id
                WHERE MATCH(language) AGAINST (:search_term10)
                GROUP BY el.expert_id
            ) el ON el.expert_id = e.id
            LEFT JOIN (
                SELECT DISTINCT es.expert_id, score_soc
                FROM expertssocial es
                JOIN (
                    SELECT expert_id, MAX(MATCH(title) AGAINST (:search_term11)) AS score_soc
                    FROM expertssocial
                    WHERE MATCH(title) AGAINST (:search_term12)
                    GROUP BY expert_id
                ) es2 ON es2.expert_id = es.expert_id
                WHERE MATCH(title) AGAINST (:search_term13)
                GROUP BY es.expert_id
            ) es ON es.expert_id = e.id
            LEFT JOIN (
                SELECT DISTINCT et.expert_id, score_ttl
                FROM expertstitles et
                JOIN (
                    SELECT expert_id, MAX(MATCH(title) AGAINST (:search_term14)) AS score_ttl
                    FROM expertstitles
                    WHERE MATCH(title) AGAINST (:search_term15)
                    GROUP BY expert_id
                ) et2 ON et2.expert_id = et.expert_id
                WHERE MATCH(title) AGAINST (:search_term16)
                GROUP BY et.expert_id
            ) et ON et.expert_id = e.id
            LEFT JOIN experts_images ei ON ei.expert_id = e.id
        ";
        $sql .= "
                    WHERE is_approved = 1 
                      AND 
                      (
                        MATCH(e.title, e.first_name, e.last_name, e.display_name) AGAINST (:search_term17)
                        OR score_edu IS NOT NULL
                        OR score_exp IS NOT NULL
                        OR score_lang IS NOT NULL
                        OR score_soc IS NOT NULL
                        OR score_ttl IS NOT NULL
                      )
                    GROUP BY e.id, e.last_name, ei.id
                    HAVING search_score >= 7
        ";
        if($orderByLastName) {
            $sql .= "ORDER BY e.last_name ASC, search_score DESC";
        } else {
            $sql .= "ORDER BY search_score DESC";
        }
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
