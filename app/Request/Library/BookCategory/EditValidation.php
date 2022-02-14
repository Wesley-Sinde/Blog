<?php

namespace App\Http\Requests\Library\BookCategory;

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
            'title'                => 'required | max:100 | unique:book_categories,title,'.$this->request->get('id'),
        ];

    }

   /* public function messages()
    {
        return [
            'title.required'            => 'Book Category Required',
            'title.unique'              => 'Please Enter Unique Book Category.',
        ];
    }*/
}
