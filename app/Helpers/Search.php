<?php
/**
 *  Functions for the search service. Create by Chris Puzzuoli on 11/16/16.
 */
namespace Emutoday\Helpers;

use Emutoday\Helpers\Interfaces\ISearch;
use Illuminate\Support\Facades\Log;

class Search implements ISearch{
    
    public function condenseSearch($results = array()) {
        $allResults = array();
        Log::warning("BBOB");
        foreach($results as $resultsType){
            Log::info("BBOB");
            foreach($resultsType as $result){
                Log::info($result['search_score']);
                $allResults[] = $result;
            }
        }

        usort($allResults, function($a, $b) {
          return $a['search_score'] - $b['search_score'];
        });
        return $allResults;
    }

}
