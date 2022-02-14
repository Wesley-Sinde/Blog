<?php

namespace App\Http\Requests\Account\FeeHead;

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
            'fee_head_title'                => 'required | max:100 | unique:fee_heads,fee_head_title,'.$this->request->get('id'),
        ];

    }

    public function messages()
    {
        return [
            'fee_head_title.required'            => 'Fee Title Required',
            'fee_head_title.unique'              => 'Please Enter Unique Fee Title.',
        ];
    }
}
