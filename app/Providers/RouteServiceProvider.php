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
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            $this->mapAdminRoutes();
            $this->mapAppRoutes();

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace('App\Http\Controllers\Public')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }


    protected function mapAdminRoutes()
    {
        $host = parse_url(env('APP_URL'))['host'];
        $admin_prefix = env('ADMIN_PREFIX', 'admin');
        $domain = $admin_prefix . '.' . $host;
        Route::middleware('web')
            ->domain($domain)
            ->name('admin.')
            ->namespace('App\Http\Controllers\Admin')
            ->group(base_path('routes/admin.php'));
    }

    protected function mapAppRoutes()
    {
        $domain = 'app.' . parse_url(env('APP_URL'))['host'];
        Route::middleware('web')
            ->domain($domain)
            ->name('app.')
            ->namespace('App\Http\Controllers\App')
            ->group(base_path('routes/app.php'));
    }
}
