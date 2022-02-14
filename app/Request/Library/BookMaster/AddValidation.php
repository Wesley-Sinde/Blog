<?php

namespace App\Http\Requests\Library\BookMaster;

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
            'code'              => 'required | max:25 | unique:book_masters,code',
            'start'             => 'required | min:1',
            'end'               => 'required | min:1',
            'title'             => 'required | max:100 | unique:book_masters,title',
            'categories'        => 'required',
            'price'             => 'required',
        ];

    }

   /* public function messages()
    {
        return [
            'code.required'            => 'Book Code Required',
            'title.required'           => 'Book Name Required',
            'categories.required'      => 'Category Required',
            'quantity.required'        => 'Number of Book in Quantity Required',
        ];
    }*/
}
