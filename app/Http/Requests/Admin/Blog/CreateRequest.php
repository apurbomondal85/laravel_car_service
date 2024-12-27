<?php

namespace App\Http\Requests\Admin\Blog;

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
            'title'             => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:255'],
            'description'       => ['required', 'string'],
            'category'          => ['required', 'string'],
            'tags'              => ['nullable', 'array'],
            'featured_image'    => ['required', 'file','mimes:jpeg,jpg,png,gif'],
        ];
    }
}
