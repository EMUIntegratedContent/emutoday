<?php
/**
 *  Functions for the search service. Create by Chris Puzzuoli on 11/16/16.
 */
namespace Emutoday\Helpers;

use Emutoday\Helpers\Interfaces\ISearch;
use Illuminate\Support\Facades\Log;

class Search implements ISearch{

    /**
     * Gathers all disparate search results, gathers them into one array,
     * and then sorts all results by the 'search_score' field, which is an aggregate SUM field using MYSQL FULLTEXT
     * indexes in each query.
     * @param $results
     * @return array
     */
    public function condenseSearch($results = array()) {
        $allResults = array();
        foreach($results as $resultsType){
            foreach($resultsType as $result){
                $allResults[] = $result;
            }
        }
        // Sort all results from highest to lowest search_score
        usort($allResults, function($a, $b) {
          return $a['search_score'] < $b['search_score'];
        });
        return $allResults;
    }

}
