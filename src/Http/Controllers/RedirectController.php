<?php

namespace Agenciafmd\Redirects\Http\Controllers;

use Agenciafmd\Redirects\Http\Requests\RedirectRequest;
use Agenciafmd\Redirects\Models\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class RedirectController extends Controller
{
    public function index(Request $request): View
    {
        session()->put('backUrl', request()?->fullUrl());

        $query = QueryBuilder::for(Redirect::class)
            ->defaultSorts(config('admix-redirects.default_sort'))
            ->allowedSorts($request->sort)
            ->allowedFilters(array_merge((($request->filter) ? array_keys(array_diff_key($request->filter, array_flip(['id', 'type']))) : []), [
                AllowedFilter::exact('id'),
                AllowedFilter::exact('type'),
            ]));

        if ($request->is('*/trash')) {
            $query->onlyTrashed();
        }

        $view['items'] = $query->paginate($request->per_page ?? 50);

        return view('agenciafmd/redirects::index', $view);
    }

    public function create(Redirect $redirect): View
    {
        $view['model'] = $redirect;

        return view('agenciafmd/redirects::form', $view);
    }

    public function store(RedirectRequest $request): RedirectResponse
    {
        if (Redirect::create($request->validated())) {
            flash('Item inserido com sucesso.', 'success');
        } else {
            flash('Falha no cadastro.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.redirects.index');
    }

    public function show(Redirect $redirect): View
    {
        $view['model'] = $redirect;

        return view('agenciafmd/redirects::form', $view);
    }

    public function edit(Redirect $redirect): View
    {
        $view['model'] = $redirect;

        return view('agenciafmd/redirects::form', $view);
    }

    public function update(Redirect $redirect, RedirectRequest $request): RedirectResponse
    {
        if ($redirect->update($request->validated())) {
            flash('Item atualizado com sucesso.', 'success');
        } else {
            flash('Falha na atualização.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.redirects.index');
    }

    public function destroy(Redirect $redirect): RedirectResponse
    {
        if ($redirect->delete()) {
            flash('Item removido com sucesso.', 'success');
        } else {
            flash('Falha na remoção.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.redirects.index');
    }

    public function restore(int $id): RedirectResponse
    {
        $redirect = Redirect::onlyTrashed()
            ->find($id);

        if (!$redirect) {
            flash('Item já restaurado.', 'danger');
        } elseif ($redirect->restore()) {
            flash('Item restaurado com sucesso.', 'success');
        } else {
            flash('Falha na restauração.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.redirects.index');
    }

    public function batchDestroy(Request $request): RedirectResponse
    {
        $redirect = Redirect::query()
            ->whereIn('id', Arr::wrap($request->id))
            ->get()->each->delete();

        if ($redirect->count()) {
            flash('Item removido com sucesso.', 'success');
        } else {
            flash('Falha na remoção.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.redirects.index');
    }

    public function batchRestore(Request $request): RedirectResponse
    {
        $redirect = Redirect::query()
            ->whereIn('id', Arr::wrap($request->id))
            ->get()->each->restore();

        if ($redirect->count()) {
            flash('Item restaurado com sucesso.', 'success');
        } else {
            flash('Falha na restauração.', 'danger');
        }

        return ($url = session()->get('backUrl')) ? redirect($url) : redirect()->route('admix.redirects.index');
    }
}
