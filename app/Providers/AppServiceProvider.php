<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel to redirect users after login.
     *
     * @var string
     */
    
    public const HOME = '/dashboard'; // ubah ini atau ganti logic di AuthenticatedSessionController


    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        // Custom logic before routes (optional)

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }
}
