<?php

namespace Emutoday\Providers;

use Emutoday\Repositories\ElasticStoryRepository;
use Emutoday\Story;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Client;
use Illuminate\Support\ServiceProvider;
use Emutoday\Repositories\StoryRepository;
use Emutoday\Repositories\Interfaces\IStoryRepository;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IStoryRepository::class, function(){
            return new ElasticStoryRepository(ClientBuilder::create()->build(), new StoryRepository());
        });
    }

}
