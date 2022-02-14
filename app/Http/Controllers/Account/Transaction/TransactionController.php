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
use Carbon\Carbon;
use Illuminate\Http\Request;
use URL;
class TransactionController extends CollegeBaseController
{
    protected $base_route = 'account.transaction';
    protected $view_path = 'account.transaction';
    protected $panel = 'Transaction';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        if($request->all()) {
            $data['transaction'] = Transaction::select('id', 'date', 'tr_head_id', 'dr_amount', 'cr_amount', 'description', 'status')
                ->where(function ($query) use ($request) {

                    if ($request->has('tr_head')) {
                        $query->where('tr_head_id', 'like', $request->tr_head);
                        $this->filter_query['tr_head_id'] = $request->tr_head;
                    }

                    if ($request->has('tr_start_date') && $request->has('tr_end_date')) {
                        $query->whereBetween('date', [$request->get('tr_start_date'), $request->get('tr_end_date')]);
                        $this->filter_query['tr_start_date'] = $request->get('tr_start_date');
                        $this->filter_query['tr_end_date'] = $request->get('tr_end_date');
                    } elseif ($request->has('tr_start_date')) {
                        $query->where('date', '>=', $request->get('tr_start_date'));
                        $this->filter_query['tr_start_date'] = $request->get('tr_start_date');
                    } elseif ($request->has('tr_end_date')) {
                        $query->where('date', '<=', $request->get('tr_end_date'));
                        $this->filter_query['tr_end_date'] = $request->get('tr_end_date');
                    }

                })
                ->latest()
                ->get();
        }else{
            $data['transaction'] = Transaction::select('id', 'date', 'tr_head_id', 'dr_amount', 'cr_amount', 'description', 'status')
                ->where('date',Carbon::today())
                ->latest()
                ->get();
        }

        $head = TransactionHead::where('status',1)->pluck('tr_head','id')->toArray();
        $data['th'] =  array_prepend($head,'Select Ledger','0');

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];
        $head = TransactionHead::where('status',1)->pluck('tr_head','id')->toArray();
        $data['th'] =  array_prepend($head,'Select Ledger','0');

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(AddValidation $request)
    {



        if($request->get('account_type') == "dr_amt"){
            $drAmount = $request->amount;
            $crAmount = 0;
        }elseif ($request->get('account_type') == "cr_amt"){
            $drAmount = 0;
            $crAmount = $request->amount;
        }else{

        }

        $data = [
            'date'          => $request->date,
            'tr_head_id' =>  $request->tr_head,
            'dr_amount' => $drAmount,
            'cr_amount' => $crAmount,
            'description' => $request->description,
            'created_by' => auth()->user()->id
        ];

        Transaction::create($data);

        $request->session()->flash($this->message_success, $this->panel. ' Add Successfully.');

        if($request->add_transaction_another) {
            $head = TransactionHead::where('status',1)->pluck('tr_head','id')->toArray();
            $data['th'] =  array_prepend($head,'Select Ledger','0');

            return back();
        }else{
            return redirect()->route($this->base_route);
        }

    }

    public function delete(Request $request, $id)
    {
        if (!$row = Transaction::find($id)) return parent::invalidRequest();

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
                            $row = Transaction::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = Transaction::find($row_id);
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


    public function multiAdd(Request $request)
    {
        $data = [];
        $head = TransactionHead::where('status',1)->orderBy('tr_head')->pluck('tr_head','id')->toArray();
        $data['th'] =  array_prepend($head,'Select Ledger','0');

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.multi-transaction.add'), compact('data'));
    }

    public function multiStore(Request $request)
    {
        if ($request->has('chkIds')) {
            foreach ($request->get('chkIds') as $key => $fee_head) {
                $data = [
                    'date'          => $request->date[$key],
                    'tr_head_id' =>  $request->tr_head[$key],
                    'dr_amount' => $request->dr_amount[$key],
                    'cr_amount' => $request->cr_amount[$key],
                    'description' => $request->description[$key],
                    'created_by' => auth()->user()->id
                ];

                Transaction::create($data);
            }

        }

        $request->session()->flash($this->message_success, $this->panel. ' Add Successfully.');

        if($request->add_transaction_another) {
            $head = TransactionHead::where('status',1)->pluck('tr_head','id')->toArray();
            $data['th'] =  array_prepend($head,'Select Ledger','0');

            return back();
        }else{
            return redirect()->route($this->base_route);
        }

    }

    public function trHtmlRow()
    {
        $tr_heads = [];
        $tr_heads[0] = 'Select Ledger';
        foreach (TransactionHead::select('id', 'tr_head')->orderBy('tr_head')->get() as $tr_head) {
            $tr_heads[$tr_head->id] = $tr_head->tr_head;
        }

        $response['html'] = view($this->view_path.'.multi-transaction.includes.transaction_tr', [
            'tr_heads' => $tr_heads,
        ])->render();
        return response()->json(json_encode($response));

    }
}
