<?php

/**
 * Created by PhpStorm.
 * User: Umesh Kumar Yadav
 * Date: 7/25/2017
 * Time: 7:12 AM
 */
namespace App\Http\Requests\Transport\Vehicle;

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
             'number' => 'required | max:25 | unique:vehicles,number,'.$this->request->get('id'),
             'type' => 'required | max:25',
             'model' => 'required | max:25'
         ];
    }

    /*public function messages()
    {
        return [
            'number.required' => 'Please, Add Vehicles Number.',
            'number.unique' => 'This Vehicle Already Register',
        ];
    }*/
}
