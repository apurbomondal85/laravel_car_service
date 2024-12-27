<?php

namespace App\Http\Requests\Admin\Business;

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
            'id'             => ['required', 'integer', 'exists:businesses,id'],
            'business_type'  => ['required', 'string', 'max:255'],
            'title'          => ['required', 'string', 'max:255'],
            'user_id'        => ['nullable', 'integer', 'exists:users,id'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'url'            => ['nullable', 'string', 'max:255'],
            'description'    => ['required', 'string'],
            'start_date'     => ['required', 'string', 'max:255'],
            'end_date'       => ['required', 'string', 'max:255'],
            'amount'         => ['required', 'numeric'],
            'ranking'        => ['nullable', 'integer', 'max:255'],
            'note'           => ['nullable', 'string'],

            'business_logo' => ['nullable', 'file', 'max:500','mimes:jpeg,jpg,png,gif'],
        ];
    }
}
