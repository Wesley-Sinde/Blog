<?php

namespace App\Http\Requests\Assignment;

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
            'semesters_id'          => 'required',
            'subjects_id'           => 'required',
            'publish_date'          => 'required',
            'title'                 => 'required | max:100 | unique:assignments,title,'.$this->request->get('id'),
            'description'           => 'required',
            'attach_file'         => 'max:10000|mimes:pdf,doc,docx,ppt,xls,xlsx,jpeg,bmp,png',
        ];

    }

    public function messages()
    {
        return [
            'semesters_id.required'              => 'Semester/Sec.Required',
            'subjects_id.required'              => 'Subject Required',
        ];


    }
}
