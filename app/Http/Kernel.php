<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware run during every request to your application.
     */
    protected $middleware = [
        // Trust proxies / handle forwarded headers
        \App\Http\Middleware\TrustProxies::class,

        // Handle CORS (if present in your app)
        \Illuminate\Http\Middleware\HandleCors::class,

        // Prevent requests during maintenance
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,

        // Validate request size
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,

        // Trim strings
        \App\Http\Middleware\TrimStrings::class,

        // Convert empty strings to null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     */
    protected $middlewareGroups = [
        'web' => [
            // Encrypt cookies
            \App\Http\Middleware\EncryptCookies::class,

            // Add queued cookies to response
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,

            // Start session
            \Illuminate\Session\Middleware\StartSession::class,

            // Share errors from session to views
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,

            // Verify CSRF token
            \App\Http\Middleware\VerifyCsrfToken::class,

            // Substitute route model bindings
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // If you use Sanctum, uncomment:
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,

            // Throttle API
            'throttle:api',

            // Substitute route model bindings
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's middleware aliases.
     *
     * NOTE: Newer Laravel versions commonly use $middlewareAliases.
     * Keeping both doesn't hurt; Laravel will use what it expects.
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,

        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,

        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // ✅ YOUR ADMIN ROLE CHECK
        'admin.only' => \App\Http\Middleware\AdminOnly::class,
    ];

    /**
     * For Laravel versions that prefer middleware aliases.
     * Safe to keep this in sync with $routeMiddleware.
     */
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,

        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,

        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // ✅ YOUR ADMIN ROLE CHECK
        'admin.only' => \App\Http\Middleware\AdminOnly::class,
    ];
}
