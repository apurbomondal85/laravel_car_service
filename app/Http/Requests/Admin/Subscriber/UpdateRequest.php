<?php

namespace App\Http\Requests\Admin\Subscriber;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->country_code && $this->mobile) {
            $mobile = $this->country_code . '-' . $this->mobile;

            $this->merge(['mobile' => $mobile]);
        }
    }

    public function rules()
    {
        return [
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'string', 'max:255'],
            'mobile' => ['nullable', 'string', 'max:15'],
        ];
    }
}
