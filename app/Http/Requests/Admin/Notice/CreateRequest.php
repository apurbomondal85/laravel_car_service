<?php

namespace App\Http\Requests\Admin\Notice;

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
            'notice_type'       => ['required', 'string', 'max:255'],
            'title'             => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:255'],
            'description'       => ['required', 'string'],

            'featured_image' => ['required', 'file', 'max:500','mimes:jpeg,jpg,png,gif,webp'],
        ];
    }
}
