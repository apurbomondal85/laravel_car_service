<?php

namespace App\Http\Requests\Public\Member;

use Illuminate\Foundation\Http\FormRequest;

class CheckMembership extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // dd($this->all());
        return [
            'f_name'    => ['nullable', 'required_if:membershipcheck,1', 'string', 'max:255'],
            'l_name'    => ['nullable', 'required_if:membershipcheck,1', 'string'],
            'mobile'    => ['nullable', 'required_if:membershipcheck,1', 'string', 'max:255'],
            'email'     => ['nullable', 'required_if:membershipcheck,2', 'string', 'max:255'],
            'member_id' => ['nullable', 'required_if:membershipcheck,3', 'string', 'max:255'],

        ];
    }
}
