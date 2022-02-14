<?php

/**
 * Created by PhpStorm.
 * User: Umesh Kumar Yadav
 * Date: 7/25/2017
 * Time: 7:12 AM
 */
namespace App\Http\Requests\Front\Visitor;

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
            'purpose'         => 'required',
            'date'              => 'required',
            'in_time'           => 'required',
            'name'              => 'required',
            'file'              => 'mimes:pdf,doc,docx,ppt,xls,xlsx,jpeg,bmp,png',

        ];
    }

    public function messages()
    {
        return [
            'purpose.required' => 'Visitor Visit Purpose Required.',
        ];
    }
}
