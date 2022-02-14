<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class AddValidation extends FormRequest
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
     * @return array
     */
    // 'code', 'name', 'category_id', 'sub_category_id', 'product_image', 'cost_price', 'sale_price', 'stock', 'description','status'
    public function rules()
    {
        return [
            'code'                          => 'max:15 | unique:products,code',
            'name'                          => 'required | max:100',
            'product_image'                 => 'mimes:jpeg,bmp,png',
        ];

    }

    public function messages()
    {
        return [


        ];
    }
}
