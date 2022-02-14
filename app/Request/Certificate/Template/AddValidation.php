<?php

namespace App\Http\Requests\Certificate\Template;

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
            'certificate'              => 'required | unique:certificate_templates,certificate',
            'template'                 => 'required',
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
