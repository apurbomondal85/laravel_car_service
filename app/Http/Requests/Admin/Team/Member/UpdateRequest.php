<?php

namespace App\Http\Requests\Admin\Team\Member;

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
            'team_designation' => ['required', 'string'],
            'member_note'      => ['nullable', 'string'],
        ];
    }
}
