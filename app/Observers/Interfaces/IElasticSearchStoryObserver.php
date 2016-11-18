<?php

namespace Emutoday\Observers\Interfaces;

use Elasticsearch\Client; 
use Emutoday\Story;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

interface IElasticSearchStoryObserver{
    
    public function __construct(Client $elasticsearch);
    
    public function created(Story $story);

    public function updated(Story $story);

    public function deleted(Story $story);
}