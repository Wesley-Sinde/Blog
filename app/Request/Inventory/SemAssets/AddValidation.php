<?php

/**
 * Created by PhpStorm.
 * User: Umesh Kumar Yadav
 * Date: 7/25/2017
 * Time: 7:12 AM
 */
namespace App\Http\Requests\Inventory\SemAssets;

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
    //'semesters_id', 'assets_id', 'quantity',
    public function rules()
    {
        return [
            'semester_select'       => 'required',
            'assets'       => 'required',
            'quantity'       => 'required'
        ];
    }

    public function messages()
    {
        return [
            'semester_select.required'    => 'Semester/Section is Required',
            'assets.required'       => 'Assets is Required',
            'quantity.required'        => 'Quantity is Required'
        ];
    }
}
