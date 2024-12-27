<?php

namespace App\Http\Requests\Admin\Club;

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
            'description' => ['required', 'string'],
            'image'       => ['nullable', 'file', 'max:1000','mimes:jpeg,jpg,png,gif'],
            'cover_image' => ['nullable', 'file', 'max:1000','mimes:jpeg,jpg,png,gif'],
        ];
    }
}
