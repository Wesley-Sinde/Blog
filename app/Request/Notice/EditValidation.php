<?php

/**
 * Created by PhpStorm.
 * User: Umesh Kumar Yadav
 * Date: 7/25/2017
 * Time: 7:12 AM
 */
namespace App\Http\Requests\Notice;

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
             'title'             => 'required | max:100 | unique:notices,title,'.$this->request->get('id'),
             'message'           => 'required',
             'publish_date'      => 'required',
             'end_date'          => 'required',
             'role'              => 'required'
         ];
    }

    public function messages()
    {
        return [
            'title.unique' => 'Create Unique Title.',
            'role.required' => 'Message Display Groups required.',
        ];
    }
}
