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

        $this->loadMigrations();

        $this->loadTranslations();

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

    protected function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }

    private function loadTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'admix-redirects');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../../lang');
    }

    protected function loadConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/admix-redirects.php', 'admix-redirects');
        $this->mergeConfigFrom(__DIR__ . '/../../config/audit-alias.php', 'audit-alias');
    }

    protected function publish(): void
    {
        $this->publishes([
            __DIR__ . '/../../config' => base_path('config'),
        ], 'admix-redirects:config');

        $this->publishes([
            __DIR__ . '/../../database/seeders/RedirectTableSeeder.php' => base_path('database/seeders/RedirectTableSeeder.php'),
        ], 'admix-redirects:seeders');

        $this->publishes([
            __DIR__ . '/../../lang/pt_BR' => lang_path('pt_BR'),
        ], ['admix-redirects:translations', 'admix-translations']);
    }
}
