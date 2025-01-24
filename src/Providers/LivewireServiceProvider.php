<?php

namespace Agenciafmd\Redirects\Providers;

use Agenciafmd\Redirects\Livewire\Pages;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Livewire::component('agenciafmd.redirects.livewire.pages.redirect.index', Pages\Redirect\Index::class);
        Livewire::component('agenciafmd.redirects.livewire.pages.redirect.component', Pages\Redirect\Component::class);
    }

    public function register(): void
    {
        //
    }
}
