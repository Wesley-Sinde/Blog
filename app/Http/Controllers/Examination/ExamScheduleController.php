<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */
/**
 * Created by PhpStorm.
 * User: Umesh Kumar Yadav
 * Date: 03/03/2018
 * Time: 7:05 PM
 */
namespace App\Http\Controllers\Examination;

use App\Http\Controllers\CollegeBaseController;
use App\Models\AlertSetting;
use App\Models\Exam;
use App\Models\ExamMarkLedger;
use App\Models\ExamSchedule;
use App\Models\Faculty;
use App\Models\Month;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Year;
use App\Traits\ExaminationScope;
use App\Traits\SmsEmailScope;
use Illuminate\Http\Request;
use URL;

class ExamScheduleController extends CollegeBaseController
{
    protected $base_route = 'exam.schedule';
    protected $view_path = 'examination.schedule';
    protected $panel = 'Exam Schedule';
    protected $filter_query = [];

    use ExaminationScope;
    use SmsEmailScope;

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        if($request->all()) {
            $data['schedule_exams'] = ExamSchedule::select('years_id', 'months_id', 'exams_id', 'faculty_id', 'semesters_id', 'publish_status', 'status')
                ->groupBy('years_id', 'months_id', 'exams_id', 'faculty_id', 'semesters_id', 'publish_status', 'status')
                ->where(function ($query) use ($request) {

                    $year = $request->get('year');
                    $month = $request->get('month');
                    $exam = $request->get('exam');
                    $faculty = $request->get('faculty');
                    $semester = $request->get('semester');

                    if ($year) {
                        $query->where('years_id', '=', $year);
                        $this->filter_query['years_id'] = $year;
                    }

                    if ($month) {
                        $query->where('months_id', '=', $month);
                        $this->filter_query['months_id'] = $month;
                    }

                    if ($exam) {
                        $query->where('exams_id', '=', $exam);
                        $this->filter_query['exams_id'] = $exam;
                    }

                    if ($faculty) {
                        $query->where('faculty_id', '=', $faculty);
                        $this->filter_query['faculty_id'] = $faculty;
                    }

                    if ($semester) {
                        $query->where('semesters_id', '=', $semester);
                        $this->filter_query['semesters_id'] = $semester;
                    }
                })
                ->orderBy('years_id', 'desc')
                ->orderBy('months_id', 'asc')
                ->get();
        }else{
            $data['schedule_exams'] = ExamSchedule::select('years_id', 'months_id', 'exams_id', 'faculty_id', 'semesters_id', 'publish_status', 'status')
                ->groupBy('years_id', 'months_id', 'exams_id', 'faculty_id', 'semesters_id','publish_status', 'status')
                ->where(function ($query) use ($request) {

                    $year = $request->get('year');
                    $month = $request->get('month');
                    $exam = $request->get('exam');
                    $faculty = $request->get('faculty');
                    $semester = $request->get('semester');

                    if ($year) {
                        $query->where('years_id', '=', $year);
                        $this->filter_query['years_id'] = $year;
                    }

                    if ($month) {
                        $query->where('months_id', '=', $month);
                        $this->filter_query['months_id'] = $month;
                    }

                    if ($exam) {
                        $query->where('exams_id', '=', $exam);
                        $this->filter_query['exams_id'] = $exam;
                    }

                    if ($faculty) {
                        $query->where('faculty_id', '=', $faculty);
                        $this->filter_query['faculty_id'] = $faculty;
                    }

                    if ($semester) {
                        $query->where('semesters_id', '=', $semester);
                        $this->filter_query['semesters_id'] = $semester;
                    }
                })
                ->orderBy('years_id', 'desc')
                ->orderBy('months_id', 'asc')
                ->limit (100)
                ->get();
        }

