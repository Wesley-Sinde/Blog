<?php

namespace App\Http\Requests\Customer\Document;

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
            'reg_no'                => 'required',
            'title'                 => 'required',
            'document_file'         => 'max:10000|mimes:pdf,doc,docx,ppt,xls,xlsx,jpeg,bmp,png',
        ];

    }

    public function messages()
    {
        return [
            /*'reg_no.required'               => 'Reg. No. Required.',*/

        ];


    }
}
