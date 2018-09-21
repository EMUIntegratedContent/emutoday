<?php
/**
 *  Functions for the search service. Create by Chris Puzzuoli on 11/16/16.
 */
namespace Emutoday\Helpers;

use Emutoday\Helpers\Interfaces\ISearch;

class Search implements ISearch{
    
    public function condenseSearch($results = array()) {
        $allResults = array();
        foreach($results as $resultsType){
            foreach($resultsType as $result){
                $allResults[] = $result;
            }
        }
        return $allResults;
    }

}
