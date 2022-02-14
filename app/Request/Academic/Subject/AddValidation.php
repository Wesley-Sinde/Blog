<?php

/**
 * Created by PhpStorm.
 * User: Umesh Kumar Yadav
 * Date: 7/25/2017
 * Time: 7:12 AM
 */
namespace App\Http\Requests\Academic\Subject;

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
            'title'             => 'required | max:100',
            'code'              => 'required | max:15 | unique:subjects,code',
            'description'       => 'max:100',
        ];
    }

    public function messages()
    {
        return [
            'code.unique' => 'This Subject Code Already Register',
        ];
    }
}
