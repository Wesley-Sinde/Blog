<?php

namespace App\Http\Requests\Account\Bank;

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
            'bank_name'              => 'required | max:100',
            'ac_name'                => 'required | max:100',
            'ac_number'              => 'required | max:50 | unique:banks,ac_number',
            'branch'                 => 'required | max:50',
        ];

    }

    public function messages()
    {
        return [
            'bank_name.required'              => 'Bank Name Required',
            'ac_name.required'                => 'Account Name Required',
            'ac_number.required'              => 'Account Number Required',
            'ac_number.unique'                => 'Need Unique Account Number',
            'branch.required'                 => 'Branch Required',

        ];


    }

}
