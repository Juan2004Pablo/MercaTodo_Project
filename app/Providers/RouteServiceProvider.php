<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'App\Http\Controllers';

    public const HOME = '/home';

    public function boot(): void
    {
        parent::boot();
    }

    public function map(): void
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();

        $this->mapCartRoutes();

        $this->mapPayRoutes();

        $this->mapExportRoutes();

        $this->mapImportRoutes();

        $this->mapReportRoutes();
    }

    protected function mapApiRoutes()
    {
        Route::middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

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
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/pay.php'));
    }

    protected function mapExportRoutes(): void
    {
        Route::prefix('export')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/export.php'));
    }

    protected function mapImportRoutes(): void
    {
        Route::prefix('import')
            ->middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/import.php'));
    }

    protected function mapReportRoutes(): void
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/report.php'));
    }
}
