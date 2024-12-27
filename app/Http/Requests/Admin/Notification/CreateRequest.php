<?php

namespace App\Http\Requests\Admin\Notification;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
        return [
            'user_id'      => ['nullable', 'integer', 'max:55'],
            'type'         => ['required', 'string', 'max:255'],
            'is_for_emp'   => ['nullable', 'boolean'],
            'is_for_donor' => ['nullable', 'boolean'],
            'is_for_org'   => ['nullable', 'boolean'],
            'message'      => ['required', 'string', 'max:255'],
        ];
    }
}
