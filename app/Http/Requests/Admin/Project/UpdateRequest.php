<?php

namespace App\Http\Requests\Admin\Project;

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
            'category'          => ['nullable', 'string', 'max:255'],
            'name'              => ['required', 'string', 'max:255'],
            'url'               => ['nullable', 'url', 'max:255'],
            'date'              => ['nullable', 'date'],
            'is_featured'       => ['nullable'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'description'       => ['nullable', 'string'],
            'featured_image'    => ['nullable', 'file', 'max:500','mimes:jpeg,jpg,png,gif'],
        ];
    }
}
