<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class EditValidation extends FormRequest
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

    public function rules()
    {
        return [
            'code'                          => 'max:15 | unique:products,code,'.decrypt($this->request->get('id')),
            'name'                          => 'required | max:100',
            'product_main_image'            => 'mimes:jpeg,bmp,png',
        ];

    }

    public function messages()
    {
        return [

        ];
    }
}
