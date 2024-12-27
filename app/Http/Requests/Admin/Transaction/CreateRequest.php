<?php

namespace App\Http\Requests\Admin\Transaction;

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
            'user_id'       => ['required', 'integer'],
            'membership_id' => ['required'],
            'amount'        => ['required', 'numeric'],
            'note'          => ['nullable', 'string', 'max:255'],
        ];
    }
}
