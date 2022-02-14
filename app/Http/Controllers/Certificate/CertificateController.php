<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\CollegeBaseController;

use App\Http\Requests\Certificate\Template\AddValidation;
use App\Http\Requests\Certificate\Template\EditValidation;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\CertificateHistory;
use App\Models\CertificateTemplate;
use App\Models\BookStatus;
use App\Models\Student;
use App\Models\StudentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use URL;
use ViewHelper;
class CertificateController extends CollegeBaseController
{
    protected $base_route = 'certificate';
    protected $view_path = 'certificate';
    protected $panel = 'Certificate Generate';
    protected $folder_path;
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function issue()
    {
        $this->panel = "Issue Certificate";
        $data['url'] = URL::current();

        return view(parent::loadDataToView('certificate.issue.add'), compact('data'));
    }

    //custom certificate generate
    public function generate(Request $request)
    {
        $data = [];
        if($request->all()) {
            $data['student'] = Student::select('id', 'reg_no', 'reg_date', 'first_name', 'middle_name', 'last_name', 'faculty', 'semester', 'academic_status','status')
                ->where(function ($query) use ($request) {
                    $this->commonStudentFilterCondition($query, $request);
                })
                ->get();
        }

        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();

        $certificate = CertificateTemplate::select('id', 'certificate')->Active()->pluck('certificate','id')->toArray();
        $data['certificates'] = array_prepend($certificate,'Select Certificate',0);

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView('certificate.generate.index'), compact('data'));
    }

    /*History*/
    public function history(Request $request)
    {
        $data = [];

        if($request->all()) {
            /*$data['history'] = CertificateHistory::select('certificate_histories.certificate', 'certificate_histories.certificate_id',
                'certificate_histories.history_type', 'certificate_histories.ref_text', 's.reg_no',
                's.reg_date', 's.faculty', 's.semester', 's.batch', 's.academic_status',
                's.first_name', 's.middle_name', 's.last_name', 'ac.id as certificate_id','ac.date_of_issue',
                'ac.year_of_study', 'ac.percentage_of_attendance')
                ->where(function ($query) use ($request) {

                    if ($request->has('reg_no')) {
                        $query->where('students.reg_no', 'like', '%' . $request->reg_no . '%');
                        $this->filter_query['students.reg_no'] = $request->reg_no;
                    }

                    if ($request->has('reg-start-date') && $request->has('reg-end-date')) {
                        $query->whereBetween('students.reg_date', [$request->get('reg-start-date'), $request->get('reg-end-date')]);
                        $this->filter_query['reg-start-date'] = $request->get('reg-start-date');
                        $this->filter_query['reg-end-date'] = $request->get('reg-end-date');
                    } elseif ($request->has('reg-start-date')) {
                        $query->where('students.reg_date', '>=', $request->get('reg-start-date'));
                        $this->filter_query['reg-start-date'] = $request->get('reg-start-date');
                    } elseif ($request->has('reg-end-date')) {
                        $query->where('students.reg_date', '<=', $request->get('reg-end-date'));
                        $this->filter_query['reg-end-date'] = $request->get('reg-end-date');
                    }

                    if ($request->has('faculty')) {
                        $query->where('students.faculty', '=', $request->faculty);
                        $this->filter_query['students.faculty'] = $request->faculty;
                    }

                    if ($request->has('semester')) {
                        $query->where('students.semester', '=',  $request->semester);
                        $this->filter_query['students.semester'] = $request->semester;
                    }

                    if ($request->has('batch')) {
                        $query->where('students.batch', '=',  $request->batch);
                        $this->filter_query['students.batch'] = $request->batch;
                    }

                    if ($request->has('academic_status')) {
                        $query->where('students.academic_status', '=',  $request->academic_status);
                        $this->filter_query['students.academic_status'] = $request->academic_status;
                    }

                    if ($request->has('status')) {
                        $query->where('students.status', $request->status == 'active' ? 1 : 0);
                        $this->filter_query['students.status'] = $request->get('status');
                    }

                    if ($request->has('issue-start-date') && $request->has('issue-end-date')) {
                        $query->whereBetween('ac.date_of_issue', [$request->get('issue-start-date'), $request->get('issue-end-date')]);
                        $this->filter_query['issue-start-date'] = $request->get('issue-start-date');
                        $this->filter_query['issue-end-date'] = $request->get('issue-end-date');
                    } elseif ($request->has('issue-start-date')) {
                        $query->where('ac.date_of_issue', '>=', $request->get('issue-start-date'));
                        $this->filter_query['issue-start-date'] = $request->get('issue-start-date');
                    } elseif ($request->has('issue-end-date')) {
                        $query->where('ac.date_of_issue', '<=', $request->get('issue-end-date'));
                        $this->filter_query['issue-end-date'] = $request->get('issue-end-date');
                    }

                    if ($request->has('year_of_study')) {
                        $query->where('ac.year_of_study', '=',  $request->year_of_study);
                        $this->filter_query['ac.year_of_study'] = $request->year_of_study;
                    }

                    if ($request->has('percentage_of_attendance')) {
                        $query->where('ac.percentage_of_attendance', '=',  $request->percentage_of_attendance);
                        $this->filter_query['ac.percentage_of_attendance'] = $request->percentage_of_attendance;
                    }

                })
                ->join('students as s', 's.id', '=', 'certificate_histories.students_id')
                ->join('attendance_certificates as ac', 'ac.id', '=', 'certificate_histories.certificate_id')
                ->get();*/
        }

        $data['history'] = CertificateHistory::select('certificate_histories.created_at','certificate_histories.certificate', 'certificate_histories.certificate_id',
            'certificate_histories.history_type', 'certificate_histories.ref_text', 'students.id as students_id','students.reg_no',
            'students.first_name', 'students.middle_name', 'students.last_name', 'students.faculty', 'students.semester')
            ->where(function ($query) use ($request) {

                $this->commonStudentFilterCondition($query, $request);

                if ($request->has('history_type')) {
                    $query->where('certificate_histories.history_type', '=',  $request->history_type);
                    $this->filter_query['certificate_histories.history_type'] = $request->history_type;
                }

                if ($request->has('start-date') && $request->has('end-date')) {
                    $query->whereBetween('certificate_histories.created_at', [$request->get('start-date'), $request->get('end-date')]);
                    $this->filter_query['start-date'] = $request->get('start-date');
                    $this->filter_query['end-date'] = $request->get('end-date');
                } elseif ($request->has('start-date')) {
                    $query->where('certificate_histories.created_at', '>=', $request->get('start-date'));
                    $this->filter_query['start-date'] = $request->get('start-date');
                } elseif ($request->has('end-date')) {
                    $query->where('certificate_histories.created_at', '<=', $request->get('end-date'));
                    $this->filter_query['end-date'] = $request->get('end-date');
                }


            })
            ->join('students', 'students.id', '=', 'certificate_histories.students_id')
            ->orderBy('certificate_histories.created_at','desc')
            ->get();


        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.history.index'), compact('data'));
    }

    public function studentDetail(Request $request)
    {
        $student = Student::select('id', 'reg_no', 'reg_date', 'university_reg','faculty','semester',
            'academic_status', 'first_name', 'middle_name', 'last_name', 'date_of_birth', 'gender',
            'email', 'extra_info', 'student_image','student_signature','status')
            ->where('id', '=', $request->get('id'))->first();

        //calculate Due Fees
        $fee_amount = $student->feeMaster()->sum('fee_amount');
        $paid_amount = $student->feeCollect()->sum('paid_amount');
        $discount = $student->feeCollect()->sum('discount');
        $fine = $student->feeCollect()->sum('fine');
        $student->balance = ($fee_amount + $fine) - ($discount + $paid_amount);
        $response['html'] = view('certificate.issue.includes.student_detail',[
            'student' => $student
        ])->render();
        return response()->json(json_encode($response));
    }



}
