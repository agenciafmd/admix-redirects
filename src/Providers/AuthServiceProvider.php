<?php

namespace Agenciafmd\Redirects\Providers;

use Agenciafmd\Redirects\Models\Redirect;
use Agenciafmd\Redirects\Policies\RedirectPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Redirect::class => RedirectPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
