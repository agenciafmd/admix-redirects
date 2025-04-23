<?php

namespace Agenciafmd\Redirects\Http\Components\Aside;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Gate;
use Agenciafmd\Redirects\Models\Redirect as RedirectModel;

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
        $this->visible = Gate::allows('view', RedirectModel::class);

        return view('admix::components.aside.item');
    }
}
