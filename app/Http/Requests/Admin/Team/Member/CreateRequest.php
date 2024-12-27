<?php

namespace App\Http\Requests\Admin\Team\Member;

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
            'user_id'          => ['required', 'integer', 'exists:users,id'],
            'team_designation' => ['required', 'string'],
            'member_note'      => ['nullable', 'string'],
        ];
    }
}
