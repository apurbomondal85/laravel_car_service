<?php

namespace App\Http\Requests\Admin\News;

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
            'title'          => ['required', 'string', 'max:255'],
            'description'    => ['required', 'string'],
            'link'           => ['nullable', 'url', 'max:255'],
            'is_featured'    => ['nullable', 'boolean'],
            'featured_image' => ['nullable', 'file', 'max:500','mimes:jpeg,jpg,png,gif'],
        ];
    }
}
