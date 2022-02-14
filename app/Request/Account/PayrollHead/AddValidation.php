<?php

namespace App\Http\Requests\Account\PayrollHead;

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
            'title'                => 'required | max:100 | unique:payroll_heads,title',
        ];

    }
    /* custom message
    public function messages()
    {
        return [
            'tr_head.required'            => 'Fee Head Required',
            'tr_head.unique'              => 'Please Enter Unique Fee Head.',
        ];
    }*/
}
