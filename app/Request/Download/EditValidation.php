<?php

namespace App\Http\Requests\Download;

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
            'title'                 => 'required | unique:downloads,title,'.decrypt($this->request->get('id')),
        ];

    }

    /*public function messages()
    {
        return [
            'semester_select.int'               => 'Please Select Target Semester/Section.',
        ];


    }*/
}
