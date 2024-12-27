<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->country_code && $this->user['mobile']) {
            $mobile = $this->country_code . '-' . $this->user['mobile'];

            $this->merge(['mobile' => $mobile]);
        }
    }

    public function rules()
    {
        return [
            'user.f_name' => ['required', 'string', 'max:255'],
            'user.m_name' => ['nullable', 'string', 'max:255'],
            'user.l_name' => ['required', 'string', 'max:255'],
            'user.email'  => ['required', 'string', 'max:255'],
            'mobile'      => ['nullable', 'string', 'max:15'],
            'user.dob'    => ['nullable', 'string', 'max:255'],
            'title'       => ['nullable', 'string', 'max:255'],
            'gender'      => ['required', 'string', 'max:255'],
            'pro_noun'    => ['nullable', 'string', 'max:255'],
            'user.avatar' => ['nullable', 'file', 'max:500', 'mimes:jpeg,jpg,png,gif'],
            'role_id'     => ['required']
        ];
    }
}
