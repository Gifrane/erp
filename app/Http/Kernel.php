<?php

namespace App\Http;

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
        \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,

        'check_user' => \App\Http\Middleware\CheckUser::class,

        'user_has_crm_company' => \App\Http\Middleware\UserHasCrmCompany::class,
        'user_has_crm_contact' => \App\Http\Middleware\UserHasCrmContact::class,
        'user_has_crm_group' => \App\Http\Middleware\UserHasCrmGroup::class,
        'user_has_infra' => \App\Http\Middleware\UserHasInfra::class,
        'user_has_product' => \App\Http\Middleware\UserHasProduct::class,
        'user_has_supplier' => \App\Http\Middleware\UserHasSupplier::class,
    ];
}
