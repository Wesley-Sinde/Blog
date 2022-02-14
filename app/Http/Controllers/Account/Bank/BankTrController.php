<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Account\Bank;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Account\BankTransaction\AddValidation;
use App\Http\Requests\Account\BankTransaction\EditValidation;
use App\Models\Bank;
use App\Models\BankTransaction;
use Illuminate\Http\Request;
use URL;
class BankTrController extends CollegeBaseController
{
    protected $base_route = 'account.bank-transaction';
    protected $view_path = 'account.bank.bank-transaction';
    protected $panel = 'Bank Transaction';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['transaction'] = BankTransaction::select('id','banks_id', 'description','deposit_id','date','dr_amt','cr_amt','amount', 'status')
            ->where(function ($query) use ($request) {

                if ($request->has('banks_id')) {
                    $query->where('banks_id', $request->banks_id );
                    $this->filter_query['banks_id'] = $request->banks_id;
                }

                if ($request->has('tr-start-date') && $request->has('tr-end-date')) {
                    $query->whereBetween('date', [$request->get('tr-start-date'), $request->get('tr-end-date')]);
                    $this->filter_query['tr-start-date'] = $request->get('tr-start-date');
                    $this->filter_query['tr-end-date'] = $request->get('tr-end-date');
                } elseif ($request->has('tr-start-date')) {
                    $query->where('date', '>=', $request->get('tr-start-date'));
                    $this->filter_query['tr-start-date'] = $request->get('tr-start-date');
                } elseif ($request->has('tr-end-date')) {
                    $query->where('date', '<=', $request->get('tr-end-date'));
                    $this->filter_query['tr-end-date'] = $request->get('tr-end-date');
                }

            })
            ->latest()
            ->get();

        $banks = Bank::where('status',1)->pluck('bank_name','id')->toArray();
        $data ['banks'] = array_prepend($banks,'Select Bank','0');

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];
        $banks = Bank::where('status',1)->pluck('bank_name','id')->toArray();
        $data ['banks'] = array_prepend($banks,'Select Bank','0');

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
            'banks_id'      => $request->banks_id,
            'description'   => $request->description,
            'deposit_id'    => $request->deposit_id,
            'date'          => $request->date,
            'dr_amt'        => $drAmount,
            'cr_amt'        => $crAmount,
            'amount'        => $request->amount,
            'created_by' => auth()->user()->id
        ];

        $bank = BankTransaction::create($data);

        $request->session()->flash($this->message_success, $this->panel. ' Add Successfully.');

        if($request->add_transaction_another) {
            return back();
        }else{
            return redirect()->route($this->base_route);
        }

    }

    public function delete(Request $request, $id)
    {
        if (!$row = BankTransaction::find($id)) return parent::invalidRequest();

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
                            $row = BankTransaction::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = BankTransaction::find($row_id);
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



}
