<?php

namespace Emutoday\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        view()->composer('*', \Emutoday\Http\ViewComposers\AddCurrentUser::class);

        // $this->app['view']->composer(['*'], Composers\AddCurrentUser::class);

        if(env('APP_ENV') == 'local' || env('APP_ENV') == 'dev') {
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
