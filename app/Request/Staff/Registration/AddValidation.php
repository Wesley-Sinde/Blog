<?php

namespace App\Http\Requests\Staff\Registration;

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
            'reg_no'                => 'required  | unique:staff,reg_no',
            'join_date'              => 'required',
            'designation'           => 'required',
            'first_name'            => 'required',
            'last_name'             => 'required',
            'date_of_birth'         => 'required',
            'gender'                => 'required',
            'qualification'         => 'required',
            'mobile_1'              => 'required',
            'main_image'           => 'mimes:jpeg,bmp,png',
        ];

    }

    /*public function messages()
    {
        return [
            'reg_no.required'                => 'Reg. No. Required.',
            'reg_no.unique'                  => 'Enter Unique Reg.No.',
            'join_date.required'              => 'Join Date Required.',
            'designation.required'           => 'Designation Required.',
            'first_name.required'            => 'First Name Required.',
            'last_name.required'             => 'Last Name Required.',
            'date_of_birth.required'         => 'DOB Required.',
            'gender.required'                => 'Gender Required.',
            'email.required'                 => 'Email Required.',
            'email.unique'                   => 'Enter Unique Email.',
            'mobile_1.required'              => 'Mobile 1 Required.',
            'qualification.required'         => 'Qualification Required.',
            'main_image.mimes'              =>'Please Upload Valid Staff Image Format. Like:jpeg, png, bmp.',
        ];
    }*/
}
