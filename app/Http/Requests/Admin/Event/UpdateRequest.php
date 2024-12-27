<?php

namespace App\Http\Requests\Admin\Event;

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
            'event_type'        => ['required', 'string', 'max:255'],
            'title'             => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'description'       => ['required', 'string'],
            'start'             => ['required', 'date_format:Y-m-d H:i', 'before:end'],
            'end'               => ['required', 'date_format:Y-m-d H:i', 'after:start'],
            'featured_image'    => ['nullable', 'file', 'max:500','mimes:jpeg,jpg,png,gif,webp'],
        ];
    }
}
