<?php

namespace App\Http\Requests\Admin\ClubCommittee;

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
            'club_id'     => ['required', 'integer'],
            'user_id'     => ['required', 'integer'],
            'user_type'   => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'note'        => ['nullable', 'string', 'max:255'],
        ];
    }
}
