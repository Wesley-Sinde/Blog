<?php

/**
 * Created by PhpStorm.
 * User: Umesh Kumar Yadav
 * Date: 7/25/2017
 * Time: 7:12 AM
 */
namespace App\Http\Requests\Front\PostalExchange;

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
            'type'         => 'required',
            'date'         => 'required',
            'ref_no'       => 'required | max:25 | unique:postal_exchanges',
            'subject'      => 'required',
            'to'            => 'required',
            'from'          => 'required',
            'file'   => 'mimes:pdf,doc,docx,ppt,xls,xlsx,jpeg,bmp,png',

        ];
    }

   /* public function messages()
    {
        return [
            'title.unique' => 'This Time Already Register',
        ];
    }*/
}