        $data['years'] = $this->activeYears();
        $data['months'] = $this->activeMonths();
        $data['exams'] = $this->activeExams();
        $data['faculties'] = $this->activeFaculties();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];

        $data['years'] = $this->activeYears();
        $data['months'] = $this->activeMonths();
        $data['exams'] = $this->activeExams();
        $data['faculties'] = $this->activeFaculties();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(Request $request)
    {
        $year = $request->get('years_id');
        $month = $request->get('months_id');
        $exam = $request->get('exams_id');
        $faculty = $request->get('faculty');
        $semester = $request->get('semester_select');

        if($request->has('sem_subject_id')) {
            foreach ($request->get('sem_subject_id') as $key => $subject) {
                /*Find Subject Which is Already Scheduled*/
                $selectedSubject = ExamSchedule::where([
                                        ['years_id', '=' , $year],
                                        ['months_id', '=' , $month],
                                        ['exams_id', '=' , $exam],
                                        ['faculty_id', '=' , $faculty],
                                        ['semesters_id', '=' , $semester],
                                        ['subjects_id', '=' , $subject]
                                    ])
                                    ->first();

                if ($selectedSubject != null) {
                    /*Update Already Scheduled Subject*/
                    $subjectUpdate = [
                        'years_id' => $year,
                        'months_id' => $month,
                        'exams_id' => $exam,
                        'faculty_id' => $faculty,
                        'semesters_id' => $semester,
                        'subjects_id' => $subject,
                        'date' => $request->get('date')[$key],
                        'start_time' => $request->get('start_time')[$key],
                        'end_time' => $request->get('end_time')[$key],
                        'full_mark_theory' => $request->get('full_mark_theory')[$key]?$request->get('full_mark_theory')[$key]:0,
                        'pass_mark_theory' => $request->get('pass_mark_theory')[$key]?$request->get('pass_mark_theory')[$key]:0,
                        'full_mark_practical' => $request->get('full_mark_practical')[$key]?$request->get('full_mark_practical')[$key]:0,
                        'pass_mark_practical' => $request->get('pass_mark_practical')[$key]?$request->get('pass_mark_practical')[$key]:0,
                        'sorting_order' => $key+1,
                        'updated_by' => auth()->user()->id
                    ];

                    $selectedSubject->update($subjectUpdate);

                }else{
                    /*Schedule When Not Scheduled Yet*/
                    ExamSchedule::create([
                        'years_id' => $year,
                        'months_id' => $month,
                        'exams_id' => $exam,
                        'faculty_id' => $faculty,
                        'semesters_id' => $semester,
                        'subjects_id' => $subject,
                        'date' => $request->get('date')[$key],
                        'start_time' => $request->get('start_time')[$key],
                        'end_time' => $request->get('end_time')[$key],
                        'full_mark_theory' => $request->get('full_mark_theory')[$key]?$request->get('full_mark_theory')[$key]:0,
                        'pass_mark_theory' => $request->get('pass_mark_theory')[$key]?$request->get('pass_mark_theory')[$key]:0,
                        'full_mark_practical' => $request->get('full_mark_practical')[$key]?$request->get('full_mark_practical')[$key]:0,
                        'pass_mark_practical' => $request->get('pass_mark_practical')[$key]?$request->get('pass_mark_practical')[$key]:0,
                        'sorting_order' => $key+1,
                        'created_by' => auth()->user()->id,
                    ]);

                }
            }
            $request->session()->flash($this->message_success, $this->panel. ' Schedule Successfully.');
        }else{
            $request->session()->flash($this->message_warning, 'No Any Subject To Schedule.');
        }

        if($request->add_schedule_another) {
            return back();
        }else{
            return redirect()->route($this->base_route);
        }


    }

    public function delete(Request $request, $year=null,$month=null,$exam=null,$faculty=null,$semester=null)
    {
        $row = ExamSchedule::where([
                                ['years_id', '=' , $year],
                                ['months_id', '=' , $month],
                                ['exams_id', '=' , $exam],
                                ['faculty_id', '=' , $faculty],
                                ['semesters_id', '=' , $semester],
                            ])->get();

        if (!$row) return parent::invalidRequest();

        /*Get Subjects Ids as Arrays*/
        $deleteSchedule = array_pluck($row, 'id');

        $deleteQuery = ExamSchedule::whereIn('id',$deleteSchedule)->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

    public function active(Request $request, $year=null,$month=null,$exam=null,$faculty=null,$semester=null)
    {
        $row = ExamSchedule::where([
            ['years_id', '=' , $year],
            ['months_id', '=' , $month],
            ['exams_id', '=' , $exam],
            ['faculty_id', '=' , $faculty],
            ['semesters_id', '=' , $semester],
        ])->get();

        if (!$row) return parent::invalidRequest();

        /*Get Subjects Ids as Arrays*/
        $activeStatus = array_pluck($row, 'id');

        $status = $request->request->add(['status' => 'active']);

        ExamSchedule::whereIn('id', $activeStatus)->update([
            'status' => 1
        ]);

        $request->session()->flash($this->message_success, $this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(Request $request, $year=null,$month=null,$exam=null,$faculty=null,$semester=null)
    {
        $row = ExamSchedule::where([
            ['years_id', '=' , $year],
            ['months_id', '=' , $month],
            ['exams_id', '=' , $exam],
            ['faculty_id', '=' , $faculty],
            ['semesters_id', '=' , $semester],
        ])->get();

        if (!$row) return parent::invalidRequest();

        /*Get Subjects Ids as Arrays*/
        $activeStatus = array_pluck($row, 'id');

        $status = $request->request->add(['status' => 'active']);

        ExamSchedule::whereIn('id', $activeStatus)->update([
            'status' => 0
        ]);

        $request->session()->flash($this->message_success, $this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function subjectHtmlRow(Request $request)
    {
        //dd($request->all());;
        $response = [];
        $response['error'] = true;
        $whereCondition = [
                            ['years_id' , '=' , $request->get('years_id')],
                            ['months_id' , '=' , $request->get('months_id')],
                            ['exams_id', '=' , $request->get('exams_id')],
                            ['faculty_id', '=' , $request->get('faculty_id')],
                            ['semesters_id', '=' , $request->get('semester_id')]
                        ];
        if ($request->has('semester_id')) {
            //Get Subject From Schedule Examination
            $scheduledSubjects = ExamSchedule::select('subjects_id')
                ->where($whereCondition)
                ->get();

            /*Get Subjects Ids as Arrays*/
            $existSubject = array_pluck($scheduledSubjects, 'subjects_id');

            /*Get Semester Related Subjected Which is not scheduled*/
            $semester = Semester::find($request->get('semester_id'));

            if($existSubject) {
                /*Select Semester Subjects Which is not Scheduled Yet*/
                $subjects = $semester->subjects()->whereNotIn('subjects.id', $existSubject)->get();

                /*Get Scheduled Subject With Data*/
                $schedule = ExamSchedule::select('exam_schedules.subjects_id',
                    'exam_schedules.date', 'exam_schedules.start_time', 'exam_schedules.end_time',
                    'exam_schedules.full_mark_theory', 'exam_schedules.pass_mark_theory',
                    'exam_schedules.full_mark_practical',
                    'exam_schedules.pass_mark_practical','s.id as sub_id', 's.title')
                    ->where($whereCondition)
                    ->whereIn('exam_schedules.subjects_id', $existSubject)
                    ->join('subjects as s','s.id','=','exam_schedules.subjects_id')
                    ->orderBy('sorting_order','asc')
                    ->get();

                if ($schedule) {
                    $response['error'] = false;

                    $response['schedule'] = view($this->view_path.'.includes.subject_tr_rows', [
                        'schedules' => $schedule
                    ])->render();

                    $response['message'] = 'Operation Successful.';

                }

                if ($subjects) {
                    $response['error'] = false;

                    $response['html'] = view($this->view_path.'.includes.subject_tr', [
                        'subjects' => $subjects
                    ])->render();

                    $response['message'] = 'Operation Successful.';

                }
            }else{
                $subjects = $semester->subjects()->get();
                if ($subjects->count() >0) {
                    $response['error'] = false;

                    $response['html'] = view($this->view_path.'.includes.subject_tr', [
                        'subjects' => $subjects
                    ])->render();

                    $response['message'] = 'Operation Successful.';
                }else{
                    $response['message'] = 'Subject Not Assign on Semester.';
                }
            }

        } else{
            $response['message'] = $request->get('subject_id').'Invalid request!!';
        }

        return response()->json(json_encode($response));
    }

    public function publish(Request $request, $year=null,$month=null,$exam=null,$faculty=null,$semester=null)
    {
        $row = ExamSchedule::where([
            ['years_id', '=' , $year],
            ['months_id', '=' , $month],
            ['exams_id', '=' , $exam],
            ['faculty_id', '=' , $faculty],
            ['semesters_id', '=' , $semester],
        ])->get();

        if (!$row) return parent::invalidRequest();

        /*Get Subjects Ids as Arrays*/
        $examIds = array_pluck($row, 'id');

        $this->sendMarkAlert($examIds);

        ExamSchedule::whereIn('id', $examIds)->update([
            'publish_status' => 1
        ]);

        $request->session()->flash($this->message_success, 'Exam Result Publish Successfully.');
        return redirect()->route($this->base_route);
    }

    public function unPublish(Request $request, $year=null,$month=null,$exam=null,$faculty=null,$semester=null)
    {
        $row = ExamSchedule::where([
            ['years_id', '=' , $year],
            ['months_id', '=' , $month],
            ['exams_id', '=' , $exam],
            ['faculty_id', '=' , $faculty],
            ['semesters_id', '=' , $semester],
        ])->get();

        if (!$row) return parent::invalidRequest();

        /*Get Subjects Ids as Arrays*/
        $ids = array_pluck($row, 'id');


        ExamSchedule::whereIn('id', $ids)->update([
            'publish_status' => 0
        ]);

        $request->session()->flash($this->message_success, 'Exam Result UnPublish Successfully.');
        return redirect()->route($this->base_route);
    }

    //send alert on guardian mobile
    public function sendMarkAlert($examIds)
    {

        if($examIds){
            $data['ledger_exist'] = ExamMarkLedger::select('exam_mark_ledgers.exam_schedule_id', 'exam_mark_ledgers.students_id',
                'exam_mark_ledgers.obtain_mark_theory', 'exam_mark_ledgers.obtain_mark_practical', 'exam_mark_ledgers.absent_theory','exam_mark_ledgers.absent_practical',
                'exam_mark_ledgers.status', 's.id as student_id', 's.reg_no', 's.first_name', 's.middle_name', 's.last_name',
                's.last_name')
                ->where('exam_mark_ledgers.exam_schedule_id', $examIds)
                ->join('students as s', 's.id', '=', 'exam_mark_ledgers.students_id')
                ->orderBy('exam_mark_ledgers.students_id','asc')
                ->get();

            if($data['ledger_exist']){
                $data['exam_schedule_id'] = implode(',',$examIds);
            }

        }else{
            $data['exam_schedule_id'] = 0;
        }

        if ($data['ledger_exist']) {
            $student_id = $data['ledger_exist']->pluck('students_id');
            $exam_schedule_id = $examIds;
            $students = Student::select('students.id', 'students.faculty','students.semester', 'students.first_name', 'students.middle_name',
                'students.last_name', 'students.email', 'ai.mobile_1', 'gd.guardian_first_name',
                'gd.guardian_mobile_1', 'gd.guardian_email')
                ->whereIn('students.id', $student_id)
                ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
                ->join('student_guardians as sg', 'sg.students_id','=','students.id')
                ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
                ->get();


            //filter student with schedule subject markledger
            $filteredStudent  = $students->filter(function ($value, $key) use ($exam_schedule_id){
                $subject = $value->markLedger()
                    ->select( 'exam_schedule_id',  'obtain_mark_theory', 'obtain_mark_practical','absent_theory','absent_practical')
                    ->whereIn('exam_schedule_id', $exam_schedule_id)
                    ->get();

                //filter subject and joint mark from schedules;
                $filteredSubject  = $subject->filter(function ($subject, $key) {
                    $joinSub = $subject->examSchedule()
                        ->select('subjects_id','full_mark_theory', 'pass_mark_theory', 'full_mark_practical', 'pass_mark_practical','sorting_order')
                        ->first();

                    $subject->subjects_id = $joinSub->subjects_id;
                    $subject->sorting_order = $joinSub->sorting_order;
                    $subject->full_mark_theory = $joinSub->full_mark_theory;
                    $subject->pass_mark_theory = $joinSub->pass_mark_theory;
                    $subject->full_mark_practical = $joinSub->full_mark_practical;
                    $subject->pass_mark_practical = $joinSub->pass_mark_practical;
                    $th = $subject->obtain_mark_theory;
                    $pr = $subject->obtain_mark_practical;
                    $absent_theory = $subject->absent_theory;
                    $absent_practical = $subject->absent_practical;

                    //theory mark comparision
                    if(isset($subject->pass_mark_theory) && $subject->pass_mark_theory != null){
                        if($absent_theory == 1) {
                            $subject->obtain_mark_theory = "AB";
                        }else{
                            if(!is_numeric($th)){
                                $subject->obtain_mark_theory = "*";
                            }
                        }
                    }else{
                        $subject->obtain_mark_theory = "-";
                    }

                    //Practical mark comparision
                    if(isset($subject->pass_mark_practical) && $subject->pass_mark_practical != null){
                        if($absent_practical == 1) {
                            $subject->obtain_mark_practical = "AB";
                        }else{
                            if(!is_numeric($pr)){
                                $subject->obtain_mark_practical = "*";
                            }
                        }
                    }else{
                        $subject->obtain_mark_practical= "-";
                    }

                    //verify again the new obtain values are number or not
                    $th_new = $subject->obtain_mark_theory;
                    $pr_new = $subject->obtain_mark_practical;

                    $subject->total_obtain_mark = (is_numeric($th_new)?$th_new:0) + (is_numeric($pr_new)?$pr_new:0);

                    if($th_new >= $subject->pass_mark_theory && $pr_new >= $subject->pass_mark_practical){
                        $subject->remark = '';
                        if($subject->full_mark_theory != null && $th_new > $subject->full_mark_theory){
                            $subject->th_remark = '*N';
                            $subject->remark = '*';
                        }

                        if($subject->full_mark_practica != null && $pr_new > $subject->full_mark_practical){
                            $subject->pr_remark = '*N';
                            $subject->remark = '*';
                        }

                    }else{
                        $subject->remark = '*';

                        if($th_new < $subject->pass_mark_theory){
                            $subject->th_remark = '*';
                        }

                        if($pr_new < $subject->pass_mark_practical){
                            $subject->pr_remark = '*';
                        }

                        if($th_new > $subject->full_mark_theory){
                            $subject->th_remark = '*N';
                        }

                        if($pr_new > $subject->full_mark_practical){
                            $subject->pr_remark = '*N';
                        }

                    }

                    if($subject->obtain_mark_theory == "AB" || $subject->obtain_mark_practical == "AB"){
                        $subject->obtain_mark_theory = "ABSENT";
                    }

                    return $subject;
                });

                //$value->subjects = $filteredSubject;
                $value->subjects = $filteredSubject->sortBy('sorting_order');

                //calculate total mark & percentage
                $otm = array_pluck($value->subjects,'obtain_mark_theory');

                $filtered_otm  =  array_where($otm, function ($value, $key) {
                    return is_numeric($value);
                });
                $obtainedMarkTh = array_sum($filtered_otm);

                $omp = array_pluck($value->subjects,'obtain_mark_practical');
                $filtered_otp  =  array_where($omp, function ($value, $key) {
                    return is_numeric($value);
                });
                $obtainedMarkPr = array_sum($filtered_otp);


                $totalMark = $value->subjects->sum('full_mark_theory') + $value->subjects->sum('full_mark_practical');
                $obtainedMark = $obtainedMarkTh + $obtainedMarkPr;

                $value->total_mark_theory = $obtainedMarkTh;
                $value->total_mark_practical = $obtainedMarkPr;
                $value->total_obtain = $obtainedMark;
                //calculate percentage
                $value->percentage = ($obtainedMark*100)/ $totalMark;

                //generate message to send alert
                $examName = $this->getExamNameByScheduleId($exam_schedule_id);
                $examReportText = $examName.'. ';
                foreach ($value->subjects as $subject){
                    //verify again the new obtain values are number or not
                    $th_new = $subject->obtain_mark_theory;
                    $pr_new = $subject->obtain_mark_practical;
                    if($th_new == "AB" || $pr_new == "AB"){
                        $totalSubMark = "ABSENT";
                    }else{
                        $totalSubMark = (is_numeric($th_new)?$th_new:0) + (is_numeric($pr_new)?$pr_new:0);
                    }

                    $newSub = $this->getSubjectById($subject->subjects_id).'-'.$totalSubMark;
                    $examReportText = $examReportText.$newSub.',';
                }

                $remark = $value->subjects->pluck('remark')->toArray();
                $pr_remark = $value->subjects->pluck('pr_remark')->toArray();
                if(in_array('*',$remark) || in_array('*',$pr_remark)){
                    $resultStatus = "*Fail";
                }else{
                    $resultStatus = "Pass";
                }

                //final text preparation
                $examReportText = $examReportText.'Total-'.$value->total_obtain.',Result-'.$resultStatus;

                //prepare to send alert to Guardian
                $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','ExamScoreForGuardian')->first();
                if(!$alert) {

                }else{
                    //Dear Guardian, {{first_name}} has obtained the following marks in {{exam_mark_detail}}.
                    $subject = $alert->subject;
                    $message = str_replace('{{first_name}}', $value->first_name, $alert->template);
                    $message = str_replace('{{exam_mark_detail}}', $examReportText, $message);
                    $emailIds[] = $value->guardian_email;
                    $contactNumbers[] =$value->guardian_mobile_1;

                    //Now Send SMS On First Mobile Number
                    if($alert->sms == 1){
                        $contactNumbers = $this->contactFilter($contactNumbers);
                        $smssuccess = $this->sendSMS($contactNumbers,$message);
                    }

                    //Now Send Email With Subject
                    if($alert->email == 1){
                        $emailIds = $this->emailFilter($emailIds);
                        $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                    }

                }

                //prepare to send alert to Guardian
                $contactNumbers =[];
                $emailIds = [];
                $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','ExamScoreForStudent')->first();
                if(!$alert) {

                }else{
                    //Dear {{first_name}}, you have obtained following marks in {{exam_mark_detail}}.
                    $subject = $alert->subject;
                    $message = str_replace('{{first_name}}', $value->first_name, $alert->template);
                    $message = str_replace('{{exam_mark_detail}}', $examReportText, $message);
                    $contactNumbers[] =$value->mobile_1;
                    $emailIds[] = $value->email;

                    //Now Send SMS On First Mobile Number
                    if($alert->sms == 1){
                        $contactNumbers = $this->contactFilter($contactNumbers);
                        $smssuccess = $this->sendSMS($contactNumbers,$message);
                    }

                    //Now Send Email With Subject
                    if($alert->email == 1){
                        $emailIds = $this->emailFilter($emailIds);
                        $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                    }
                }

                return $value;
            });

            $data['student'] = $filteredStudent;

        }
        return redirect()->back();

    }

    //send alert on father mobile
    /*public function sendMarkAlert($examIds)
    {

        if($examIds){
            $data['ledger_exist'] = ExamMarkLedger::select('exam_mark_ledgers.exam_schedule_id', 'exam_mark_ledgers.students_id',
                'exam_mark_ledgers.obtain_mark_theory', 'exam_mark_ledgers.obtain_mark_practical', 'exam_mark_ledgers.absent_theory','exam_mark_ledgers.absent_practical',
                'exam_mark_ledgers.status', 's.id as student_id', 's.reg_no', 's.first_name', 's.middle_name', 's.last_name',
                's.last_name')
                ->where('exam_mark_ledgers.exam_schedule_id', $examIds)
                ->join('students as s', 's.id', '=', 'exam_mark_ledgers.students_id')
                ->orderBy('exam_mark_ledgers.students_id','asc')
                ->get();

            if($data['ledger_exist']){
                $data['exam_schedule_id'] = implode(',',$examIds);
            }

        }else{
            $data['exam_schedule_id'] = 0;
        }

        if ($data['ledger_exist']) {
            $student_id = $data['ledger_exist']->pluck('students_id');
            $exam_schedule_id = $examIds;
            $students = Student::select('students.id', 'students.faculty','students.semester', 'students.first_name', 'students.middle_name',
                'students.last_name', 'students.email', 'ai.mobile_1','pd.father_first_name','pd.father_mobile_1','pd.father_email')
                ->whereIn('students.id', $student_id)
                ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
                ->join('parent_details as pd', 'pd.students_id','=','students.id')
                ->get();


            //filter student with schedule subject markledger
            $filteredStudent  = $students->filter(function ($value, $key) use ($exam_schedule_id){
                $subject = $value->markLedger()
                    ->select( 'exam_schedule_id',  'obtain_mark_theory', 'obtain_mark_practical','absent_theory','absent_practical')
                    ->whereIn('exam_schedule_id', $exam_schedule_id)
                    ->get();

                //filter subject and joint mark from schedules;
                $filteredSubject  = $subject->filter(function ($subject, $key) {
                    $joinSub = $subject->examSchedule()
                        ->select('subjects_id','full_mark_theory', 'pass_mark_theory', 'full_mark_practical', 'pass_mark_practical','sorting_order')
                        ->first();

                    $subject->subjects_id = $joinSub->subjects_id;
                    $subject->sorting_order = $joinSub->sorting_order;
                    $subject->full_mark_theory = $joinSub->full_mark_theory;
                    $subject->pass_mark_theory = $joinSub->pass_mark_theory;
                    $subject->full_mark_practical = $joinSub->full_mark_practical;
                    $subject->pass_mark_practical = $joinSub->pass_mark_practical;
                    $th = $subject->obtain_mark_theory;
                    $pr = $subject->obtain_mark_practical;
                    $absent_theory = $subject->absent_theory;
                    $absent_practical = $subject->absent_practical;

                    //theory mark comparision
                    if(isset($subject->pass_mark_theory) && $subject->pass_mark_theory != null){
                        if($absent_theory == 1) {
                            $subject->obtain_mark_theory = "AB";
                        }else{
                            if(!is_numeric($th)){
                                $subject->obtain_mark_theory = "*";
                            }
                        }
                    }else{
                        $subject->obtain_mark_theory = "-";
                    }

                    //Practical mark comparision
                    if(isset($subject->pass_mark_practical) && $subject->pass_mark_practical != null){
                        if($absent_practical == 1) {
                            $subject->obtain_mark_practical = "AB";
                        }else{
                            if(!is_numeric($pr)){
                                $subject->obtain_mark_practical = "*";
                            }
                        }
                    }else{
                        $subject->obtain_mark_practical= "-";
                    }

                    //verify again the new obtain values are number or not
                    $th_new = $subject->obtain_mark_theory;
                    $pr_new = $subject->obtain_mark_practical;

                    $subject->total_obtain_mark = (is_numeric($th_new)?$th_new:0) + (is_numeric($pr_new)?$pr_new:0);

                    if($th_new >= $subject->pass_mark_theory && $pr_new >= $subject->pass_mark_practical){
                        $subject->remark = '';
                        if($subject->full_mark_theory != null && $th_new > $subject->full_mark_theory){
                            $subject->th_remark = '*N';
                            $subject->remark = '*';
                        }

                        if($subject->full_mark_practica != null && $pr_new > $subject->full_mark_practical){
                            $subject->pr_remark = '*N';
                            $subject->remark = '*';
                        }

                    }else{
                        $subject->remark = '*';

                        if($th_new < $subject->pass_mark_theory){
                            $subject->th_remark = '*';
                        }

                        if($pr_new < $subject->pass_mark_practical){
                            $subject->pr_remark = '*';
                        }

                        if($th_new > $subject->full_mark_theory){
                            $subject->th_remark = '*N';
                        }

                        if($pr_new > $subject->full_mark_practical){
                            $subject->pr_remark = '*N';
                        }

                    }

                    if($subject->obtain_mark_theory == "AB" || $subject->obtain_mark_practical == "AB"){
                        $subject->obtain_mark_theory = "ABSENT";
                    }

                    return $subject;
                });

                //$value->subjects = $filteredSubject;
                $value->subjects = $filteredSubject->sortBy('sorting_order');

                //calculate total mark & percentage
                $otm = array_pluck($value->subjects,'obtain_mark_theory');

                $filtered_otm  =  array_where($otm, function ($value, $key) {
                    return is_numeric($value);
                });
                $obtainedMarkTh = array_sum($filtered_otm);

                $omp = array_pluck($value->subjects,'obtain_mark_practical');
                $filtered_otp  =  array_where($omp, function ($value, $key) {
                    return is_numeric($value);
                });
                $obtainedMarkPr = array_sum($filtered_otp);


                $totalMark = $value->subjects->sum('full_mark_theory') + $value->subjects->sum('full_mark_practical');
                $obtainedMark = $obtainedMarkTh + $obtainedMarkPr;

                $value->total_mark_theory = $obtainedMarkTh;
                $value->total_mark_practical = $obtainedMarkPr;
                $value->total_obtain = $obtainedMark;
                //calculate percentage
                $value->percentage = ($obtainedMark*100)/ $totalMark;

                //generate message to send alert
                $examName = $this->getExamNameByScheduleId($exam_schedule_id);
                $examReportText = $examName.'. ';
                foreach ($value->subjects as $subject){
                    //verify again the new obtain values are number or not
                    $th_new = $subject->obtain_mark_theory;
                    $pr_new = $subject->obtain_mark_practical;
                    if($th_new == "AB" || $pr_new == "AB"){
                        $totalSubMark = "ABSENT";
                    }else{
                        $totalSubMark = (is_numeric($th_new)?$th_new:0) + (is_numeric($pr_new)?$pr_new:0);
                    }

                    $newSub = $this->getSubjectById($subject->subjects_id).'-'.$totalSubMark;
                    $examReportText = $examReportText.$newSub.',';
                }

                $remark = $value->subjects->pluck('remark')->toArray();
                $pr_remark = $value->subjects->pluck('pr_remark')->toArray();
                if(in_array('*',$remark) || in_array('*',$pr_remark)){
                    $resultStatus = "*Fail";
                }else{
                    $resultStatus = "Pass";
                }

                //final text preparation
                $examReportText = $examReportText.'Total-'.$value->total_obtain.',Result-'.$resultStatus;

                //prepare to send alert to Guardian
                $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','ExamScoreForGuardian')->first();
                if(!$alert) {

                }else{
                    //Dear Guardian, {{first_name}} has obtained the following marks in {{exam_mark_detail}}.
                    $subject = $alert->subject;
                    $message = str_replace('{{first_name}}', $value->first_name, $alert->template);
                    $message = str_replace('{{exam_mark_detail}}', $examReportText, $message);
                    $emailIds[] = $value->father_email;
                    $contactNumbers[] =$value->father_mobile_1;

                    //Now Send SMS On First Mobile Number
                    if($alert->sms == 1){
                        $contactNumbers = $this->contactFilter($contactNumbers);
                        $smssuccess = $this->sendSMS($contactNumbers,$message);
                    }

                    //Now Send Email With Subject
                    if($alert->email == 1){
                        $emailIds = $this->emailFilter($emailIds);
                        $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                    }

                }

                //prepare to send alert to Guardian
                $contactNumbers =[];
                $emailIds = [];
                $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','ExamScoreForStudent')->first();
                if(!$alert) {

                }else{
                    //Dear {{first_name}}, you have obtained following marks in {{exam_mark_detail}}.
                    $subject = $alert->subject;
                    $message = str_replace('{{first_name}}', $value->first_name, $alert->template);
                    $message = str_replace('{{exam_mark_detail}}', $examReportText, $message);
                    $contactNumbers[] =$value->mobile_1;
                    $emailIds[] = $value->email;

                    //Now Send SMS On First Mobile Number
                    if($alert->sms == 1){
                        $contactNumbers = $this->contactFilter($contactNumbers);
                        $smssuccess = $this->sendSMS($contactNumbers,$message);
                    }

                    //Now Send Email With Subject
                    if($alert->email == 1){
                        $emailIds = $this->emailFilter($emailIds);
                        $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                    }
                }

                return $value;
            });

            $data['student'] = $filteredStudent;

        }
        return redirect()->back();

    }*/

}