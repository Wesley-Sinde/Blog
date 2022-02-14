<?php

namespace App\Http\Requests\Front\Visitor\VisitorPurpose;

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
            'title'                => 'required | max:50 | unique:visitor_purposes,title,'.decrypt($this->request->get('id')),
        ];

    }

    public function messages()
    {
        return [
            'title.required'            => 'Designation Required',
            'title.unique'              => 'Please Enter Unique Designation.',
        ];
    }
}
