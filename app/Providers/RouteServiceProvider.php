<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();
    }

<<<<<<< Updated upstream
=======
<<<<<<< Updated upstream
        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->group(base_path('routes/api.php'));
=======
>>>>>>> Stashed changes
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(): void
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
<<<<<<< Updated upstream
    }
=======

        $this->mapAdminRoutes();

        $this->mapCartRoutes();

        $this->mapPayRoutes();
    }
>>>>>>> Stashed changes
>>>>>>> Stashed changes

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    protected function mapAdminRoutes(): void
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }

    protected function mapCartRoutes(): void
    {
        Route::prefix('cart')  
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/cart.php'));
    }

    protected function mapPayRoutes(): void
    {
        Route::prefix('pay')  
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/pay.php'));
    }
    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
