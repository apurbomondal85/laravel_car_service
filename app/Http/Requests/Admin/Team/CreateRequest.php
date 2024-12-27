<?php

namespace App\Http\Requests\Admin\Team;

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
            'name'              => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:10000'],
        ];
    }
}
