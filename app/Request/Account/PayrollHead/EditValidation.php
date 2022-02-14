<?php

namespace App\Http\Requests\Account\PayrollHead;

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
            'title'                => 'required | max:100 | unique:payroll_heads,title,'.$this->request->get('id'),

        ];

    }

    /*custom message
     * public function messages()
    {
        return [
            'title.required'            => 'Title Required',
            'title.unique'              => 'Please Enter Unique Title.',
        ];
    }*/
}
