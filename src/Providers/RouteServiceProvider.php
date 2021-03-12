<?php

namespace Weikit\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The route namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $routeNamespace = 'Weikit\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        $this->registerRateLimit();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        Route::namespace($this->routeNamespace)
            ->group(weikit_path('/routes/routes.php'));
    }

    public function registerRateLimit()
    {
        RateLimiter::for('login', function (Request $request) {
            return [
                Limit::perMinute(500),
                Limit::perMinute(3)->by($request->input('email')),
            ];
        });
    }
}
