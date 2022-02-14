<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Account\Transaction;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Account\Transaction\AddValidation;
use App\Http\Requests\Account\Transaction\EditValidation;
use App\Models\Transaction;
use App\Models\TransactionHead;
use Illuminate\Http\Request;
use URL;
class TransferController extends CollegeBaseController
{
    protected $base_route = 'account.transfer';
    protected $view_path = 'account.transaction.transfer';
    protected $panel = 'Acc To Acc Transfer';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function actransfer(Request $request)
    {
        $data = [];
        $head = TransactionHead::where('status',1)->pluck('tr_head','id')->toArray();

        $data['th'] =  array_prepend($head,'Select Ledger','0');

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function transferstore(Request $request)
    {
        if ($request->tr_head_source !== $request->tr_head_target) {

            $data1 = [
                'date'          => $request->date,
                'tr_head_id' =>  $request->tr_head_target,
                'dr_amount' => $request->amount,
                'description' => $request->description,
                'created_by' => auth()->user()->id
            ];


            $data2 = [
                'date'          => $request->date,
                'tr_head_id' =>  $request->tr_head_source,
                'cr_amount' => $request->amount,
                'description' => $request->description,
                'created_by' => auth()->user()->id
            ];

            Transaction::create($data1);
            Transaction::create($data2);

            $request->session()->flash($this->message_success, $this->panel . ' Add Successfully.');
        } else {
            $request->session()->flash($this->message_danger, 'Err. Source and Target Account are same, choose different Account.');
        }


        if($request->add_transaction_another) {
            $head = TransactionHead::where('status',1)->pluck('tr_head','id')->toArray();
            $data['th'] =  array_prepend($head,'Select Ledger','0');

            return back();
        }else{
            return redirect()->route($this->base_route);
        }

    }

}
