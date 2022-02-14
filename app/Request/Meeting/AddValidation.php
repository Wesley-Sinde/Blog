<?php

namespace App\Http\Requests\Meeting;

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
            'semesters_id'          => 'required',
            'subjects_id'           => 'required',
            'topic'                 => 'required',
            'start_time'            => 'required',
            'duration'              => 'required',
        ];

    }

    public function messages()
    {
        return [
            'semesters_id.required'         => 'Semester/Sec.Required',
            'subjects_id.required'          => 'Subject Required',
        ];


    }

}
