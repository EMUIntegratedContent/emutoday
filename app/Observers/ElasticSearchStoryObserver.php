<?php

namespace Emutoday\Observers;

use Elasticsearch\Client; 
use Emutoday\Story;
use Emutoday\Observers\Interfaces\IElasticSearchStoryObserver;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ElasticSearchStoryObserver implements IElasticSearchStoryObserver{
    private $elasticsearch;
    
    public function __construct(Client $elasticsearch){
        $this->elasticsearch = $elasticsearch;
    }
    
    public function created(Story $story){
        $this->elasticsearch->index([
            'index' => 'emutoday',
            'type' => 'story',
            'id' => $story->id,
            'body' => $story->toArray()
        ]);
    }

    public function updated(Story $story)
    {
        $this->elasticsearch->index([
            'index' => 'emutoday',
            'type' => 'story',
            'id' => $story->id,
            'body' => $story->toArray()
        ]);
    }

    public function deleted(Story $story)
    {
        $this->elasticsearch->delete([
            'index' => 'emutoday',
            'type' => 'story',
            'id' => $story->id
        ]);
    }
}