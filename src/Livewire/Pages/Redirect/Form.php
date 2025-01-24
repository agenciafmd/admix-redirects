<?php

namespace Agenciafmd\Redirects\Livewire\Pages\Redirect;

use Agenciafmd\Redirects\Models\Redirect;
use Livewire\Attributes\Validate;
use Livewire\Form as LivewireForm;

class Form extends LivewireForm
{
    public Redirect $redirect;

    #[Validate]
    public bool $is_active = true;

    #[Validate]
    public string $name = '';

    #[Validate]
    public string $from = '';

    #[Validate]
    public string $to = '';

    #[Validate]
    public string $type = '';

    public function setModel(Redirect $redirect): void
    {
        $this->redirect = $redirect;
        if ($redirect->exists) {
            $this->is_active = $redirect->is_active;
            $this->name = $redirect->name;
            $this->type = $redirect->type;
            $this->from = $redirect->from;
            $this->to = $redirect->to;
        }
    }

    public function rules(): array
    {
        return [
            'is_active' => [
                'boolean',
            ],
            'name' => [
                'required',
            ],
            'type' => [
                'required',
            ],
            'from' => [
                'required',
            ],
            'to' => [
                'required',
            ],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'is_active' => __('admix-redirects::fields.is_active'),
            'name' => __('admix-redirects::fields.name'),
            'type' => __('admix-redirects::fields.type'),
            'from' => __('admix-redirects::fields.from'),
            'to' => __('admix-redirects::fields.to'),
        ];
    }

    public function save(): bool
    {
        $this->validate(rules: $this->rules(), attributes: $this->validationAttributes());
        $this->redirect->fill($this->except('redirect'));

        return $this->redirect->save();
    }
}
