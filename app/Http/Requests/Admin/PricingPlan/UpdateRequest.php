<?php

namespace App\Http\Requests\Admin\PricingPlan;

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
            'name'        => ['required', 'string', 'max:255'],
            'price'       => ['required', 'numeric'],
            'is_active'   => ['nullable'],
            'description' => ['nullable'],
        ];
    }
}
