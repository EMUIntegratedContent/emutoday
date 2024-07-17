<?php

namespace Emutoday\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \Emutoday\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Emutoday\Http\Middleware\VerifyCsrfToken::class,
            \Laravel\Passport\Http\Middleware\CreateFreshApiToken::class,
						\Illuminate\Routing\Middleware\SubstituteBindings::class
        ],

        'cors' => [
            \Illuminate\Http\Middleware\HandleCors::class,        ],

        'email' => [
          \Emutoday\Http\Middleware\EmailsMiddleware::class,
        ],

        'experts' => [
          \Emutoday\Http\Middleware\ExpertsMiddleware::class,
        ],

				'intcomm' => [
					\Emutoday\Http\Middleware\IntcommMiddleware::class,
				],

        'mediahighlights' => [
          \Emutoday\Http\Middleware\MediaHighlightMiddleware::class,
        ],

        'storyideas' => [
          \Emutoday\Http\Middleware\StoryIdeaMiddleware::class,
        ],

        'api' => [
            'throttle:60,1',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Emutoday\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can' => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        'guest' => \Emutoday\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'cas.auth'  => \Subfission\Cas\Middleware\CASAuth::class,
        'cas.guest' => \Subfission\Cas\Middleware\RedirectCASAuthenticated::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'client_credentials' => \Laravel\Passport\Http\Middleware\CheckClientCredentials::class, //for Laravel Passport OAuth
    ];
}
