<?php

namespace App\Http\Requests\Admin\Committee;

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
            'name' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:255'],
        ];
    }
}
