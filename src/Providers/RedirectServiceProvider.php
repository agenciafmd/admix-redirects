<?php

namespace Agenciafmd\Redirects\Providers;

use Agenciafmd\Redirects\Models\Redirect;
use Agenciafmd\Redirects\Observers\RedirectObserver;
use Illuminate\Support\ServiceProvider;

class RedirectServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->providers();

        $this->setObservers();

        $this->setSearch();

        $this->loadMigrations();

        $this->publish();
    }

    public function register(): void
    {
        $this->loadConfigs();
    }

    protected function providers(): void
    {
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(BladeServiceProvider::class);
        $this->app->register(LivewireServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }

    protected function setObservers(): void
    {
        Redirect::observe(RedirectObserver::class);
    }

    protected function setSearch(): void
    {
        $this->app->make('admix-search')
            ->registerModel(Redirect::class, 'from');
    }

    protected function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    protected function loadConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/admix-redirects.php', 'admix-redirects');
        $this->mergeConfigFrom(__DIR__ . '/../config/gate.php', 'gate');
        $this->mergeConfigFrom(__DIR__ . '/../config/audit-alias.php', 'audit-alias');
        $this->mergeConfigFrom(__DIR__ . '/../config/upload-configs.php', 'upload-configs');
    }

    protected function publish(): void
    {
        $this->publishes([
            __DIR__ . '/../Database/Faker' => base_path('database/faker'),
            __DIR__ . '/../config/upload-configs.php' => base_path('config/upload-configs.php'),
        ], 'admix-redirects:minimal');

        $this->publishes([
            __DIR__ . '/../config/admix-redirects.php' => base_path('config/admix-redirects.php'),
            __DIR__ . '/../config/upload-configs.php' => base_path('config/upload-configs.php'),
        ], 'admix-redirects:configs');

        $this->publishes([
            __DIR__ . '/../Database/Factories/RedirectFactory.php' => base_path('database/factories/RedirectFactory.php'),
            __DIR__ . '/../Database/Faker' => base_path('database/faker'),
            __DIR__ . '/../Database/Seeders/RedirectsTableSeeder.php' => base_path('database/seeders/RedirectsTableSeeder.php'),
        ], 'admix-redirects:seeders');
    }
}
