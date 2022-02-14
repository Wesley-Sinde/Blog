<?php

namespace App\Http\Requests\Account\BankTransaction;

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
            'date'                  => 'required',
            'account_type'          => 'required',
            'banks_id'              => 'required',
            'deposit_id'            => 'required',
            'amount'                => 'required',

        ];

    }

    public function messages()
    {
        return [
            'date.required'                  => 'Date is Required.',
            'banks_id.required'              => 'Bank Name is Required.',
            'deposit_id.required'            => 'Deposit/Withdraw Voucher ID Required',
            'account_type.required'        => 'Account Type Dr/Cr Required.',
            'amount.required'              => 'Transaction Amount Required.',
        ];


    }
}
