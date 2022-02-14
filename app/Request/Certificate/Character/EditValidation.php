<?php

namespace App\Http\Requests\Certificate\Character;

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
            'students_id'           => 'required | unique:character_certificates,students_id,'.$this->request->get('id'),
            'date_of_issue'         => 'required',
            'cc_num'                => 'required | unique:character_certificates,cc_num,'.$this->request->get('id'),
            'year'                  => 'required',
            'character'             => 'required',
        ];

    }

    public function messages()
    {
        return [
            'students_id.required'     => 'Student Information Required',
            'students_id.unique'       => 'Certificate already created for this Student. Please Find and Edit Certificate',
        ];
    }
}
