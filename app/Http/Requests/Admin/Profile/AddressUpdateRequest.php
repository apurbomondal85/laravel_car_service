<?php

namespace App\Http\Requests\Admin\Profile;

use Illuminate\Foundation\Http\FormRequest;

class AddressUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'address'   => ['required', 'string', 'max:255'],
            'suburb'    => ['nullable', 'string', 'max:255'],
            'city'      => ['required', 'string', 'max:255'],
            'state'     => ['nullable', 'string', 'max:255'],
            'country'   => ['required', 'string', 'max:255'],
            'post_code' => ['required', 'string', 'max:10'],
        ];
    }
}
