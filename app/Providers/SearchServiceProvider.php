<?php

namespace Emutoday\Providers;

use Illuminate\Support\ServiceProvider;
use Emutoday\Helpers\Search;

class SearchServiceProvider extends ServiceProvider
{
    protected $defer = true;
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Emutoday\Helpers\Interfaces\ISearch', function(){
            return new Search();
        });
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Emutoday\Helpers\Interfaces\ISearch'];
    }

}
