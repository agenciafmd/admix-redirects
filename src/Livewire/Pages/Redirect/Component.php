<?php

namespace Agenciafmd\Redirects\Livewire\Pages\Redirect;

use Agenciafmd\Redirects\Models\Redirect;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Livewire\Component as LivewireComponent;
use Livewire\Features\SupportRedirects\Redirector;

class Component extends LivewireComponent
{
    use AuthorizesRequests;

    public Form $form;

    public Redirect $redirect;

    public array $sourceOptions;

    public function mount(Redirect $redirect): void
    {
        ($redirect->exists) ? $this->authorize('update', Redirect::class) : $this->authorize('create', Redirect::class);

        $this->redirect = $redirect;
        $this->form->setModel($redirect);
        $this->sourceOptions = $this->getSourceOptions();
    }

    public function submit(): null|Redirector|RedirectResponse
    {
        try {
            if ($this->form->save()) {
                flash(($this->redirect->exists) ? __('crud.success.save') : __('crud.success.store'), 'success');
            } else {
                flash(__('crud.error.save'), 'error');
            }

            return redirect()->to(session()->get('backUrl') ?: route('admix.redirects.index'));
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            $this->dispatch(event: 'toast', level: 'danger', message: $exception->getMessage());
        }

        return null;
    }

    public function render(): View
    {
        return view('admix-redirects::pages.redirect.form')
            ->extends('admix::internal')
            ->section('internal-content');
    }

    private function getSourceOptions(): array
    {
        return [
            'label' => '-',
            'value' => '',
        ];
    }
}
