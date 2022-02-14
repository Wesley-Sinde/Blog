<?php

namespace App\Http\Requests\Customer\Notes;

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
            'reg_no'                => 'required | exists:customers,reg_no',
            'subject'               => 'required | max:100',
            'note'                  => 'required',
        ];

    }

    public function messages()
    {
        return [

        ];
    }
}
