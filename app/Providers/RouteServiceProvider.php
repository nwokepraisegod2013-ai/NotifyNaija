<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Path to your "home" route (after login redirects etc.)
     */
    public const HOME = '/dashboard';

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->routes(function () {

            /*
            |------------------------------------------------------------
            | API ROUTES
            |------------------------------------------------------------
            | Stateless routes, usually prefixed with /api
            */
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            /*
            |------------------------------------------------------------
            | WEB ROUTES
            |------------------------------------------------------------
            | Session-based routes, CSRF enabled
            */
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}