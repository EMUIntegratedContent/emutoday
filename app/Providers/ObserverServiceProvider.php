<?php

namespace Emutoday\Providers;

use Emutoday\Observers\ElasticSearchStoryObserver;
use Emutoday\Observers\IElasticSearchStoryObserver;
use Emutoday\Story;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Client;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Story::observe($this->app->make(ElasticSearchStoryObserver::class));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ElasticSearchStoryObserver::class, function(){
            return new ElasticSearchStoryObserver(ClientBuilder::create()->build());
        });
    }

}
