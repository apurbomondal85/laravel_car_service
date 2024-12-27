<?php

namespace App\Http\Requests\Admin\Product;

use App\Library\Enum;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'sku' => ['required', 'string', 'max:100', 'unique:products,sku,' . $this->id],
            'image_url' => ['nullable', 'url'],
            'status' => ['required', array_keys(Enum::getProductStatus())],
            'category_id' => ['required'],
            'brand_id' => ['required'],
        ];
    }
}
