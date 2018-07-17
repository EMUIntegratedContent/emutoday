<?php

namespace Emutoday\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use DB;
use Log;

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

        if(env('APP_ENV') == 'dev') {
            Schema::defaultStringLength(191);
            DB::listen(function ($query) {
                Log::info(
                    $query->sql,
                    $query->bindings,
                    $query->time
                );
            });
        }

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
