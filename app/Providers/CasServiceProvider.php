<?php

/**
 * Created Sept 2, 2025 to replace the deprecated subfission/cas package with a custom Cas service, service provider, and facade.
 */
namespace Emutoday\Providers;

use Illuminate\Support\ServiceProvider;
use Emutoday\Services\CasService;

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
