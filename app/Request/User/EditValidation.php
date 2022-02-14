<?php

namespace App\Http\Requests\User;

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
            'name'              => 'required',
            'email'             => 'required | unique:users,email,'.$this->request->get('id'),
        ];
    }

    public function messages()
    {
        return [
            'name.required'              => 'Please, Add User Name.',
            'email.required'             => 'Please, Add Email.',
            'email.unique'               => 'Please, Add Unique Email.',
        ];
    }
}
