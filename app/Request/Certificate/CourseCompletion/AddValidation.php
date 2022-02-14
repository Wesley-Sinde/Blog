<?php

namespace App\Http\Requests\Certificate\CourseCompletion;

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
            'students_id'           => 'required | unique:course_completion_certificates,students_id',
            'date_of_issue'         => 'required',
            'course'                => 'required',
            'period'                => 'required',
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

