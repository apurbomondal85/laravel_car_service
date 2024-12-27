<?php

namespace App\Http\Requests\Admin\Career;

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
            'job_type'          => ['nullable', 'string', 'max:255'],
            'title'             => ['required', 'string', 'max:255'],
            'company_name'      => ['required', 'string', 'max:255'],
            'deadline'          => ['required', 'string', 'max:255'],
            'location'          => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'description'       => ['nullable', 'string'],
        ];
    }
}
