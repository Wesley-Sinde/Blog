<?php

/**
 * Created by PhpStorm.
 * User: Umesh Kumar Yadav
 * Date: 7/25/2017
 * Time: 7:12 AM
 */
namespace App\Http\Requests\Hostel\Hostel;

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
             'name'              => 'required | max:50 | unique:hostels,name,'.$this->request->get('id'),
             'address'           => 'required | max:50',
             'contact_detail'    => 'required',
             'warden'            => 'required | max:50',
             'type'              => 'required | max:50',
             'status'            => 'required | in:active,in-acctive',
         ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Hostels already exist',
        ];
    }
}
