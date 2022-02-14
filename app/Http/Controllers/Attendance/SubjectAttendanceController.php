<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\CollegeBaseController;
use App\Models\AlertSetting;
use App\Models\Attendance;
use App\Models\AttendanceStatus;
use App\Models\Month;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SubjectAttendance;
use App\Models\Year;
use App\Traits\AcademicScope;
use App\Traits\SmsEmailScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nexmo\Message\Query;
use View, URL;

class SubjectAttendanceController extends CollegeBaseController
{
    protected $base_route = 'attendance.subject';
    protected $view_path = 'attendance.subject';
    protected $panel = 'Subject Attendance';
    protected $filter_query = [];

    use AcademicScope;
    use SmsEmailScope;

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];

        if($request->all()) {
            if(auth()->user()->hasRole('staff')) {
                $id = auth()->user()->id;
                $staffId = auth()->user()->hook_id;

                if($request->has('sem_subject')){
                    $teacherSubject = Subject::where('staff_id',$staffId)->where('id',$request->sem_subject)->first();

                    if(isset($teacherSubject)) {
                        $students = SubjectAttendance::select('subject_attendances.id', 'subject_attendances.subjects_id','subject_attendances.attendance_type', 'subject_attendances.link_id',
                            'subject_attendances.years_id', 'subject_attendances.months_id', 'subject_attendances.day_1', 'subject_attendances.day_2', 'subject_attendances.day_3',
                            'subject_attendances.day_4', 'subject_attendances.day_5', 'subject_attendances.day_6', 'subject_attendances.day_7', 'subject_attendances.day_8',
                            'subject_attendances.day_9', 'subject_attendances.day_10', 'subject_attendances.day_11', 'subject_attendances.day_12', 'subject_attendances.day_13',
                            'subject_attendances.day_14', 'subject_attendances.day_15', 'subject_attendances.day_16', 'subject_attendances.day_17', 'subject_attendances.day_18',
                            'subject_attendances.day_19', 'subject_attendances.day_20', 'subject_attendances.day_21', 'subject_attendances.day_22', 'subject_attendances.day_23',
                            'subject_attendances.day_24', 'subject_attendances.day_25', 'subject_attendances.day_26', 'subject_attendances.day_27', 'subject_attendances.day_28',
                            'subject_attendances.day_29', 'subject_attendances.day_30', 'subject_attendances.day_31','subject_attendances.day_32',
                            'students.id as students_id', 'students.reg_no',
                            'students.first_name', 'students.middle_name', 'students.last_name', 'students.faculty', 'students.semester')
                            ->where(function ($query) use ($request,$teacherSubject) {
                                $this->commonStudentFilterCondition($query, $request);

                                if ($request->has('year') && $request->get('year') != 0) {
                                    $query->where('subject_attendances.years_id', '=', $request->year);
                                    $this->filter_query['subject_attendances.years_id'] = $request->year;
                                }

                                if ($request->has('month') && $request->get('month') != 0) {
                                    $query->where('subject_attendances.months_id', '=', $request->month);
                                    $this->filter_query['subject_attendances.months_id'] = $request->month;
                                }

                                if ($request->has('sem_subject')) {
                                    $query->where('subject_attendances.subjects_id', '=', $teacherSubject->id);
                                    $this->filter_query['subject_attendances.subjects_id'] = $teacherSubject->id;
                                }

                                if ($request->has('attendance_type')) {
                                    $query->where('subject_attendances.attendance_type', '=', $request->attendance_type);
                                    $this->filter_query['subject_attendances.attendance_type'] = $request->attendance_type;
                                }


                            })
                            ->join('students', 'students.id', '=', 'subject_attendances.link_id')
                            ->orderBy('subject_attendances.years_id','asc')
                            ->orderBy('subject_attendances.months_id','asc')
                            ->orderBy('students.id','asc')
                            ->orderBy('subject_attendances.subjects_id','asc')
                            ->orderBy('subject_attendances.attendance_type','asc')
                            ->get();
                    }else{
                        $request->session()->flash($this->message_warning, 'You are not a valid Staff for target Subject.');
                    }
                }else{
                    $request->session()->flash($this->message_warning, 'Please Filter Attendance with Subject.');
                }

            }else{
                $students = SubjectAttendance::select('subject_attendances.id', 'subject_attendances.subjects_id','subject_attendances.attendance_type', 'subject_attendances.link_id',
                    'subject_attendances.years_id', 'subject_attendances.months_id', 'subject_attendances.day_1', 'subject_attendances.day_2', 'subject_attendances.day_3',
                    'subject_attendances.day_4', 'subject_attendances.day_5', 'subject_attendances.day_6', 'subject_attendances.day_7', 'subject_attendances.day_8',
                    'subject_attendances.day_9', 'subject_attendances.day_10', 'subject_attendances.day_11', 'subject_attendances.day_12', 'subject_attendances.day_13',
                    'subject_attendances.day_14', 'subject_attendances.day_15', 'subject_attendances.day_16', 'subject_attendances.day_17', 'subject_attendances.day_18',
                    'subject_attendances.day_19', 'subject_attendances.day_20', 'subject_attendances.day_21', 'subject_attendances.day_22', 'subject_attendances.day_23',
                    'subject_attendances.day_24', 'subject_attendances.day_25', 'subject_attendances.day_26', 'subject_attendances.day_27', 'subject_attendances.day_28',
                    'subject_attendances.day_29', 'subject_attendances.day_30', 'subject_attendances.day_31','subject_attendances.day_32',
                    'students.id as students_id', 'students.reg_no',
                    'students.first_name', 'students.middle_name', 'students.last_name', 'students.faculty', 'students.semester')
                    ->where(function ($query) use ($request) {
                        $this->commonStudentFilterCondition($query, $request);

                        if ($request->has('year') && $request->get('year') != 0) {
                            $query->where('subject_attendances.years_id', '=', $request->year);
                            $this->filter_query['subject_attendances.years_id'] = $request->year;
                        }

                        if ($request->has('month') && $request->get('month') != 0) {
                            $query->where('subject_attendances.months_id', '=', $request->month);
                            $this->filter_query['subject_attendances.months_id'] = $request->month;
                        }

                        if ($request->has('sem_subject')) {
                            $query->where('subject_attendances.subjects_id', '=', $request->sem_subject);
                            $this->filter_query['subject_attendances.subjects_id'] = $request->sem_subject;
                        }

                        if ($request->has('attendance_type')) {
                            $query->where('subject_attendances.attendance_type', '=', $request->attendance_type);
                            $this->filter_query['subject_attendances.attendance_type'] = $request->attendance_type;
                        }


                    })
                    ->join('students', 'students.id', '=', 'subject_attendances.link_id')
                    ->orderBy('subject_attendances.years_id','asc')
                    ->orderBy('subject_attendances.months_id','asc')
                    ->orderBy('students.id','asc')
                    ->orderBy('subject_attendances.subjects_id','asc')
                    /*->orderBy('subject_attendances.attendance_type','asc')*/
                    ->get();
            }
        }


        $attendanceStatus = AttendanceStatus::get();
        if(isset($students)){
            $filteredStudent = $students->filter(function ($student, $key) use($attendanceStatus) {
            for ($day = 1; $day <= 32; $day++) {
                $dayCode = "day_".$day;
                foreach ($attendanceStatus as $attenStatus){
                    if($student->$dayCode == $attenStatus->id){
                        $attenTitle = $attenStatus->title;
                        $student->$attenTitle = $student->$attenTitle + 1;
                    }
                }
            }

                return $student;
            });

            $data['student'] = $filteredStudent;
        }

        $data['attendanceStatus'] = $attendanceStatus;
        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();
        $data['years'] = $this->activeYears();
        $data['months'] = $this->activeMonths();
        $data['subject'] = $this->allSubjectsList();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];
        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['attendance_status'] = AttendanceStatus::get();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(Request $request)
    {
        $response = [];
        $response['error'] = true;
        $date = Carbon::parse($request->get('date'));
        $month = Carbon::createFromFormat('Y-m-d H:i:s', $date)->month;
        $day = "day_".Carbon::createFromFormat('Y-m-d H:i:s', $date)->day;
        $yearTitle = Carbon::createFromFormat('Y-m-d H:i:s', $date)->year;
        $year = Year::where('title',$yearTitle)->first()->id;

        $attendanceStatus = AttendanceStatus::get();

        $faculty = $request->get('faculty');
        $semester = $request->get('semester_select');
        $subject = $request->get('subjects_id');
        $attendance_type = $request->get('attendance_type');
        //dd($request->all());
        if($request->has('students_id')) {
            foreach (array_unique($request->get('students_id')) as $student) {
                $attendanceExist = SubjectAttendance::select('subject_attendances.id','subject_attendances.link_id','subject_attendances.subjects_id','subject_attendances.attendance_type',
                    'subject_attendances.years_id','subject_attendances.months_id','subject_attendances.'.$day,
                    's.id as students_id','s.reg_no','s.first_name','s.middle_name','s.last_name','s.student_image')
                    ->where('subject_attendances.subjects_id',$subject)
                    ->where('subject_attendances.attendance_type',$attendance_type)
                    ->where('subject_attendances.years_id',$year)
                    ->where('subject_attendances.months_id',$month)
                    ->where('s.id' ,'=', $student)
                    ->join('students as s','s.id','=','subject_attendances.link_id')
                    ->first();

                /*get ledger exist student id*/
                if ($attendanceExist) {
                    /*Update Already Register Attendance Ledger*/
                    $Update = [
                        $day => $request->get($student),
                        'last_updated_by' => auth()->user()->id
                    ];
                    $updateResult = SubjectAttendance::find($attendanceExist->id)->update($Update);
                }else{
                    $Create = [
                                'attendance_type' => $attendance_type,
                                'link_id' => $student,
                                'subjects_id' => $subject,
                                'years_id' => $year,
                                'months_id' => $month,
                                $day => $request->get($student),
                                'created_by' => auth()->user()->id,
                            ];
                    $success =  SubjectAttendance::create($Create);
                }

                //enable if you want to make regular attendance absent. if student absent on subject attendance.
                /*if($request->get($student) == 2){
                    $regularAttendanceExist = Attendance::select('attendances.id','attendances.attendees_type','attendances.link_id',
                        'attendances.years_id','attendances.months_id','attendances.'.$day,
                        's.id as students_id','s.reg_no','s.first_name','s.middle_name','s.last_name','s.student_image')
                        ->where('attendances.attendees_type',1)
                        ->where('attendances.years_id',$year)
                        ->where('attendances.months_id',$month)
                        ->where('s.id', '=' , $student)
                        ->join('students as s','s.id','=','attendances.link_id')
                        ->first();

                    //get ledger exist student id
                    if ($regularAttendanceExist) {
                        //Update Already Register Attendance Ledger
                        $Update = [
                            $day => $request->get($student),
                            'last_updated_by' => auth()->user()->id
                        ];
                        $updateResult = Attendance::find($regularAttendanceExist->id)->update($Update);
                    }else{
                        $Create = [
                            'attendees_type' => 1,
                            'link_id' => $student,
                            'years_id' => $year,
                            'months_id' => $month,
                            $day => $request->get($student),
                            'created_by' => auth()->user()->id,
                        ];
                        $success =  Attendance::create($Create);
                    }
                }*/

            }

            /*confirmation*/
            if($request->has('send_alert') && $request->get('send_alert') ==1){
                $this->attendanceConfirm($semester,$date);
            }

            /*Absent confirmation*/
            if($request->has('send_alert') && $request->get('send_alert') ==2){
                $this->attendanceAbsentConfirm($semester,$date,$subject);
            }

            $request->session()->flash($this->message_success, $this->panel. ' Managed Successfully.');
            return redirect()->back();
        }else{
            $request->session()->flash($this->message_warning, 'You Have No Any Student to Managed Attendance. ');
            return back();
        }

        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = SubjectAttendance::find($id)) return parent::invalidRequest();

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
                            $row = SubjectAttendance::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = SubjectAttendance::find($row_id);
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

    public function findSubject(Request $request)
    {
        $semester = Semester::where('id',$request->get('semester_id'))->first();

        if(auth()->user()->hasRole('staff')){
            $id = auth()->user()->hook_id;
            /*Find Teacher/Staff Accessible Subject*/
            $collectSubject = $semester->subjects()->select('subjects.id as subject_id','subjects.title as subject_title')
                ->where('subjects.staff_id',$id)
                ->get();
            $subjects = array_pluck($collectSubject,'subject_title','subject_id');
        }else{
            /*Find Subject Title with associated Ids*/
            $collectSubject = $semester->subjects()->select('subjects.id as subject_id','subjects.title as subject_title')->get();
            $subjects = array_pluck($collectSubject,'subject_title','subject_id');
        }


        if ($subjects) {
            $response['subjects'] = $subjects;
            $response['success'] = 'Subjects Found, Select Subject and Manage Download.';
        }else {
            $response['error'] = 'No Any Subject Found to Manage Attendance. Please Contact Your Administrator.';
        }

        return response()->json(json_encode($response));
    }

    public function studentHtmlRow(Request $request)
    {
        $response = [];
        $response['error'] = true;
        $date = Carbon::parse($request->get('date'));
        $month = Carbon::createFromFormat('Y-m-d H:i:s', $date)->month;
        $day = "day_".Carbon::createFromFormat('Y-m-d H:i:s', $date)->day;
        $yearTitle = Carbon::createFromFormat('Y-m-d H:i:s', $date)->year;
        $year = Year::where('title',$yearTitle)->first()->id;

        $attendanceStatus = AttendanceStatus::get();

        $faculty = $request->get('faculty_id');
        $semester = $request->get('semester_id');
        $subject = $request->get('sem_subject');
        $attendance_type = $request->get('attendance_type');
        $batch = $request->get('batch') > 0?$request->get('batch'):'';

        //Check semester/Sec Teacher/Staff valid or not
        if(auth()->user()->hasRole('staff')) {
            $id = auth()->user()->id;
            $staffId = auth()->user()->hook_id;

            if($request->has('sem_subject')){
                $teacherSubject = Subject::where('staff_id',$staffId)->where('id',$request->sem_subject)->first();

                if(isset($teacherSubject)) {
                    /*For Student List*/
                    $studentCondition = $batch!=''?[['s.faculty', '=' , $faculty], ['s.semester', '=' , $semester], ['s.batch', '=' , $batch] ]:[['s.faculty', '=' , $faculty], ['s.semester', '=' , $semester] ];

                    $attendanceExist = SubjectAttendance::select('subject_attendances.attendance_type','subject_attendances.link_id',
                        'subject_attendances.years_id','subject_attendances.months_id','subject_attendances.'.$day,
                        's.id as students_id','s.reg_no','s.first_name','s.middle_name','s.last_name','s.student_image')
                        ->where('subject_attendances.attendance_type',$attendance_type)
                        ->where('subject_attendances.years_id',$year)
                        ->where('subject_attendances.months_id',$month)
                        ->where('subject_attendances.subjects_id',$teacherSubject->id)
                        ->where($day,'<>',0)
                        ->where($studentCondition)
                        ->join('students as s','s.id','=','subject_attendances.link_id')
                        ->get();

                    /*get ledger exist student id*/
                    $dayStatus  = array_pluck($attendanceExist, $day);
                    $existStudentId  = array_pluck($attendanceExist, 'students_id');

                    $studentCondition = $batch!=''?[['faculty', '=' , $faculty], ['semester', '=' , $semester], ['batch', '=' , $batch] ]:[['faculty', '=' , $faculty], ['semester', '=' , $semester] ];

                    //Get Active Student For Related Faculty and Semester
                    $activeStudent = Student::select('id','reg_no','first_name','middle_name','last_name','student_image')
                        ->where($studentCondition)
                        ->whereNotIn('id',$existStudentId)
                        ->Active()
                        ->orderBy('id','asc')
                        ->get();


                    if($activeStudent->count() > 0 || $attendanceExist->count() > 0) {
                        if($attendanceExist){
                            $response['error'] = false;

                            $response['exist'] = view($this->view_path.'.includes.student_tr_rows', [
                                'exist' => $attendanceExist,
                                'attendanceStatus' => $attendanceStatus,
                                'dayStatus' => $dayStatus,
                                'day' => $day,
                            ])->render();

                            $response['students'] = view($this->view_path.'.includes.student_tr', [
                                'students' => $activeStudent,
                                'attendanceStatus' => $attendanceStatus
                            ])->render();

                            $response['message'] = 'Active Students Found. Please, Managed Attendance.';
                        }else{
                            $response['error'] = false;

                            $response['students'] = view($this->view_path.'.includes.student_tr', [
                                'students' => $activeStudent
                            ])->render();

                            $response['message'] = 'Active Students Found. Please, Managed Attendance.';
                        }
                    }else{
                        $response['error'] = 'Student not found or you have not the right to manage attendance.';
                    }
                }else{
                    $response['error'] = 'Student not found or you have not the right to manage attendance.';
                }

            }



        }else{
            /*For Student List*/
            $studentCondition = $batch!=''?[['s.faculty', '=' , $faculty], ['s.semester', '=' , $semester], ['s.batch', '=' , $batch] ]:[['s.faculty', '=' , $faculty], ['s.semester', '=' , $semester] ];

            $attendanceExist = SubjectAttendance::select('subject_attendances.attendance_type','subject_attendances.link_id',
                'subject_attendances.years_id','subject_attendances.months_id','subject_attendances.'.$day,
                's.id as students_id','s.reg_no','s.first_name','s.middle_name','s.last_name','s.student_image')
                ->where('subject_attendances.attendance_type',$attendance_type)
                ->where('subject_attendances.subjects_id',$subject)
                ->where('subject_attendances.years_id',$year)
                ->where('subject_attendances.months_id',$month)
                ->where($day,'<>',0)
                ->where($studentCondition)
                ->join('students as s','s.id','=','subject_attendances.link_id')
                ->get();

            /*get ledger exist student id*/
            $dayStatus  = array_pluck($attendanceExist, $day);
            $existStudentId  = array_pluck($attendanceExist, 'students_id');

            //Get Active Student For Related Faculty and Semester
            $studentCondition = $batch!=''?[['faculty', '=' , $faculty], ['semester', '=' , $semester], ['batch', '=' , $batch] ]:[['faculty', '=' , $faculty], ['semester', '=' , $semester] ];

            $activeStudent = Student::select('id','reg_no','first_name','middle_name','last_name','student_image')
                ->where($studentCondition)
                ->whereNotIn('id',$existStudentId)
                ->Active()
                ->orderBy('id','asc')
                ->get();

            if($activeStudent) {
                if($attendanceExist){
                    $response['error'] = false;

                    $response['exist'] = view($this->view_path.'.includes.student_tr_rows', [
                        'exist' => $attendanceExist,
                        'attendanceStatus' => $attendanceStatus,
                        'dayStatus' => $dayStatus,
                        'day' => $day,
                    ])->render();

                    $response['students'] = view($this->view_path.'.includes.student_tr', [
                        'students' => $activeStudent,
                        'attendanceStatus' => $attendanceStatus
                    ])->render();

                    $response['message'] = 'Active Students Found. Please, Managed Attendance.';
                }else{
                    $response['error'] = false;

                    $response['students'] = view($this->view_path.'.includes.student_tr', [
                        'students' => $activeStudent
                    ])->render();

                    $response['message'] = 'Active Students Found. Please, Managed Attendance.';
                }
            }else{
                $response['error'] = 'No Any Active Students in This Faculty/Semester.';
            }
        }


        return response()->json(json_encode($response));
    }


    //alert
    public function alert(Request $request)
    {
        $data = [];
        $data['faculties'] = $this->activeFaculties();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.alert'), compact('data'));
    }

    //Send Attendance Alert on Guardian Mobile
    public function alertSend(Request $request)
    {
        $date = Carbon::parse($request->date);
        $faculty = $request->faculty;
        $semester = $request->semester_select;

        $month = Carbon::createFromFormat('Y-m-d H:i:s', $date)->month;
        $day = "day_".Carbon::createFromFormat('Y-m-d H:i:s', $date)->day;
        $yearTitle = Carbon::createFromFormat('Y-m-d H:i:s', $date)->year;
        $year = Year::where('title',$yearTitle)->first()->id;

        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','SubjectAttendance')->first();
        if(!$alert)
            return back()->with($this->message_warning, "Alert Setting not Setup. Contact Admin For More Detail.");

        $sms = false;
        $email = false;

        $attendanceExist = SubjectAttendance::select('subject_attendances.id','subject_attendances.link_id','subject_attendances.subjects_id', 'subject_attendances.attendance_type',
            'subject_attendances.years_id','subject_attendances.months_id','subject_attendances.'.$day,
            's.id as students_id','s.first_name as student_name','gd.guardian_first_name','gd.guardian_mobile_1','gd.guardian_email')
            ->where('subject_attendances.years_id',$year)
            ->where('subject_attendances.months_id',$month)
            ->where('subject_attendances.'.$day,2)//2 for absent
            ->where('s.faculty', $faculty)
            ->where('s.semester', $semester)
            ->join('students as s','s.id','=','subject_attendances.link_id')
            ->join('student_guardians as sg', 'sg.students_id','=','s.id')
            ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
            ->get();

        $linkId = array_unique($attendanceExist->pluck('link_id')->toArray());

        $studentData = Student::select('students.id','students.first_name as student_name','gd.guardian_first_name','gd.guardian_mobile_1','gd.guardian_email')
                        ->whereIn('students.id',$linkId)
                        ->join('student_guardians as sg', 'sg.students_id','=','students.id')
                        ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
                        ->get();

        $filterStudent = $studentData->filter(function ($student, $key) use($date,$day,$alert) {
            $subThAttendance = SubjectAttendance::select($day)->where('link_id',$student->id)->where('attendance_type',1)->get();
            $thAbsent = $subThAttendance->where($day,2)->count($day);
            $subPrAttendance = SubjectAttendance::select($day)->where('link_id',$student->id)->where('attendance_type',2)->get();
            $prAbsent = $subPrAttendance->where($day,2)->count($day);
            $abSentStatus = 'THEORY-'.$thAbsent.' & PRACTICAL-'.$prAbsent;

            //Dear {{guardian_name}}, your child {{first_name}} was Absent in {{absent_status}} subjects attendance on {{date}}.
            $subject = $alert->subject;
            $guardianName = $student->guardian_first_name;
            $Name = $student->student_name;
            $guardianContact = $student->guardian_mobile_1;
            $guardianEmail = $student->guardian_email;
            $message = str_replace('{{guardian_name}}', $guardianName, $alert->template);
            $message = str_replace('{{first_name}}', $Name, $message);
            $message = str_replace('{{absent_status}}', $abSentStatus, $message);
            $message = str_replace('{{date}}', Carbon::parse($date)->format('M d, Y'), $message);

            //Now Send SMS On First Mobile Number
            if ($alert->sms == 1 && isset($guardianContact)) {
                $contactNumbers = array($guardianContact);
                $contactNumbers = $this->contactFilter($contactNumbers);
                $smssuccess = $this->sendSMS($contactNumbers, $message);
                $sms = true;
            }

            if ($alert->email == 1 && isset($guardianEmail)) {
                $emailIds = array($guardianEmail);
                $emailIds = $this->emailFilter($emailIds);
                $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                $email = true;
            }
        });

        return back()->with($this->message_success, "Subject Attendance Alert Send Successfully.");
    }

    //Send Attendance Alert on Father Mobile
    /*public function alertSend(Request $request)
    {
        $date = Carbon::parse($request->date);
        $faculty = $request->faculty;
        $semester = $request->semester_select;

        $month = Carbon::createFromFormat('Y-m-d H:i:s', $date)->month;
        $day = "day_".Carbon::createFromFormat('Y-m-d H:i:s', $date)->day;
        $yearTitle = Carbon::createFromFormat('Y-m-d H:i:s', $date)->year;
        $year = Year::where('title',$yearTitle)->first()->id;

        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','SubjectAttendance')->first();
        if(!$alert)
            return back()->with($this->message_warning, "Alert Setting not Setup. Contact Admin For More Detail.");

        $sms = false;
        $email = false;

        $attendanceExist = SubjectAttendance::select('subject_attendances.id','subject_attendances.link_id','subject_attendances.subjects_id', 'subject_attendances.attendance_type',
            'subject_attendances.years_id','subject_attendances.months_id','subject_attendances.'.$day,
            's.id as students_id','s.first_name as student_name','pd.father_first_name','pd.father_mobile_1','pd.father_email')
            ->where('subject_attendances.years_id',$year)
            ->where('subject_attendances.months_id',$month)
            ->where('subject_attendances.'.$day,2)//2 for absent
            ->where('s.faculty', $faculty)
            ->where('s.semester', $semester)
            ->join('students as s','s.id','=','subject_attendances.link_id')
            ->join('parent_details as pd', 'pd.students_id','=','s.id')
            ->get();

        $linkId = array_unique($attendanceExist->pluck('link_id')->toArray());

        $studentData = Student::select('students.id','students.first_name as student_name','pd.father_first_name','pd.father_mobile_1','pd.father_email')
            ->whereIn('students.id',$linkId)
            ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
            ->get();

        $filterStudent = $studentData->filter(function ($student, $key) use($date,$day,$alert) {
            $subThAttendance = SubjectAttendance::select($day)->where('link_id',$student->id)->where('attendance_type',1)->get();
            $thAbsent = $subThAttendance->where($day,2)->count($day);
            $subPrAttendance = SubjectAttendance::select($day)->where('link_id',$student->id)->where('attendance_type',2)->get();
            $prAbsent = $subPrAttendance->where($day,2)->count($day);
            $abSentStatus = 'THEORY-'.$thAbsent.' & PRACTICAL-'.$prAbsent;

            //Dear {{guardian_name}}, your child {{first_name}} was Absent in {{absent_status}} subjects attendance on {{date}}.
            $subject = $alert->subject;
            $guardianName = $student->father_first_name;
            $Name = $student->student_name;
            $guardianContact = $student->father_mobile_1;
            $guardianEmail = $student->father_email;
            $message = str_replace('{{guardian_name}}', $guardianName, $alert->template);
            $message = str_replace('{{first_name}}', $Name, $message);
            $message = str_replace('{{absent_status}}', $abSentStatus, $message);
            $message = str_replace('{{date}}', Carbon::parse($date)->format('M d, Y'), $message);

            //Now Send SMS On First Mobile Number
            if ($alert->sms == 1 && isset($guardianContact)) {
                $contactNumbers = array($guardianContact);
                $contactNumbers = $this->contactFilter($contactNumbers);
                $smssuccess = $this->sendSMS($contactNumbers, $message);
                $sms = true;
            }

            if ($alert->email == 1 && isset($guardianEmail)) {
                $emailIds = array($guardianEmail);
                $emailIds = $this->emailFilter($emailIds);
                $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                $email = true;
            }
        });

        return back()->with($this->message_success, "Subject Attendance Alert Send Successfully.");
    }*/

    //Extra
    /*public function attendanceAbsentConfirm($semester, $date, $subject)
    {
        $month = Carbon::createFromFormat('Y-m-d H:i:s', $date)->month;
        $day = "day_".Carbon::createFromFormat('Y-m-d H:i:s', $date)->day;
        $yearTitle = Carbon::createFromFormat('Y-m-d H:i:s', $date)->year;
        $year = Year::where('title',$yearTitle)->first()->id;


        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','SubjectAttendance')->first();
        if(!$alert)
            return back()->with($this->message_warning, "Alert Setting not Setup. Contact Admin For More Detail.");

        $sms = false;
        $email = false;

        $attendanceExist = SubjectAttendance::select('subject_attendances.id','subject_attendances.link_id','subject_attendances.subjects_id', 'subject_attendances.attendance_type',
            'subject_attendances.years_id','subject_attendances.months_id','subject_attendances.'.$day,
            's.id as students_id','s.first_name as student_name','gd.guardian_first_name','gd.guardian_mobile_1','gd.guardian_email')
            ->where('subject_attendances.subjects_id',$subject)
            ->where('subject_attendances.years_id',$year)
            ->where('subject_attendances.months_id',$month)
            ->where('subject_attendances.'.$day,2)//2 for absent
            ->where('s.semester', $semester)
            ->join('students as s','s.id','=','subject_attendances.link_id')
            ->join('student_guardians as sg', 'sg.students_id','=','s.id')
            ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
            ->get();

        dd($subject);

        //Dear Guardian, your child {{first_name}} was Absent in theory :{{absent_theory}} & practical: {{absent_practical}} subject on {{date}}.
        if($attendanceExist && $attendanceExist->count() > 0) {
            foreach ($attendanceExist as $attendance) {
                $subject = $alert->subject;
                $Name = $attendance->student_name;
                $guardianContact = $attendance->guardian_mobile_1;
                $guardianEmail = $attendance->guardian_email;
                $message = str_replace('{{first_name}}', $Name, $alert->template);
                $message = str_replace('{{date}}', Carbon::parse($date)->format('M d , Y'), $message);

                dd($message);
                //Now Send SMS On First Mobile Number
                if ($alert->sms == 1 && isset($guardianContact)) {
                    $contactNumbers = array($guardianContact);
                    $contactNumbers = $this->contactFilter($contactNumbers);
                    $smssuccess = $this->sendSMS($contactNumbers, $message);
                    $sms = true;
                }

                if ($alert->email == 1 && isset($guardianEmail)) {
                    $emailIds = array($guardianEmail);
                    $emailIds = $this->emailFilter($emailIds);
                    $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                    $email = true;
                }

            }

        }

    }*/

}