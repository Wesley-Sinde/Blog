<?php

namespace App\Http\Requests\Account\TransactionHead;

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
            'tr_head'                => 'required | max:100 | unique:transaction_heads,tr_head,'.$this->request->get('id'),
            'acc_id'                   => 'required',

        ];

    }

     public function messages()
    {
        return [
            'tr_head.required'            => 'Transaction Ledger Name Required',
            'acc_id.required'              => 'Ledger/Transaction Group Required. ',
        ];
    }
}
