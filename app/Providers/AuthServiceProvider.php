<?php

namespace Emutoday\Providers;

use Emutoday\Permission;

use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Emutoday\Model' => 'Emutoday\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addDays(15));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(120));

        foreach ($this->getPermissions() as $permission) {
                        Gate::define( $permission->name, function ($user) use ($permission) {
                                return $user->hasRole($permission->roles);
                        });
                    }


    }

    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
