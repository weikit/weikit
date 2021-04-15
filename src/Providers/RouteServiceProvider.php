<?php

namespace Weikit\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The route namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $routeNamespace = 'Weikit\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->routes(function () {
            Route::namespace($this->routeNamespace)
                 ->group(weikit_path('routes/global.php'));

            Route::middleware('web')
                ->namespace($this->routeNamespace)
                ->group(weikit_path('routes/web.php'));

            Route::middleware('api')
                ->namespace($this->routeNamespace . '\Api')
                ->group(weikit_path('routes/api.php'));
        });
    }
}
