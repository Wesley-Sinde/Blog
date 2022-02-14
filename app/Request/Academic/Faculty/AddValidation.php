<?php

/**
 * Created by PhpStorm.
 * User: Umesh Kumar Yadav
 * Date: 7/25/2017
 * Time: 7:12 AM
 */
namespace App\Http\Requests\Academic\Faculty;

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
            'faculty'       => 'required | max:100 | unique:faculties,faculty',
            'faculty_code'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'faculty.required' => 'Please, Add Faculty.',
            'faculty.unique' => 'The Faculty/Classalready exist. Please, edit or create new.',
        ];
    }
}
