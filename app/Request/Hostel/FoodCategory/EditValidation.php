<?php

/**
 * Created by PhpStorm.
 * User: Umesh Kumar Yadav
 * Date: 7/25/2017
 * Time: 7:12 AM
 */
namespace App\Http\Requests\Hostel\FoodCategory;

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
             'title' => 'required | max:50 | unique:food_categories,title,'.$this->request->get('id'),
         ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please, Add Category.',
            'title.unique' => 'This Category Already Register',
        ];
    }
}
