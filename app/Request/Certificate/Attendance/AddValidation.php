<?php

namespace App\Http\Requests\Certificate\Attendance;

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
            'students_id'                   => 'required | unique:attendance_certificates,students_id',
            'date_of_issue'                 => 'required',
            'year_of_study'                 => 'required | max:9',
            'percentage_of_attendance'      => 'required | max:3',
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
