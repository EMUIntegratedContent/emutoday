<?php

namespace Emutoday\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', \Emutoday\Http\ViewComposers\AddCurrentUser::class);

        // $this->app['view']->composer(['*'], Composers\AddCurrentUser::class);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
