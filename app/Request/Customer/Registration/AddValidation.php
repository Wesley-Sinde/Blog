<?php

namespace App\Http\Requests\Customer\Registration;

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
    public function rules()
    {
        return [
            'reg_no'                        => 'max:15 | unique:customers,reg_no',
            'name'                          => 'required | max:50',
            'address'                       => 'max:100',
            'tel'                           => 'max:15',
            'mobile_1'                      => 'max:15',
            'mobile_2'                      => 'max:15',
            'email'                         => 'max:100',
            'customer_main_image'           => 'mimes:jpeg,bmp,png',
        ];

    }

    public function messages()
    {
        return [


        ];
    }
}
