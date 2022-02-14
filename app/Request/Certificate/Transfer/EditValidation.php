<?php

namespace App\Http\Requests\Certificate\Transfer;

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
            'students_id'           => 'required | unique:transfer_certificates,students_id,'.$this->request->get('id'),
            'date_of_issue'         => 'required',
            'date_of_leaving'       => 'required',
            'tc_num'                => 'required | unique:transfer_certificates,tc_num,'.$this->request->get('id'),
            'leaving_time_class'    => 'required',
            'qualified_to_promote'  => 'required',
            'paid_fee_status'       => 'required',
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
