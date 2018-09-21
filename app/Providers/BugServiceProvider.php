<?php

namespace Emutoday\Providers;

use Illuminate\Support\ServiceProvider;
use Emutoday\Helpers\Bug;

/**
 * This service provider is for the administrative header. It is meant to return all announcements, events and stories that still need approval.
 */
class BugServiceProvider extends ServiceProvider
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
        $this->app->bind('Emutoday\Helpers\Interfaces\IBug', function(){
            return new Bug();
        });
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Emutoday\Helpers\Interfaces\IBug'];
    }

}
