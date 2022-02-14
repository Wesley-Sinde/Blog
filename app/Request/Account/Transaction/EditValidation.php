<?php

namespace App\Http\Requests\Account\Transaction;

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
            'date'                => 'required',
            'tr_head'             => 'required',
            'account_type'        => 'required',
            'amount'              => 'required',

        ];

    }

     public function messages()
    {
        return [
            'date.required'                => 'Date is Required.',
            'tr_head.required'             => 'Ledger/Transaction Head Required.',
            'account_type.required'        => 'Account Type Dr/Cr Required.',
            'amount.required'              => 'Transaction Amount Required.',
        ];
    }
}
