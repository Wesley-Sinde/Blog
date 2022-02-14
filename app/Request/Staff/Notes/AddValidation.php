<?php

namespace App\Http\Requests\Staff\Notes;

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
            'reg_no'                => 'required | exists:staff,reg_no',
            'subject'               => 'required | max:100',
            'note'                  => 'required',
        ];

    }

    public function messages()
    {
        return [
            'reg_no.required'                => 'Reg. No. Required.',
            'subject.required'              => 'Subject Required.',
            'note.required'              => 'Notes Required.',
        ];
    }
}
