<?php

namespace App\Http\Requests\Public\Member;

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
            'f_name'    => ['required', 'string', 'max:25'],
            'm_name'    => ['nullable', 'string', 'max:25'],
            'l_name'    => ['required', 'string', 'max:25'],
            'nick_name' => ['required', 'string', 'max:25'],
            'email'     => ['required', 'string', 'max:255'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],

            'mobile'         => ['required', 'string', 'max:25'],
            'dob'            => ['nullable', 'string', 'max:255'],
            'address_line_1' => ['required', 'string', 'max:255'],
            'suburb'         => ['nullable', 'string', 'max:255'],
            'city'           => ['required', 'string', 'max:255'],
            'state'          => ['nullable', 'string', 'max:255'],
            'post_code'      => ['required', 'string', 'max:10'],
            'country'        => ['required', 'string', 'max:30'],
            'about_me'       => ['nullable', 'string', 'max:255'],
            'gender'         => ['required', 'string', 'max:255'],

            'profile_image' => ['nullable', 'file', 'max:500', 'mimes:jpeg,jpg,png,gif'],
            'photo_id'      => ['nullable', 'file', 'max:500', 'mimes:jpeg,jpg,png,gif,pdf'],
            'documents'     => ['nullable', 'file', 'max:500', 'mimes:jpeg,jpg,png,gif,pdf'],
        ];
    }
}
