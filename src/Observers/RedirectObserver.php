<?php

namespace Agenciafmd\Redirects\Observers;

use Agenciafmd\Redirects\Models\Redirect;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class RedirectObserver
{
    public function saving(Redirect $redirect): void
    {
        $redirect->slug = Str::of($redirect->from)
            ->slug();
    }

    public function saved(Redirect $model): void
    {
        Cache::forget('use-redirect-package');
    }
}