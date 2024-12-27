<?php

namespace App\Http\Requests\Admin\Transaction;

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
            'member_id'      => ['required', 'integer'],
            'transaction_id' => ['nullable', 'string', 'max:255'],
            'amount'         => ['required', 'numeric'],
            'payment_method' => ['required', 'string', 'max:255'],
            'note'           => ['nullable', 'string', 'max:255'],
        ];
    }
}
