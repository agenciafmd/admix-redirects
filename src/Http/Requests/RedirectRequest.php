<?php

namespace Agenciafmd\Redirects\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RedirectRequest extends FormRequest
{
    protected $errorBag = 'admix';

    public function rules(): array
    {
        return [
            'is_active' => [
                'required',
                'boolean',
            ],
            'from' => [
                'required',
            ],
            'to' => [
                'required',
                'url',
            ],
            'type' => [
                'required',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'is_active' => 'ativo',
            'from' => 'de',
            'to' => 'para',
            'type' => 'tipo',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
