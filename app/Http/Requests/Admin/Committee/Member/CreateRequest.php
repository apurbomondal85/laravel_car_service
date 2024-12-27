<?php

namespace App\Http\Requests\Admin\Committee\Member;

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
            'user_id'     => ['required', 'integer', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'vote'        => ['nullable', 'integer'],
            'role_id'     => ['nullable', 'integer'],
            'image'       => ['required', 'file', 'max:500','mimes:jpeg,jpg,png,gif'],
        ];
    }
}
