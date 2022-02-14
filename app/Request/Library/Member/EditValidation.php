<?php

namespace App\Http\Requests\Library\Member;

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
            'reg_no'                => 'required | max:15',
            'user_type'             => 'required',
            'status'                => 'required',
        ];

    }


}
