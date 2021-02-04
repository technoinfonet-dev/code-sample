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
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
        \App\Http\Middleware\ModuleAccessMiddleware::class,
        \App\Http\Middleware\SecureHeaders::class // Here we added newly created middleware.
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
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
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
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'front_auth' => \App\Http\Middleware\FrontAuthenticate::class,
        'business_auth' => \App\Http\Middleware\BusinessAuthenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'admin_auth' => \App\Http\Middleware\AdminAuthenticate::class,
        'guest_admin' => \App\Http\Middleware\AdminRedirectIfAuthenticated::class,
        'module_access' => \App\Http\Middleware\ModuleAccessMiddleware::class,
        'check_url_segment' => \App\Http\Middleware\CheckUrlSegment::class,
        'check_user_country_session' => \App\Http\Middleware\CheckUserCountrySession::class,
        'check_business_user_country_session' => \App\Http\Middleware\CheckBusinessUserCountrySession::class,
        'check_admin_country_session' => \App\Http\Middleware\CheckAdminCountrySession::class,
        'xss_filtering' => \App\Http\Middleware\XSSProtection::class,
        'prevent-back-history' => \App\Http\Middleware\PreventBackHistory::class,
        'auth.jwt' => \Tymon\JWTAuth\Http\Middleware\Authenticate::class,
        'apiFrontAuth' => \App\Http\Middleware\ApiFrontUserAuthCheckMiddleware::class,
        'apiBusinessAuth' => \App\Http\Middleware\ApiBusinessUserAuthCheck::class,
        'redirect_to_next_url' => \App\Http\Middleware\RedirectToNextURL::class,
        'set_default_language' => \App\Http\Middleware\SetDefaultLanguage::class,
        'check_coupan_code_validity' => \App\Http\Middleware\CheckFreePremiumExpiryDate::class,
        'check_admin_status' => \App\Http\Middleware\CheckAdminStatus::class,
        'admin_activity_logs' => \App\Http\Middleware\AdminActivityLogs::class,
        'check_ip_login_access' => \App\Http\Middleware\CheckUserIPLoginAccess::class,
    ];
}
