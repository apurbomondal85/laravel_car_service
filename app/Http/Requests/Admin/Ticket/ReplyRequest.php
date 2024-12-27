<?php

namespace App\Http\Requests\Admin\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // dd($this->all());
        return [
            'comment'    => ['required', 'string', 'max:555'],
            'attachment' => ['nullable','file', 'max:3000'],
        ];
    }
}
