<?php

namespace Agenciafmd\Redirects\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootBladeComponents();

        $this->bootBladeDirectives();

        $this->bootBladeComposers();

        $this->bootMenu();

        $this->bootViews();

        $this->bootPublish();
    }

    public function register(): void
    {
        //
    }

    private function bootBladeComponents(): void
    {
        Blade::componentNamespace('Agenciafmd\\Redirects\\Http\\Components', 'admix-redirects');
    }

    private function bootBladeComposers(): void
    {
        //
    }

    private function bootBladeDirectives(): void
    {
        //
    }

    private function bootMenu(): void
    {
        $this->app->make('admix-menu')
            ->push((object) [
                'component' => 'admix-redirects::aside.redirect',
                'ord' => config('admix-redirects.sort'),
            ]);
    }

    private function bootViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admix-redirects');
    }

    private function bootPublish(): void
    {
        //        $this->publishes([
        //            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/agenciafmd/redirects'),
        //        ], 'admix-redirects:views');
    }
}
