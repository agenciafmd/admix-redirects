@can('view', \Agenciafmd\Redirects\Models\Redirect::class)
    <li class="nav-item">
        <a class="nav-link {{ (Str::startsWith(request()->route()->getName(), 'admix.redirects')) ? 'active' : '' }}"
           href="{{ route('admix.redirects.index') }}"
           aria-expanded="{{ (Str::startsWith(request()->route()->getName(), 'admix.redirects')) ? 'true' : 'false' }}">
        <span class="nav-icon">
            <i class="icon {{ config('admix-redirects.icon') }}"></i>
        </span>
            <span class="nav-text">
            {{ config('admix-redirects.name') }}
        </span>
        </a>
    </li>
@endcan
