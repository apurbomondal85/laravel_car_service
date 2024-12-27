<?php

namespace App\Http\Requests\Admin\Gallery;

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
            'category'    => ['nullable', 'string', 'max:255'],
            'name'        => ['required', 'string', 'max:255'],
            'is_featured' => ['nullable'],
            'description' => ['nullable', 'string'],

            'file_name.*' => ['nullable', 'required_with:images'],
            'images.*'    => ['nullable', 'file', 'max:500', 'mimes:jpeg,jpg,png,gif', 'required_with:file_name'],
        ];
    }
}
