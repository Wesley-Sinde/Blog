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
use App\Http\Requests\Account\Bank\AddValidation;
use App\Http\Requests\Account\Bank\EditValidation;
use App\Models\Bank;
use Illuminate\Http\Request;
use URL;
class BankController extends CollegeBaseController
{
    protected $base_route = 'account.bank';
    protected $view_path = 'account.bank';
    protected $panel = 'Bank';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['bank'] = Bank::select('id', 'bank_name','ac_name','ac_number','branch','status')
            ->where(function ($query) use ($request) {

                if ($request->has('bank_name')) {
                    $query->where('bank_name', 'like', '%' . $request->bank_name . '%');
                    $this->filter_query['bank_name'] = $request->bank_name;
                }

                if ($request->has('ac_name')) {
                    $query->where('ac_name', 'like', '%' . $request->ac_name . '%');
                    $this->filter_query['ac_name'] = $request->ac_name;
                }

                if ($request->has('ac_number')) {
                    $query->where('ac_number', 'like', '%' . $request->ac_number . '%');
                    $this->filter_query['ac_number'] = $request->ac_number;
                }

                if ($request->has('branch')) {
                    $query->where('branch', 'like', '%' . $request->branch . '%');
                    $this->filter_query['branch'] = $request->branch;
                }

            })
            ->orderBy('bank_name')
            ->get();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];
        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        $request->request->add(['created_by' => auth()->user()->id]);
        $bank = Bank::create($request->all());

        $request->session()->flash($this->message_success, $this->panel. ' Add Successfully.');

        if($request->add_bank_another) {
            return back();
        }else{
            return redirect()->route($this->base_route);
        }

    }

    public function edit(Request $request, $id)
    {

        $data = [];
        $data['row'] = Bank::find($id);
        if (!$data['row'])
            return parent::invalidRequest();

        $data['url'] = URL::current();
        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        if (!$row = Bank::find($id)) return parent::invalidRequest();

        $row->update([
            'bank_name' => $request->get('bank_name'),
            'ac_name' => $request->get('ac_name'),
            'ac_number' => $request->get('ac_number'),
            'branch' => $request->get('branch'),
            'last_updated_by' => auth()->user()->id,
        ]);
        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function view(Request $request, $id)
    {
        $data = [];
        $data['row'] = Bank::find($id);
        if (!$data['row'])
            return parent::invalidRequest();

        $transaction = $data['row']->bankTransaction()
            ->where(function ($query) use ($request) {
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
            ->get();

        $filteredTransaction  = $transaction->filter(function ($value, $key){
             $value->balance = $value->dr_amt - $value->cr_amt;
             return $value;
        });

        $data['transaction'] = $filteredTransaction;

        $data['url'] = URL::current();
        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.detail.index'), compact('data'));
    }

    public function delete(Request $request, $id)
    {
        if (!$row = Bank::find($id)) return parent::invalidRequest();

        $row->bankTransaction()->delete();

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
                            $row = Bank::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = Bank::find($row_id);
                            $row->bankTransaction()->delete();
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
        if (!$row = Bank::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = Bank::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }



}
