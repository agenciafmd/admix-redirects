<?php

namespace Agenciafmd\Redirects\Http\Components\Aside;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Redirect extends Component
{
    public function __construct(
        public string $icon = '',
        public string $label = '',
        public string $url = '',
        public bool $active = false,
        public bool $visible = false,
    ) {}

    public function render(): View
    {
        $this->icon = __(config('admix-redirects.icon'));
        $this->label = __(config('admix-redirects.name'));
        $this->url = route('admix.redirects.index');
        $this->active = request()?->currentRouteNameStartsWith('admix.redirects');
        $this->visible = true;

        return view('admix::components.aside.item');
    }
}
