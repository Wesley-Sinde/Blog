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
use App\Models\SalaryPay;
use App\Models\Staff;
use App\Models\StaffDesignation;
use Illuminate\Http\Request;
use URL;
use ViewHelper;
class PayrollBaseController extends CollegeBaseController
{
    protected $base_route = 'account.payroll';
    protected $view_path = 'account.payroll';
    protected $panel = 'Payroll';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {

        $data = [];
        if($request->all()) {

        }else{
           /* $year = $this->getActiveYear();
            $data['salaryPay'] = SalaryPay::select('salary_pays.staff_id', 'salary_pays.fee_masters_id',
                'salary_pays.date', 'salary_pays.discount', 'salary_pays.fine', 'salary_pays.paid_amount',
                'salary_pays.payment_mode','salary_pays.note','salary_pays.created_by','salary_pays.status as fc_status',
                'pm.status as pm_status','pm.payroll_head',
                'staff.reg_no','staff.join_date', 'staff.first_name','staff.middle_name', 'staff.last_name','staff.semester')
                ->whereYear('salary_pays.date', '=', $year)
                ->join('staff', 'staff.id','=','salary_pays.staff_id')
                ->join('fee_masters as pm','pm.id','=','salary_pays.fee_masters_id')
                ->orderBy('salary_pays.created_at','desc')
                ->get();*/
        }

        $data['salaryPay'] = SalaryPay::select('salary_pays.staff_id', 'salary_pays.salary_masters_id', 'salary_pays.date',
            'salary_pays.allowance', 'salary_pays.fine', 'salary_pays.paid_amount','salary_pays.payment_mode',
            'salary_pays.created_by','pm.status as pm_status','pm.payroll_head',
            'staff.reg_no','staff.join_date', 'staff.first_name','staff.middle_name', 'staff.last_name','staff.designation')
            ->where(function ($query) use ($request) {

                $this->commonStaffFilterCondition($query, $request);

                if ($request->has('salary_pay_date_start') && $request->has('salary_pay_date_end')) {
                    $query->whereBetween('salary_pays.date', [$request->get('salary_pay_date_start'), $request->get('salary_pay_date_end')]);
                    $this->filter_query['salary_pay_date_start'] = $request->get('salary_pay_date_start');
                    $this->filter_query['salary_pay_date_end'] = $request->get('salary_pay_date_end');
                }
                elseif ($request->has('salary_pay_date_start')) {
                    $query->where('salary_pays.date', '>=', $request->get('salary_pay_date_start'));
                    $this->filter_query['salary_pay_date_start'] = $request->get('salary_pay_date_start');
                }
                elseif($request->has('salary_pay_date_end')) {
                    $query->where('salary_pays.date', '<=', $request->get('salary_pay_date_end'));
                    $this->filter_query['salary_pay_date_end'] = $request->get('salary_pay_date_end');
                }

                if ($request->has('payroll_heads') && $request->get('payroll_heads') > 0) {
                    $query->where('pm.payroll_head', '=',$request->payroll_heads);
                    $this->filter_query['pm.payroll_head'] = $request->payroll_heads;
                }

                if ($request->has('payment_method') && $request->get('payment_method') !=null) {
                    $query->where('salary_pays.payment_mode', 'like', '%' . $request->payment_method . '%');
                    $this->filter_query['salary_pays.payment_mode'] = $request->payment_method;
                }

            })
            ->join('staff', 'staff.id','=','salary_pays.staff_id')
            ->join('payroll_masters as pm','pm.id','=','salary_pays.salary_masters_id')
            ->orderBy('salary_pays.created_at','desc')
            ->get();


        //dd($data['salaryPay']->toArray());

        $data['designation'] = $this->staffDesignationList();
        $data['payment_method'] = $this->activePaymentMethod();
        $data['payroll_heads'] = $this->activePayrollHead();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function balance(Request $request)
    {

        $data = [];
        $staffs = Staff::select('id', 'reg_no', 'join_date', 'first_name',  'middle_name', 'last_name',
            'father_name', 'mobile_1','staff_image','designation','status')
            ->where(function ($query) use ($request) {

                if ($request->has('reg_no')) {
                    $query->where('reg_no', 'like', '%'.$request->reg_no.'%');
                    $this->filter_query['reg_no'] = $request->reg_no;
                }

                if ($request->has('join_date_start') && $request->has('join_date_end')) {
                    $query->whereBetween('join_date', [$request->get('join_date_start'), $request->get('join_date_end')]);
                    $this->filter_query['join_date_start'] = $request->get('join_date_start');
                    $this->filter_query['join_date_end'] = $request->get('join_date_end');
                }
                elseif ($request->has('join_date_start')) {
                    $query->where('join_date', '>=', $request->get('join_date_start'));
                    $this->filter_query['join_date_start'] = $request->get('join_date_start');
                }
                elseif($request->has('join_date_end')) {
                    $query->where('join_date', '<=', $request->get('join_date_end'));
                    $this->filter_query['join_date_end'] = $request->get('join_date_end');
                }

                if ($request->has('designation')) {
                    $query->where('designation', 'like', '%' . $request->designation . '%');
                    $this->filter_query['designation'] = $request->designation;
                }

                if ($request->has('status')) {
                    $query->where('status', $request->status == 'active'?1:0);
                    $this->filter_query['status'] = $request->get('status');
                }

            })
            ->get();

        /*filter due using call back*/
        $filtered  = $staffs->filter(function ($staff) {
            $staff->amount = $staff->payrollMaster()->sum('amount');
            $staff->allowance = $staff->paySalary()->sum('allowance');
            $staff->paid_amount = $staff->paySalary()->sum('paid_amount');
            $staff->fine = $staff->paySalary()->sum('fine');
            $staff->balance = ($staff->amount + $staff->allowance) - ($staff->paid_amount+ $staff->fine);
            if($staff->balance > 0){
                return $staff;
            }
        });

        $data['staff'] = $filtered;

        $data['designation'] = $this->staffDesignationList();
        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.balance.index'), compact('data'));
    }

}
