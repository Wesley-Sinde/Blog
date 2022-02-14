<?php

namespace App\Http\Requests\Library\BookMaster;

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
//'title'                => 'required | unique:staff_designations,title,'.$this->request->get('id'),
    public function rules()
    {
        return [
            //'code'                 => 'required | max:25 | unique:book_masters,code,'.$this->request->get('id'),
            'title'                 => 'required | max:100 | unique:book_masters,title,'.$this->request->get('id'),
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
