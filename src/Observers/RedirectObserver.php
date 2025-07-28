<?php

namespace Agenciafmd\Redirects\Observers;

use Agenciafmd\Redirects\Models\Redirect;

class RedirectObserver
{
    public function saving(Redirect $redirect): void
    {
        //
    }

    public function saved(Redirect $model): void
    {
        cache()->forget('use-redirect-package');
    }
}
