<?php

namespace Emutoday\Providers;

use Emutoday\Permission;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        foreach ($this->getPermissions() as $permission) {
                        $gate->define( $permission->name, function ($user) use ($permission) {
                                return $user->hasRole($permission->roles);
                        });
                    }
        //
    }

    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
