<?php

namespace App\Http\Requests\Customer\Document;

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
    //'member_id',  'title', 'file',
    public function rules()
    {
        return [
            'reg_no'                => 'required | exists:customers,reg_no',
            'title'                 => 'required',
            'document_file'         => 'required|max:10000|mimes:pdf,doc,docx,ppt,xls,xlsx,jpeg,bmp,png',
        ];

    }

    public function messages()
    {
        return [
            /*'reg_no.required'               => 'Reg. No. Required.',*/

        ];


    }

}
