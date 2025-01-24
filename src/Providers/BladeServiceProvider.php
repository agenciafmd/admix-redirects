<?php

namespace Agenciafmd\Redirects\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadBladeComponents();

        $this->loadBladeDirectives();

        $this->loadBladeComposers();

        $this->setMenu();

        $this->loadViews();

        $this->publish();
    }

    public function register(): void
    {
        //
    }

    private function loadBladeComponents(): void
    {
        Blade::componentNamespace('Agenciafmd\\Redirects\\Http\\Components', 'admix-redirects');
    }

    private function loadBladeComposers(): void
    {
        //
    }

    private function loadBladeDirectives(): void
    {
        //
    }

    protected function setMenu(): void
    {
        $this->app->make('admix-menu')
            ->push((object) [
                'component' => 'admix-redirects::aside.redirect',
                'ord' => config('admix-redirects.sort'),
            ]);
    }

    protected function loadViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admix-redirects');
    }

    protected function publish(): void
    {
//        $this->publishes([
//            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/agenciafmd/redirects'),
//        ], 'admix-redirects:views');
    }
}
