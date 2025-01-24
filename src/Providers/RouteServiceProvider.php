<?php

namespace Agenciafmd\Redirects\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes(function () {
            Route::prefix(config('admix.url'))
                ->middleware(['web', 'auth:admix-web'])
                ->group(__DIR__ .  '/../../routes/web.php');
        });
    }

    public function register(): void
    {
        $this->loadBindings();

        parent::register();
    }

    private function loadBindings(): void
    {
        //
    }
}
