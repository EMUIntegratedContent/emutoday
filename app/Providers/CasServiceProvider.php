<?php

namespace Emutoday\Providers;

use Illuminate\Support\ServiceProvider;
use Emutoday\Services\CasService;
use Emutoday\Facades\Cas;

class CasServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('cas', function ($app) {
            return new CasService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

