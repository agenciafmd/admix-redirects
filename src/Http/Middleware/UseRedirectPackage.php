<?php

namespace Agenciafmd\Redirects\Http\Middleware;

use Agenciafmd\Redirects\Models\Redirect;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class UseRedirectPackage
{
    public function handle(Request $request, Closure $next)
    {
        $uri = $request->url();

        $redirects = Cache::rememberForever('use-redirect-package', static function () {
            return Collection::make(Redirect::query()
                ->isActive()
                ->select([
                    'from',
                    'to',
                    'type',
                ])
                ->get()
                ->map(static function ($item) {
                    $item['from'] = config('app.url') . '/' . Str::of($item->from)
                        ->trim('/')
                        ->trim()
                        ->__toString();

                    return $item;
                })
                ->toArray());
        });

        $redirect = $redirects->where('from', $uri)
            ->first();
        if ($redirect) {
            return redirect()->to($redirect['to'], $redirect['type']);
        }

        $wildCardRedirect = $redirects->map(function ($redirect) {
            $redirect['from'] = Str::of($redirect['from'])
                ->replace(config('app.url'), '')
                ->trim('/')
                ->trim()
                ->__toString();

            return $redirect;
        })
            ->filter(static function ($redirect) {
                return Str::of($redirect['from'])
                    ->endsWith('*');
            })
            ->filter(function ($redirect) use ($request) {
                return $request->is($redirect['from']);
            })
            ->first();
        if ($wildCardRedirect) {
            return redirect()->to($wildCardRedirect['to'], $wildCardRedirect['type']);
        }

        return $next($request);
    }
}
