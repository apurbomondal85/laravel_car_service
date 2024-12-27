<?php

namespace App\Http\Requests\Admin\Club\Member;

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
            'user_id'     => ['required', 'integer'],
            'user_type'   => ['required', 'string'],
            'designation' => ['nullable', 'string'],
            'note'        => ['nullable', 'string', 'max:2000'],
        ];
    }
}
