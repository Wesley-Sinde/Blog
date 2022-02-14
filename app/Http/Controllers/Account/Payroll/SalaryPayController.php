<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Account\Payroll;

use App\Http\Controllers\CollegeBaseController;
use App\Models\FeeMaster;
use App\Models\PayrollHead;
use App\Models\SalaryPay;
use App\Models\Staff;
use App\Models\StaffDesignation;
use Illuminate\Http\Request;
use view, URL;
use ViewHelper;
class SalaryPayController extends CollegeBaseController
{
    protected $base_route = 'account.salary.payment';
    protected $view_path = 'account.payroll.payment';
    protected $panel = 'Salary Pay';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['staff'] = Staff::select('id', 'reg_no', 'first_name',  'middle_name', 'last_name',
            'father_name', 'mobile_1','designation','qualification','status')
            ->where(function ($query) use ($request) {
                $this->commonStaffFilterCondition($query, $request);
            })
            ->orderBy('join_date','desc')
            ->get();

        $data['designation'] = $this->staffDesignationList();
        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function view(Request $request, $id)
    {
        $data = [];
        $data['staff'] = Staff::select('id','reg_no', 'join_date', 'first_name',  'middle_name', 'last_name',
            'date_of_birth', 'home_phone','email', 'mobile_1', 'designation','qualification','staff_image', 'status')
            ->where('id','=',$id)
            ->first();

        $data['payroll_master'] = $data['staff']->payrollMaster()->orderBy('due_date','desc')->get();
        $data['pay_salary'] = $data['staff']->paySalary()->get();

        /*total Calculation on Table Foot*/
        $data['staff']->amount = $data['staff']->payrollMaster()->sum('amount');
        $data['staff']->allowance = $data['staff']->paySalary()->sum('allowance');
        $data['staff']->fine = $data['staff']->paySalary()->sum('fine');
        $data['staff']->paid_amount = $data['staff']->paySalary()->sum('paid_amount');
        $data['staff']->balance =
            ($data['staff']->amount + $data['staff']->allowance) - ($data['staff']->paid_amount + $data['staff']->fine) ;

        //for fee add modal data
        $pHead = PayrollHead::select('id', 'title')->Active()->pluck('title','id')->toArray();
        $data['payroll_head'] = array_prepend($pHead,'Select Fee Head',0);


        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.pay.index'), compact('data'));
    }

    public function add(Request $request, $id)
    {
        $data = [];
        $data['fee_master'] = FeeMaster::select('id', 'students_id', 'semester', 'fee_head','fee_due_date','fee_amount','status')
            ->where('students_id','=',$data['student']->id)
            ->get();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.collect.add'), compact('data'));
    }

    public function store(Request $request)
    {
        $request->request->add(['created_by' => auth()->user()->id]);
        $faculty = SalaryPay::create($request->all());

        $request->session()->flash($this->message_success, $this->panel. ' Successfully.');
        return back();
    }

    public function delete(Request $request, $id)
    {
        if (!$row = SalaryPay::find($id)) return parent::invalidRequest();

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return back();
    }


}
