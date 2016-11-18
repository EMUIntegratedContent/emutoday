<?php

namespace Emutoday\Repositories;

use Emutoday\Repositories\Interfaces\IStoryRepository;
use Illuminate\Support\Collection;
use Emutoday\Story;
use Elasticsearch\Client;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ElasticStoryRepository implements IStoryRepository{
    
    private $elasticsearch;
    private $innerRepository;

    public function __construct(Client $client, StoryRepository $innerRepository)
    {
        $this->elasticsearch = $client;
        $this->innerRepository = $innerRepository;
    }
    
    /**
     * @param string $query = ""
     * @return Collection
     */
    public function search($query = "")
    {
        $items = $this->searchOnElasticsearch($query);

        return $this->buildCollection($items);
    }

    /**
     * @return Collection
     */
    public function all()
    {
        return $this->innerRepository->all();
    }

    /**
     * @param string $query
     * @result array
     */
    private function searchOnElasticsearch($query)
    {
        $items = $this->elasticsearch->search([
            'index' => 'emutoday',
            'type' => 'story',
            'body' => [
                'query' => [
                    'query_string' => [
                        'query' => $query
                    ]
                ]
            ]
        ]);

        return $items;
    }

    /**
     * @param array $items the elasticsearch result
     * @return Collection of Eloquent models
     */
    private function buildCollection($items)
    {
        $result = $items['hits']['hits'];

        return Collection::make(array_map(function($r) {
            $story = new Story();
            $story->newInstance($r['_source'], true);
            $story->setRawAttributes($r['_source'], true);
            return $story;
        }, $result));
    }

}
