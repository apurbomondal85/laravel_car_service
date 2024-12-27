<?php

namespace App\Http\Requests\Admin\Gallery;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category'    => ['nullable', 'string', 'max:255'],
            'name'        => ['required', 'string', 'max:255'],
            'is_featured' => ['nullable'],
            'description' => ['nullable', 'string'],
        ];
    }
}
