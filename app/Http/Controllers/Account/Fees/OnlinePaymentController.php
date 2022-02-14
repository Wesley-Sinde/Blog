<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Account\Fees;

use App\Http\Controllers\CollegeBaseController;
use App\Models\FeeCollection;
use App\Models\OnlinePayment;
use App\Models\PaymentMethod;
use App\Models\AlertSetting;
use App\Models\BookIssue;
use App\Models\Faculty;
use App\Models\GuardianDetail;
use App\Role;
use App\Models\SmsEmail;
use App\Models\SmsSetting;
use App\Models\Staff;
use App\Models\StaffDesignation;
use App\Models\Student;
use App\Traits\AccountingScope;
use App\Traits\PaymentGatewayScope;
use App\Traits\SmsEmailScope;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class OnlinePaymentController extends CollegeBaseController
{
   /* protected $base_route = 'info.smsemail';
    protected $view_path = 'info.smsemail';
    protected $panel = 'SMS / Email';
    protected $filter_query = [];

    protected $BalanceFees = 'BalanceFees';
    protected $FeeReceive = 'FeeReceive';
    protected $LibraryReturnPeriodOver = 'LibraryReturnPeriodOver';*/

    protected $base_route = 'account.fees.online-payment';
    Protected $view_path = 'account.fees.online-payment';
    Protected $panel = 'Online Payment';
    protected $filter_query = [];


    use PaymentGatewayScope;

    public function __construct()
    {

    }

    public function paymentProcessed(Request $request)
    {
        dd('payment processed');
        dd($request->all());

        /*$data = [];
        $data['rows'] = SmsEmail::select('id', 'subject', 'message', 'sms', 'email', 'group','status')
            ->latest()
            ->get();
        //dd($data['rows']->toarray());
        return view(parent::loadDataToView($this->view_path . '.index'), compact('data'));*/

    }


    //Online Payment & Verification
    public function onlinePayment(Request $request)
    {

        $data = [];
        if($request->all()){
            $students = Student::select('students.id','students.reg_no','students.first_name',
                'students.middle_name', 'students.last_name','students.faculty','students.semester',
                'op.id as payment_id','op.date', 'op.amount', 'op.payment_gateway', 'op.ref_no', 'op.ref_text',
                'op.status as payment_status','op.created_by as paid_by')
                ->where(function ($query) use ($request) {
                    $this->commonStudentFilterCondition($query, $request);

                    if ($request->has('pay_date_start') && $request->has('pay_date_end')) {
                        $query->whereBetween('op.date', [$request->get('pay_date_start'), $request->get('pay_date_end')]);
                        $this->filter_query['op.pay_date_start'] = $request->get('pay_date_start');
                        $this->filter_query['op.pay_date_end'] = $request->get('pay_date_end');
                    } elseif ($request->has('pay_date_start')) {
                        $query->where('op.date', '=', $request->get('pay_date_start'));
                        $this->filter_query['op.pay_date_start'] = $request->get('pay_date_start');
                    } elseif ($request->has('op.pay_date_end')) {
                        $query->where('op.date', '=', $request->get('pay_date_end'));
                        $this->filter_query['op.pay_date_end'] = $request->get('pay_date_end');
                    }

                    if ($request->has('payment_gateway')) {
                        $query->where('op.payment_gateway', '=', $request->payment_gateway);
                        $this->filter_query['op.payment_gateway'] = $request->payment_gateway;
                    }

                    if ($request->has('verify_status')) {
                        $query->where('op.status', $request->verify_status == 'verify' ? 1 : 0);
                        $this->filter_query['op.status'] = $request->get('verify_status');
                    }

                })
                ->join('online_payments as op', 'op.students_id', '=', 'students.id')
                ->get();
        }else{
            $students = Student::select('students.id','students.reg_no','students.first_name',
                'students.middle_name', 'students.last_name','students.faculty','students.semester',
                'op.id as payment_id','op.date', 'op.amount', 'op.payment_gateway', 'op.ref_no', 'op.ref_text',
                'op.status as payment_status','op.created_by as paid_by')
                ->where('op.status',0)
                ->join('online_payments as op', 'op.students_id', '=', 'students.id')
                ->get();
        }


        $filteredStudent  = $students->filter(function ($student) {
            $student->fee_amount = $student->feeMaster()->sum('fee_amount');
            $student->paid_amount = $student->feeCollect()->sum('paid_amount');
            $student->discount = $student->feeCollect()->sum('discount');
            $student->fine = $student->feeCollect()->sum('fine');
            $student->balance = ($student->fee_amount + $student->fine) - ($student->discount + $student->paid_amount);
            if($student->balance > 0){
                return $student;
            }
        });

        $data['student'] = $filteredStudent;


        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();

        $gateway = OnlinePayment::get()->pluck('payment_gateway','payment_gateway')->toArray();
        $data['payment_gateway'] = array_prepend($gateway,'Select Gateway','');

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));

    }

    public function paymentView(Request $request, $id)
    {
        $id = decrypt($id);

        $data['student'] = Student::select('students.id','students.reg_no','students.first_name',
            'students.middle_name', 'students.last_name','students.faculty','students.semester',
            'op.id as payment_id','op.date', 'op.amount', 'op.payment_gateway', 'op.ref_no', 'op.ref_text','op.note',
            'op.status as payment_status','op.created_by as paid_by')
            ->where('op.id',$id)
            ->where(function ($query) use ($request) {
                $this->commonStudentFilterCondition($query, $request);

                if ($request->has('pay_date_start') && $request->has('pay_date_end')) {
                    $query->whereBetween('op.date', [$request->get('pay_date_start'), $request->get('pay_date_end')]);
                    $this->filter_query['op.pay_date_start'] = $request->get('pay_date_start');
                    $this->filter_query['op.pay_date_end'] = $request->get('pay_date_end');
                } elseif ($request->has('pay_date_start')) {
                    $query->where('op.date', '=', $request->get('pay_date_start'));
                    $this->filter_query['op.pay_date_start'] = $request->get('pay_date_start');
                } elseif ($request->has('op.pay_date_end')) {
                    $query->where('op.date', '=', $request->get('pay_date_end'));
                    $this->filter_query['op.pay_date_end'] = $request->get('pay_date_end');
                }

                if ($request->has('payment_gateway')) {
                    $query->where('op.payment_gateway', '=', $request->payment_gateway);
                    $this->filter_query['op.payment_gateway'] = $request->payment_gateway;
                }

                if ($request->has('verify_status')) {
                    $query->where('op.status', $request->verify_status == 'verify' ? 1 : 0);
                    $this->filter_query['op.status'] = $request->get('verify_status');
                }

            })
            ->join('online_payments as op', 'op.students_id', '=', 'students.id')
            ->get();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.view'), compact('data'));
    }

    public function paymentVerify(Request $request, $id)
    {
        $id = decrypt($id);
        $onlinePaymentDetail =OnlinePayment::find($id);

        if($onlinePaymentDetail){
            $request->receive_amount = $request->amount;
            $request->fine_amount = $request->fine;
            $request->discount_amount = $request->discount;
            $request->receive_amount = $request->amount;
            $request->date = $request->date;
            $request->students_id = decrypt($request->students_id);
            $request->payment_mode = $request->payment_mode;
            $request->note = $request->note;

            $students = Student::select('students.id','students.reg_no','students.first_name',
                'students.middle_name', 'students.last_name','students.faculty','students.semester',
                'op.id as payment_id','op.date', 'op.amount', 'op.payment_gateway', 'op.ref_no', 'op.ref_text',
                'op.status as payment_status','op.created_by as paid_by')
                ->where('students.id',$onlinePaymentDetail->students_id)
                ->join('online_payments as op', 'op.students_id', '=', 'students.id')
                ->get()
                ->filter(function ($student) {
                    $student->fee_amount = $student->feeMaster()->sum('fee_amount');
                    $student->paid_amount = $student->feeCollect()->sum('paid_amount');
                    $student->discount = $student->feeCollect()->sum('discount');
                    $student->fine = $student->feeCollect()->sum('fine');
                    $student->balance = ($student->fee_amount + $student->fine) - ($student->discount + $student->paid_amount);
                    if($student->balance > 0){
                        return $student;
                    }
                });



            //student filter
            if($students){
                $filtered  = $students->filter(function ($student) use ($request,$onlinePaymentDetail) {
                    //provide discount
                    $feeMaster = $student->feeMaster()->orderBy('fee_due_date','asc')->get();
                    $student->fee_amount = $feeMaster->sum('fee_amount');
                    $student->paid_amount = $student->feeCollect()->sum('paid_amount');
                    $student->discount = $student->feeCollect()->sum('discount');
                    $student->fine = $student->feeCollect()->sum('fine');
                    $student->balance = ($student->fee_amount + $student->fine) - ($student->discount + $student->paid_amount);
                    $totalReceiveAmt = intval($request->receive_amount);
                    $fineAmt = intval($request->fine_amount);
                    $discountAmt = intval($request->discount_amount);

                    if($student->balance > 0 && $fineAmt > 0){
                        $fineAmt = $fineAmt;
                        foreach ($feeMaster as $fm){
                            if($fineAmt > 0 ){
                                $collectionData = [
                                    'students_id'       => $request->students_id,
                                    'fee_masters_id'    => $fm->id,
                                    'date'              => $request->date,
                                    'paid_amount'       => 0,
                                    'fine'              => $fineAmt,
                                    'payment_mode'      => '-',
                                    'note'              => 'Fine',
                                    'created_by'        => auth()->user()->id
                                ];

                                $data = FeeCollection::create($collectionData);
                                $fineAmt  = 0;
                            }else{

                            }
                        }
                    }

                    if($student->balance > 0 && $discountAmt > 0){
                        //filter due using call back
                        $receiveAmount = $discountAmt;
                        foreach ($feeMaster as $fm){
                            $fee_amount = $fm->fee_amount;
                            $paid_amount = $fm->feeCollect()->sum('paid_amount');
                            $discount = $fm->feeCollect()->sum('discount');
                            $fine = $fm->feeCollect()->sum('fine');
                            $balance = ($fee_amount + $fine) - ($discount + $paid_amount);

                            if($receiveAmount > 0 && $balance > 0){
                                if($balance > $receiveAmount){
                                    $collectionData = [
                                        'students_id'       => $request->students_id,
                                        'fee_masters_id'    => $fm->id,
                                        'date'              => $request->date,
                                        'paid_amount'       => 0,
                                        'discount'          => $receiveAmount,
                                        'payment_mode'      => '-',
                                        'note'              => 'Discount',
                                        'created_by'        => auth()->user()->id
                                    ];

                                    $data = FeeCollection::create($collectionData);
                                    $receiveAmount = 0;
                                }else{
                                    if($receiveAmount > 0 ){
                                        $collectionData = [
                                            'students_id'       => $request->students_id,
                                            'fee_masters_id'    => $fm->id,
                                            'date'              => $request->date,
                                            'paid_amount'       => 0,
                                            'discount'          => $balance,
                                            'payment_mode'      => $request->payment_mode,
                                            'note'              => $request->note,
                                            'created_by'        => auth()->user()->id
                                        ];

                                        $data = FeeCollection::create($collectionData);
                                        $receiveAmount  = $receiveAmount  - $balance;
                                    }else{

                                    }

                                }
                            }
                        }
                    }

                    //receive fee
                    $feeMaster = $student->feeMaster()->orderBy('fee_due_date','asc')->get();
                    $student->fee_amount = $feeMaster->sum('fee_amount');
                    $student->paid_amount = $student->feeCollect()->sum('paid_amount');
                    $student->discount = $student->feeCollect()->sum('discount');
                    $student->fine = $student->feeCollect()->sum('fine');
                    $student->balance = ($student->fee_amount + $student->fine) - ($student->discount + $student->paid_amount);
                    $totalReceiveAmt = intval($request->receive_amount);


                    if($student->balance > 0 && $totalReceiveAmt > 0){
                        //filter due using call back
                        $receiveAmount = $totalReceiveAmt;
                        foreach ($feeMaster as $fm){
                            $fee_amount = $fm->fee_amount;
                            $paid_amount = $fm->feeCollect()->sum('paid_amount');
                            $discount = $fm->feeCollect()->sum('discount');
                            $fine = $fm->feeCollect()->sum('fine');
                            $balance = ($fee_amount + $fine) - ($discount + $paid_amount);

                            if($receiveAmount > 0 && $balance > 0){
                                if($balance > $receiveAmount){
                                    $collectionData = [
                                        'students_id'       => $request->students_id,
                                        'fee_masters_id'    => $fm->id,
                                        'date'              => $request->date,
                                        'paid_amount'       => $receiveAmount,
                                        'payment_mode'      => $request->payment_mode,
                                        'note'              => $request->note?'Online Payment Verify : '.$request->note:'Online Payment Verify',
                                        'created_by'        => auth()->user()->id
                                    ];

                                    $data = FeeCollection::create($collectionData);
                                    $receiveAmount = 0;
                                }else{
                                    if($receiveAmount > 0 ){
                                        $collectionData = [
                                            'students_id'       => $request->students_id,
                                            'fee_masters_id'    => $fm->id,
                                            'date'              => $request->date,
                                            'paid_amount'       =>$balance,
                                            'payment_mode'      => $request->payment_mode,
                                            'note'              => 'Online Payment Verify : '. $request->note,
                                            'created_by'        => auth()->user()->id
                                        ];

                                        $data = FeeCollection::create($collectionData);
                                        $receiveAmount  = $receiveAmount  - $balance;
                                    }else{

                                    }

                                }

                                //update online payment table with verified
                                $onlinePaymentDetail->update(['status'=>'active']);

                            }
                        }

                        //send alert
                        $studentId = $student->id ;
                        $this->feeReceiveAlert($studentId, $totalReceiveAmt);
                        $request->session()->flash($this->message_success, 'Successfully Collect '.$totalReceiveAmt.' & Verify Online Payment');
                    }

                });
            }else{
                $request->session()->flash($this->message_warning, 'Verification not complete. Invalid Request');
            }
        }else{
            $request->session()->flash($this->message_danger, 'Payment Not Found.');
        }

        return redirect()->back();

    }




}