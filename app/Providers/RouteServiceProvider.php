<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the api routes.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $apiNamespace = 'App\Http\Controllers\API';

    /**
     * The version of the api.
     * 
     * @var string
     */
    protected $apiVersion = 'v1';

    /**
     * Admin Routes
     */
    protected function mapAdminRoutes()
    {
        Route::group([
            'middleware' => ['api'],
            'namespace' => "{$this->apiNamespace}\\{$this->apiVersion}\\Admin",
            'prefix'     => 'v1/admin',
        ], function($router){
            require base_path('/routes/v1/admin.php');
        });
    }

    /**
     * User Routes
     */
    protected function mapUserRoutes()
    {
        Route::group([
            'middleware' => ['api'],
            'namespace' => "{$this->apiNamespace}\\{$this->apiVersion}\\User",
            'prefix'     => 'v1/user',
        ], function($router){
            require base_path('/routes/v1/user.php');
        });
    }

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->mapAdminRoutes();

        $this->mapUserRoutes();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
