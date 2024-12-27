<?php

namespace App\Http\Requests\Admin\Faq;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'question'  => ['required', 'string', 'max:255'],
            'answer'    => ['required', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
