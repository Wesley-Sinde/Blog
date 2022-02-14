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
use App\Http\Requests\Account\TransactionHead\AddValidation;
use App\Http\Requests\Account\TransactionHead\EditValidation;
use App\Models\AccountCategory;
use App\Models\Transaction;
use App\Models\TransactionHead;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class TransactionHeadController extends CollegeBaseController
{
    protected $base_route = 'account.transaction-head';
    protected $view_path = 'account.transaction.head';
    protected $panel = 'Ledger Transaction';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];

        $data['tr_head'] = TransactionHead::select('id', 'tr_head', 'acc_id', 'status')
            ->where(function ($query) use ($request) {

                if ($request->has('tr_head') && $request->get('tr_head') != "") {
                    $query->where('tr_head', 'like', '%' . $request->tr_head . '%');
                    $this->filter_query['tr_head'] = $request->tr_head;
                }

                if ($request->has('acc_id') && $request->get('acc_id') > 0) {
                    $query->where('acc_id', '=', $request->acc_id);
                    $this->filter_query['acc_id'] = $request->acc_id;
                }

            })
            ->orderBy('tr_head','asc')->get();

        $aCat = AccountCategory::where('status',1)->pluck('ac_name','id')->toArray();
        $data['ac'] =  array_prepend($aCat,'Select Ledger Group','0');

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        $request->request->add(['created_by' => auth()->user()->id]);

        $trHead = TransactionHead::create($request->all());

        //Manage Opening Balance of Customer
        if($trHead && $request->amount > 0) {
            if ($request->get('account_type') == "dr_amt") {
                $drAmount = $request->amount;
                $crAmount = 0;
            } elseif ($request->get('account_type') == "cr_amt") {
                $drAmount = 0;
                $crAmount = $request->amount;
            } else {

            }
            $data = [
                'date' => Carbon::today(),
                'tr_head_id' => $trHead->id,
                'dr_amount' => $drAmount,
                'cr_amount' => $crAmount,
                'description' => 'Opening Balance',
                'created_by' => auth()->user()->id
            ];

            Transaction::create($data);
        }


        $request->session()->flash($this->message_success, $this->panel. ' Created Successfully.');
        return redirect()->route($this->base_route);
    }

    public function edit(Request $request, $id)
    {
        $data = [];
        if (!$data['row'] = TransactionHead::find($id))
            return parent::invalidRequest();

        $data['tr_head'] = TransactionHead::select('id', 'tr_head', 'acc_id', 'status')->orderBy('tr_head','asc')->get();

        $aCat = AccountCategory::where('status',1)->pluck('ac_name','id')->toArray();
        $data['ac'] =  array_prepend($aCat,'Select Ledger Group','0');

        $data['url'] = URL::current();
        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        if (!$row = TransactionHead::find($id)) return parent::invalidRequest();

        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $request->request->add(['slug' => $request->get('fee_head_title')]);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = TransactionHead::find($id)) return parent::invalidRequest();

        $row->delete();
        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

    public function bulkAction(Request $request)
    {
        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['active', 'in-active', 'delete'])) {

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    switch ($request->get('bulk_action')) {
                        case 'active':
                        case 'in-active':
                            $row = TransactionHead::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = TransactionHead::find($row_id);
                            $row->delete();
                            break;
                    }
                }

                if ($request->get('bulk_action') == 'active' || $request->get('bulk_action') == 'in-active')
                    $request->session()->flash($this->message_success, $request->get('bulk_action'). ' Action Successfully.');
                else
                    $request->session()->flash($this->message_success, 'Deleted successfully.');

                return redirect()->route($this->base_route);

            } else {
                $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
                return redirect()->route($this->base_route);
            }

        } else return parent::invalidRequest();

    }

    public function active(request $request, $id)
    {
        if (!$row = TransactionHead::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = TransactionHead::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function dateTransaction($id, $date)
    {
        $transaciton = Transaction::select('id','date', 'tr_head_id', 'dr_amount','cr_amount')
            ->where('date',$date)
            ->get();

        return $transaciton?$transaciton:0;
    }

    public function openingBalance($id, $date)
    {
        $data['transaction'] = Transaction::select('id','date', 'tr_head_id', 'dr_amount','cr_amount')
            ->where('tr_head_id',$id)
            ->where('date','<',$date)
            ->get();

        $trDr = $data['transaction']->sum('dr_amount');
        $trCr = $data['transaction']->sum('cr_amount');

        $oB = $trDr - $trCr;
        return $oB?$oB:0;
    }

    public function view(Request $request)
    {
        $id = $request->tr_head;
        $data = [];
        $data['row'] = [];
        $date = Carbon::now()->toDateString();
        if($request->all()){
            if($request->tr_head && $request->tr_start_date && $request->tr_end_date) {
                $data['print_head'] = $this->panel.' - DAILY';
                $data['table_head'] = Carbon::parse($request->tr_start_date)->format('Y-m-d').' TO '. Carbon::parse($request->tr_end_date)->format('Y-m-d');

                $openingBalance = $this->openingBalance($request->tr_head, $request->tr_start_date);
                $data['opening'] = $openingBalance;
                $data['row'] = TransactionHead::find($request->tr_head);

                if (!$data['row'])
                    return parent::invalidRequest();

                $transaction = $data['row']->tR()
                    ->where(function ($query) use ($request) {
                        if ($request->has('tr_start_date') && $request->has('tr_end_date')) {
                            $query->whereBetween('date', [$request->get('tr_start_date'), $request->get('tr_end_date')]);
                            $this->filter_query['tr_start_date'] = $request->get('tr_start_date');
                            $this->filter_query['tr_end_date'] = $request->get('tr_end_date');
                        }
                        elseif ($request->has('tr_start_date')) {
                            $query->where('date', '>=', $request->get('tr_start_date'));
                            $this->filter_query['tr_start_date'] = $request->get('tr_start_date');
                        }
                        elseif($request->has('tr_end_date')) {
                            $query->where('date', '<=', $request->get('tr_end_date'));
                            $this->filter_query['tr_end_date'] = $request->get('tr_end_date');
                        }
                    })
                    ->orderBy('date')
                    ->get();

                $adjustment = [];
                $filteredTransaction  = $transaction->filter(function ($value, $key)use($transaction, $adjustment,$openingBalance){
                    $balance = $value->dr_amount - $value->cr_amount;

                    if($key > 0) {
                        $value->balance = $transaction[$key-1]->balance + $balance;
                    }else{
                        $value->balance = $openingBalance + ($value->dr_amount - $value->cr_amount);
                    }
                    return $value;
                });

                $data['transaction'] = $filteredTransaction;

            }

            elseif($request->tr_head) {
                $data['print_head'] = $this->panel.' - DAILY';
                $data['table_head'] = Carbon::parse($date)->format('Y-m-d');


                $openingBalance = 0;
                $data['opening'] = $openingBalance;
                $data['row'] = TransactionHead::find($request->tr_head);

                if (!$data['row'])
                    return parent::invalidRequest();

                $transaction = $data['row']->tR()
                    ->where(function ($query) use ($request) {
                        if ($request->has('tr_start_date') && $request->has('tr_end_date')) {
                            $query->whereBetween('date', [$request->get('tr_start_date'), $request->get('tr_end_date')]);
                            $this->filter_query['tr_start_date'] = $request->get('tr_start_date');
                            $this->filter_query['tr_end_date'] = $request->get('tr_end_date');
                        }
                        elseif ($request->has('tr_start_date')) {
                            $query->where('date', '>=', $request->get('tr_start_date'));
                            $this->filter_query['tr_start_date'] = $request->get('tr_start_date');
                        }
                        elseif($request->has('tr_end_date')) {
                            $query->where('date', '<=', $request->get('tr_end_date'));
                            $this->filter_query['tr_end_date'] = $request->get('tr_end_date');
                        }
                    })
                    ->orderBy('date')
                    ->get();

                $adjustment = [];
                $filteredTransaction  = $transaction->filter(function ($value, $key)use($transaction, $adjustment,$openingBalance){
                    $balance = $value->dr_amount - $value->cr_amount;

                    if($key > 0) {
                        $value->balance = $transaction[$key-1]->balance + $balance;
                    }else{
                        $value->balance = $openingBalance + ($value->dr_amount - $value->cr_amount);
                    }
                    return $value;
                });

                $data['transaction'] = $filteredTransaction;

            }
            else{
                request()->session()->flash($this->message_warning, 'Filter Statement with your Target Ledger');
                $data['table_head'] = '';
            }

        }else{

            request()->session()->flash($this->message_warning, 'Filter Statement with your Target Ledger');
            $data['table_head'] = '';

        }

        $head = TransactionHead::where('status',1)->pluck('tr_head','id')->toArray();
        $data['th'] =  array_prepend($head,'Select Ledger','0');

        $data['url'] = URL::current();
        $data['tag'] = 'today';
        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.detail.index'), compact('data'));
    }

    public function viewBalanceStatement(Request $request)
    {
        $data = [];

        $data['tr_head'] = TransactionHead::select('id', 'tr_head', 'acc_id', 'status')
            ->where(function ($query) use ($request) {

                if ($request->has('tr_head') && $request->get('tr_head') != "") {
                    $query->where('tr_head', 'like', '%' . $request->tr_head . '%');
                    $this->filter_query['tr_head'] = $request->tr_head;
                }

                if ($request->has('acc_id') && $request->get('acc_id') > 0) {
                    $query->where('acc_id', '=', $request->acc_id);
                    $this->filter_query['acc_id'] = $request->acc_id;
                }

            })
            ->orderBy('tr_head','asc')->get()
            ->filter(function($value){
                $value->dr_amount = $dr = $value->tR->sum('dr_amount');
                $value->cr_amount = $cr = $value->tR->sum('cr_amount');
                $value->balance = $balance = $dr - $cr;

                if($value->balance <> 0){
                    return $value;
                }
            });


        $head = TransactionHead::where('status',1)->pluck('tr_head','id')->toArray();
        $data['th'] =  array_prepend($head,'Select Ledger','0');

        $aCat = AccountCategory::where('status',1)->pluck('ac_name','id')->toArray();
        $data['ac'] =  array_prepend($aCat,'Select Ledger Group','0');

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView('print.account.ledger.balance-statement'), compact('data'));
    }
}
