<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Account\Report;

use App\Http\Controllers\CollegeBaseController;
use App\Models\BankTransaction;
use App\Models\FeeCollection;
use App\Models\OnlinePayment;
use App\Models\SalaryPay;
use App\Models\Student;
use App\Models\Transaction;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use URL;
class BalanceFeeReportController extends CollegeBaseController
{
    protected $base_route = 'account.report.balance-fee';
    protected $view_path = 'account.report.balance-fee';
    protected $panel = 'Balance Fee Report';
    protected $filter_query = [];

    public function __construct()
    {


    }

    public function balanceFees(Request $request)
    {
        $data = [];

        $students = Student::select('students.id','students.reg_no','students.reg_date', 'students.first_name',
            'students.middle_name', 'students.last_name','students.faculty','students.semester', 'students.student_image','students.status',
            'gd.guardian_first_name', 'gd.guardian_middle_name', 'gd.guardian_last_name','gd.guardian_mobile_1')
            ->where(function ($query) use ($request) {
                $this->commonStudentFilterCondition($query, $request);
                if ($request->get('village') > 0) {
                    $query->where('ai.address', '=',  $request->village);
                    $this->filter_query['ai.address'] = $request->village;
                }
            })
            ->join('student_guardians as sg', 'sg.students_id', '=', 'students.id')
            ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
            ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
            ->get();

        if($request->due_status == 'overdue'){
            /*filter Over due using call back*/
            $filtered  = $students->filter(function ($student) {
                $date = Carbon::today()->format('Y-m-d');
                $feeMaster = $student->feeMaster()->select('id as fee_master_id','fee_amount')->where('fee_due_date','<=',$date)->get();
                $collection = FeeCollection::select('fee_collections.id','fee_collections.students_id','fee_collections.fee_masters_id', 'fee_collections.date', 'fee_collections.discount', 'fee_collections.fine', 'fee_collections.paid_amount')
                    ->where('fm.fee_due_date','<=',$date)
                    ->where('fee_collections.students_id','=',$student->id)
                    ->join('fee_masters as fm','fm.id','=','fee_collections.fee_masters_id')
                    ->get();

                $student->fee_amount = $feeMaster->sum('fee_amount');
                $student->paid_amount = $collection->sum('paid_amount');
                $student->discount = $collection->sum('discount');
                $student->fine = $collection->sum('fine');
                $student->balance = ($student->fee_amount + $student->fine) - ($student->discount + $student->paid_amount);
                if($student->balance > 0){
                    return $student;
                }
            });

        }else{
            /*filter due using call back*/
            $filtered  = $students->filter(function ($student) {
                $student->fee_amount = $student->feeMaster()->sum('fee_amount');
                $student->paid_amount = $student->feeCollect()->sum('paid_amount');
                $student->discount = $student->feeCollect()->sum('discount');
                $student->fine = $student->feeCollect()->sum('fine');
                $student->balance = ($student->fee_amount + $student->fine) - ($student->discount + $student->paid_amount);
                if($student->balance > 0){
                    return $student;
                }
            });

        };

        $data['student'] = $filtered;

        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();
        $data['fee_heads'] = $this->activeFeeHead();

        $data['village'] = $this->addressVillage();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function feeCollection(Request $request)
    {
        $data = [];
        $date = Carbon::now()->toDateString();
        if($request->all()){
            if ($request->start_date && $request->end_date) {
                $collection = FeeCollection::where(function ($query) use ($request) {
                    if ($request->has('start_date') && $request->has('end_date')) {
                        $query->whereBetween('date', [$request->get('start_date'), $request->get('end_date')]);
                        $this->filter_query['start_date'] = $request->get('start_date');
                        $this->filter_query['end_date'] = $request->get('end_date');
                    } elseif ($request->has('start_date')) {
                        $query->where('date', '=', $request->get('start_date'));
                        $this->filter_query['start_date'] = $request->get('start_date');
                    } elseif ($request->has('end_date')) {
                        $query->where('date', '=', $request->get('end_date'));
                        $this->filter_query['end_date'] = $request->get('end_date');
                    }

                    if($request->has('payment_mode')){
                        $query->where('payment_mode', '=', $request->get('payment_mode'));
                        $this->filter_query['payment_mode'] = $request->get('payment_mode');
                    }
                })
                ->get();

                $studentsId = $collection->pluck('students_id');
                $students = Student::select('students.id','students.reg_no','students.reg_date', 'students.first_name',
                    'students.middle_name', 'students.last_name','students.faculty','students.semester','ai.mobile_1', 'pd.father_first_name', 'pd.father_middle_name',
                    'pd.father_last_name','students.academic_status','students.status')
                    ->whereIn('students.id',$studentsId)
                    ->where(function ($query) use ($request) {
                        $this->commonStudentFilterCondition($query, $request);
                    })
                    ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
                    ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
                    ->get();

                if($students){
                    $filtered  = $students->filter(function ($student) use($request) {
                        $student->paids = $student->feeCollect()
                                                    ->where(function ($query) use ($request) {
                                                        if ($request->has('start_date') && $request->has('end_date')) {
                                                            $query->whereBetween('date', [$request->get('start_date'), $request->get('end_date')]);
                                                            $this->filter_query['start_date'] = $request->get('start_date');
                                                            $this->filter_query['end_date'] = $request->get('end_date');
                                                        } elseif ($request->has('start_date')) {
                                                            $query->where('date', '=', $request->get('start_date'));
                                                            $this->filter_query['start_date'] = $request->get('start_date');
                                                        } elseif ($request->has('end_date')) {
                                                            $query->where('date', '=', $request->get('end_date'));
                                                            $this->filter_query['end_date'] = $request->get('end_date');
                                                        }

                                                        if($request->has('payment_mode')){
                                                            $query->where('payment_mode', '=', $request->get('payment_mode'));
                                                            $this->filter_query['payment_mode'] = $request->get('payment_mode');
                                                        }
                                                    })
                                                    ->get();
                        $student->total_paid_amount = $student->paids->sum('paid_amount');
                        $student->total_discount = $student->paids->sum('discount');
                        $student->total_fine = $student->paids->sum('fine');
                        return $student;
                    });
                }

                $data['student'] =$filtered;
                $data['print_head'] = $this->panel.' - '.Carbon::parse($request->start_date)->format('m/d/Y').' To '.Carbon::parse($request->end_date)->format('m/d/Y');
                $data['tag'] = 'daily';
            }
            else{
                $date = Carbon::today()->format('Y-m-d');
                $collection = FeeCollection::get();
                $studentsId = $collection->pluck('students_id');
                $students = Student::select('students.id','students.reg_no','students.reg_date', 'students.first_name',
                    'students.middle_name', 'students.last_name','students.faculty','students.semester','ai.mobile_1', 'pd.father_first_name', 'pd.father_middle_name',
                    'pd.father_last_name','students.academic_status','students.status')
                    ->whereIn('students.id',$studentsId)
                    ->where(function ($query) use ($request) {
                        $this->commonStudentFilterCondition($query, $request);
                    })
                    ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
                    ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
                    ->get();

                if($students){
                    $filtered  = $students->filter(function ($student) use($date) {
                        $student->date = $date;
                        $student->paid_amount = $student->feeCollect()->where('date',$date)->sum('paid_amount');
                        $student->discount = $student->feeCollect()->where('date',$date)->sum('discount');
                        $student->fine = $student->feeCollect()->where('date',$date)->sum('fine');
                        return $student;
                    });
                }

                $data['student'] =$filtered;

                $data['print_head'] = $this->panel.' - '.Carbon::parse($date)->format('m/d/Y');
                $feeCollection = $this->dateFeeCollection($date);
                $data['fee_collection'] = $feeCollection->groupBy('fee_head');
                $data['fee_collection_total'] = $feeCollection->sum('paid_amount');
                $data['tag'] = 'today';
            }

        }else{

            $date = Carbon::today()->format('Y-m-d');
            $collection = FeeCollection::get();
            $studentsId = $collection->pluck('students_id');
            $students = Student::select('students.id','students.reg_no','students.reg_date', 'students.first_name',
                'students.middle_name', 'students.last_name','students.faculty','students.semester','ai.mobile_1', 'pd.father_first_name', 'pd.father_middle_name',
                'pd.father_last_name','students.academic_status','students.status')
                ->whereIn('students.id',$studentsId)
                ->where(function ($query) use ($request) {
                    $this->commonStudentFilterCondition($query, $request);
                })
                ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
                ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
                ->get();

            if($students){
                $filtered  = $students->filter(function ($student) use($date) {
                    $student->date = $date;
                    $student->paid_amount = $student->feeCollect()->where('date',$date)->sum('paid_amount');
                    $student->discount = $student->feeCollect()->where('date',$date)->sum('discount');
                    $student->fine = $student->feeCollect()->where('date',$date)->sum('fine');
                    return $student;
                });
            }

            $data['student'] =$filtered;

            $data['print_head'] = $this->panel.' - '.Carbon::parse($date)->format('m/d/Y');
            $feeCollection = $this->dateFeeCollection($date);
            $data['fee_collection'] = $feeCollection->groupBy('fee_head');
            $data['fee_collection_total'] = $feeCollection->sum('paid_amount');
            $data['tag'] = 'today';

        }

        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();

        $method = FeeCollection::pluck('payment_mode','payment_mode')->unique()->toArray();
        $methods = array_prepend($method,'','');
        $data['payment_method'] = $methods;

        $data['fee_heads'] = $this->activeFeeHead();

        $data['filter_query'] = $this->filter_query;
        $data['url'] = URL::current();

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function dateFeeCollection($date)
    {
        $feeCollection = FeeCollection::select('fee_collections.students_id', 'fee_collections.fee_masters_id',
            'fee_collections.date', 'fee_collections.discount', 'fee_collections.fine', 'fee_collections.paid_amount',
            'fee_collections.payment_mode','fee_collections.note','fee_collections.created_by','fee_collections.status as fc_status',
            'fm.status as fm_status','fm.fee_head')
            ->whereDate('fee_collections.date', '=', $date)
            ->join('fee_masters as fm','fm.id','=','fee_collections.fee_masters_id')
            ->orderBy('fee_collections.created_at','desc')
            ->get();

        return $feeCollection;
    }


}
