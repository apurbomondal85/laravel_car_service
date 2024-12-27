<?php

namespace App\Http\Requests\Admin\ClientPartner;

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
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'is_featured' => ['nullable'],
            'logo'        => ['nullable', 'file', 'max:500','mimes:jpeg,jpg,png,gif'],
        ];
    }
}
