<?php

namespace App\Http\Requests\Public\FreeQuote;

use Illuminate\Foundation\Http\FormRequest;

class JobPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'mobile'  => 'required|string|max:20',
            'email'   => 'required|email|max:255',
            'details' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max'      => 'The name field cannot exceed 255 characters.',
        ];
    }
}
