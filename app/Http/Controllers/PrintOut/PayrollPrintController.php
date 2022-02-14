<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\PrintOut;

use App\Http\Controllers\CollegeBaseController;
use App\Models\FeeCollection;
use App\Models\FeeMaster;
use App\Models\Staff;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use view, URL;
use ViewHelper;
class PayrollPrintController extends CollegeBaseController
{
    protected $base_route = 'account.fees.print';
    protected $view_path = 'account.fees.print';
    protected $panel = 'Payroll Collection Receipt';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function printMaster(Request $request, $id)
    {
        $data = [];
        $data['fee_master'] = FeeMaster::find($id);

        $data['staff'] = $data['fee_master']->students()
                            ->select('reg_no', 'faculty','semester', 'first_name', 'middle_name', 'last_name')
                            ->first();

        return view(parent::loadDataToView('print.student-fee.master'), compact('data'));
    }

    public function staffLedger(Request $request, $id)
    {
        $today = Carbon::today();
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


        return view(parent::loadDataToView('print.staff-payroll.staff-ledger'), compact('data'));
    }
}

