<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use function Lambdish\Phunctional\map;

class RouteServiceProvider extends ServiceProvider
{
    private $myCustomRouteFiles = [
        'apps/erp/backend/routes/auth.php',
        'src/ERP/Clients/Infrastructure/config/routes/index.php',
        'src/ERP/Users/Infrastructure/config/routes/index.php',
        'src/ERP/Company/Infrastructure/config/routes/index.php',
        'src/ERP/Roles/Infrastructure/config/routes/index.php',
        'src/ERP/Provider/Infrastructure/config/routes/index.php',
        'src/ERP/Items/Infrastructure/config/routes/index.php',
        'src/ERP/PurchaseInvoices/Infrastructure/config/routes/index.php',
        'src/ERP/Locations/Infrastructure/config/routes/index.php',
        'src/ERP/Menu/Infrastructure/config/routes/index.php',
        'src/ERP/ItemCategories/Infrastructure/config/routes/index.php',
        'src/ERP/ClientCategories/Infrastructure/config/routes/index.php',
        'apps/erp/backend/routes/petty_cash.php',
        'routes/api.php'
    ];

    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            map(function ($file) {
                Route::prefix('api')
                    ->middleware('api')
                    ->namespace($this->namespace)
                    ->group(base_path($file));
            }, $this->myCustomRouteFiles);
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
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
