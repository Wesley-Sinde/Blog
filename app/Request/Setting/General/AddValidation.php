<?php

/**
 * Created by PhpStorm.
 * User: Umesh Kumar Yadav
 * Date: 7/25/2017
 * Time: 7:12 AM
 */
namespace App\Http\Requests\Setting\General;

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
            'institute'         =>  'required',
            'address'           =>  'required',
            'phone'             =>  'required',
            'email'             =>  'required',
            'time_zones_id'     =>  'exists:time_zones,id',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
