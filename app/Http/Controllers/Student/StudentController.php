<?php

/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Student;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Student\Registration\AddValidation;
use App\Http\Requests\Student\Registration\EditValidation;
use App\Jobs\AllEmail;
use App\Models\AcademicInfo;
use App\Models\Addressinfo;
use App\Models\AlertSetting;
use App\Models\Attendance;
use App\Models\AttendanceStatus;
use App\Models\BookIssue;
use App\Models\Document;
use App\Models\Faculty;
use App\Models\GuardianDetail;
use App\Models\LibraryMember;
use App\Models\Note;
use App\Models\ParentDetail;
use App\Models\ResidentHistory;
use App\Models\Student;
use App\Models\StudentAddressinfo;
use App\Models\StudentGuardian;
use App\Models\StudentParent;
use App\Models\SubjectAttendance;
use App\Models\TransportHistory;
use App\Models\Year;
use App\Traits\SmsEmailScope;
use App\Traits\UserScope;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Image, URL;
use ViewHelper;

class StudentController extends CollegeBaseController
{
    protected $base_route = 'student';
    protected $view_path = 'student';
    protected $panel = 'Students';
    protected $folder_path;
    protected $folder_name = 'studentProfile';
    protected $filter_query = [];

    use SmsEmailScope;
    use UserScope;

    public function __construct()
    {
        $this->folder_path = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$this->folder_name.DIRECTORY_SEPARATOR;
    }

    public function index(Request $request)
    {
        $data = [];
        if($request->all()) {
            $data['student'] = Student::select('students.id', 'students.reg_no', 'students.reg_date',
                'students.faculty', 'students.semester', 'students.batch', 'students.academic_status',
                'students.first_name', 'students.middle_name', 'students.last_name', 'students.status')
                ->where(function ($query) use ($request) {
                    $this->commonStudentFilterCondition($query, $request);
                })
                ->get();
        }else{
            $data['student'] = Student::select('students.id', 'students.reg_no', 'students.reg_date',
                'students.faculty', 'students.semester', 'students.batch', 'students.academic_status',
                'students.first_name', 'students.middle_name', 'students.last_name', 'students.status')
                ->Active()
                ->get();
        }

        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();

        //for Quick services Creation
        /*Hostel List*/
        $data['hostels'] = $this->activeHostel();
        /*Transport Route List*/
        $data['routes'] = $this->activeTransportRoutes();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function registration()
    {
        $data = [];
        $data['blank_ins'] = new Student();

        $data['faculties'] = $this->activeFaculties();
        $data['semester'] = $this->activeSemester();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();

        return view(parent::loadDataToView($this->view_path.'.registration.register'), compact('data'));
    }

    public function register(AddValidation $request)
    {
        if(!isset($request->reg_no)){
            //RegNo Generator Start
            $oldStudent = Student::where('faculty',$request->faculty)->orderBy('id', 'DESC')->first();
            if (!$oldStudent){
                $sn = 1;
            }else{
                $oldReg = intval(substr($oldStudent->reg_no,-4));
                $sn = $oldReg + 1;
            }

            $sn = substr("00000{$sn}", -4);
            $year = intval(substr(Year::where('active_status','=',1)->first()->title,-2));
            $faculty = Faculty::find(intval($request->faculty));
            $facultyCode = $faculty->faculty_code;
            //$regNum = $faculty.'-'.$year.'-'.$sn;
            $regNum = $facultyCode.$year.$sn;
            //reg generator End
            $request->request->add(['reg_no' => $regNum]);
        }else{
            $request->request->add(['reg_no' => $request->reg_no]);
        }

        if ($request->hasFile('student_main_image')){
            $student_image = $request->file('student_main_image');
            $student_image_name = $request->reg_no.'.'.$student_image->getClientOriginalExtension();
            $student_image->move(public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'studentProfile'.DIRECTORY_SEPARATOR, $student_image_name);
        }else{
            $student_image_name = "";
        }

        if ($request->hasFile('student_signature_main_image')){
            $student_signature_image = $request->file('student_signature_main_image');
            $student_signature_image_name = $request->reg_no.'_signature.'.$student_signature_image->getClientOriginalExtension();
            $student_signature_image->move(public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'studentProfile'.DIRECTORY_SEPARATOR, $student_signature_image_name);
        }else{
            $student_signature_image_name = "";
        }

        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['semester' => $request->get('semester')]);
        $request->request->add(['student_image' => $student_image_name]);
        $request->request->add(['student_signature' => $student_signature_image_name]);

        $student = Student::create($request->all());

        $parential_image_path = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'parents'.DIRECTORY_SEPARATOR;

        if ($request->hasFile('father_main_image')){
            $father_image = $request->file('father_main_image');
            $father_image_name = $student->reg_no.'_father.'.$father_image->getClientOriginalExtension();
            $father_image->move($parential_image_path, $father_image_name);
        }else{
            $father_image_name = "";
        }

        if ($request->hasFile('mother_main_image')){
            $mother_image = $request->file('mother_main_image');
            $mother_image_name = $student->reg_no.'_mother.'.$mother_image->getClientOriginalExtension();
            $mother_image->move($parential_image_path, $mother_image_name);
        }else{
            $mother_image_name = "";
        }

        if ($request->hasFile('guardian_main_image')){
            $guardian_image = $request->file('guardian_main_image');
            $guardian_image_name = $student->reg_no.'_guardian.'.$guardian_image->getClientOriginalExtension();
            $guardian_image->move($parential_image_path, $guardian_image_name);
        }else{
            $guardian_image_name = "";
        }

        $request->request->add(['father_image' => $father_image_name]);
        $request->request->add(['mother_image' => $mother_image_name]);
        $request->request->add(['guardian_image' => $guardian_image_name]);

        $request->request->add(['students_id' => $student->id]);
        $addressinfo = Addressinfo::create($request->all());
        $parentdetail = ParentDetail::create($request->all());

        if($request->guardian_link_id == null){
            $guardian = GuardianDetail::create($request->all());
            $studentGuardian = StudentGuardian::create([
                'students_id' => $student->id,
                'guardians_id' => $guardian->id,
            ]);
        }else{
            $studentGuardian = StudentGuardian::create([
                'students_id' => $student->id,
                'guardians_id' => $request->guardian_link_id,
            ]);
        }

        /*Academic Info Start*/
        if ($student && $request->has('institution')) {
            foreach ($request->get('institution') as $key => $institute) {
                AcademicInfo::create([
                    'students_id' => $student->id,
                    'institution' => $institute,
                    'board' => $request->get('board')[$key],
                    'pass_year' => $request->get('pass_year')[$key],
                    'symbol_no' => $request->get('symbol_no')[$key],
                    'percentage' => $request->get('percentage')[$key],
                    'division_grade' => $request->get('division_grade')[$key],
                    'major_subjects' => $request->get('major_subjects')[$key],
                    'remark' => $request->get('remark')[$key],
                    'created_by' => auth()->user()->id,
                ]);
            }
        }
        /*Academic Info End*/

        /*SMS & Email Alert*/
        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','StudentRegistration')->first();
        if(!$alert){

        }else{
            //Dear {{first_name}}, you are successfully registered in our institution with RegNo.{{reg_no}}. Thank You.
            $subject = $alert->subject;
            $message = $alert->template;
            $message = str_replace('{{first_name}}', $student->first_name, $message );
            $message = str_replace('{{reg_no}}', $student->reg_no, $message );
            $emailIds[] = $student->email;
            $contactNumbers[] = $addressinfo->mobile_1;

            /*Now Send SMS On First Mobile Number*/
            if($alert->sms == 1){
                $contactNumbers = $this->contactFilter($contactNumbers);
                $smssuccess = $this->sendSMS($contactNumbers,$message);
            }

            /*Now Send Email With Subject*/
            if($alert->email == 1){
                $emailIds = $this->emailFilter($emailIds);
                /*sending email*/
                $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
            }
        }
        //end sms email

        $request->session()->flash($this->message_success, $this->panel. ' Created Successfully.');

        if($request->add_student_another) {
            return back();
        }else{
            return redirect()->route($this->base_route);
        }
    }

    public function view($id)
    {
        $data = [];
        $data['student'] = Student::select('students.id','students.reg_no', 'students.reg_date', 'students.university_reg',
            'students.faculty','students.semester','students.batch', 'students.academic_status', 'students.first_name', 'students.middle_name',
            'students.last_name', 'students.date_of_birth', 'students.gender', 'students.blood_group',  'students.religion', 'students.caste','students.nationality',
            'students.mother_tongue', 'students.email', 'students.extra_info', 'students.status', 'pd.grandfather_first_name',
            'pd.grandfather_middle_name', 'pd.grandfather_last_name', 'pd.father_first_name', 'pd.father_middle_name',
            'pd.father_last_name', 'pd.father_eligibility', 'pd.father_occupation', 'pd.father_office', 'pd.father_office_number',
            'pd.father_residence_number', 'pd.father_mobile_1', 'pd.father_mobile_2', 'pd.father_email', 'pd.mother_first_name',
            'pd.mother_middle_name', 'pd.mother_last_name', 'pd.mother_eligibility', 'pd.mother_occupation', 'pd.mother_office',
            'pd.mother_office_number', 'pd.mother_residence_number', 'pd.mother_mobile_1', 'pd.mother_mobile_2', 'pd.mother_email',
            'ai.address', 'ai.state', 'ai.country', 'ai.temp_address', 'ai.temp_state', 'ai.temp_country', 'ai.home_phone',
            'ai.mobile_1', 'ai.mobile_2', 'gd.id as guardian_id', 'gd.guardian_first_name', 'gd.guardian_middle_name', 'gd.guardian_last_name',
            'gd.guardian_eligibility', 'gd.guardian_occupation', 'gd.guardian_office', 'gd.guardian_office_number', 'gd.guardian_residence_number',
            'gd.guardian_mobile_1', 'gd.guardian_mobile_2', 'gd.guardian_email', 'gd.guardian_relation', 'gd.guardian_address',
            'students.student_image','students.student_signature', 'pd.father_image', 'pd.mother_image', 'gd.guardian_image')
            ->where('students.id','=',$id)
            ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
            ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
            ->join('student_guardians as sg', 'sg.students_id','=','students.id')
            ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
            ->first();

        if (!$data['student']){
            request()->session()->flash($this->message_warning, "Not a Valid Student");
            return redirect()->route($this->base_route);
        }

        $data['fee_master'] = $data['student']->feeMaster()->orderBy('fee_due_date','desc')->get();
        $data['fee_collection'] = $data['student']->feeCollect()->get();

        /*total Calculation on Table Foot*/
        $data['student']->fee_amount = $data['student']->feeMaster()->sum('fee_amount');
        $data['student']->discount = $data['student']->feeCollect()->sum('discount');
        $data['student']->fine = $data['student']->feeCollect()->sum('fine');
        $data['student']->paid_amount = $data['student']->feeCollect()->sum('paid_amount');
        $data['student']->balance =
            ($data['student']->fee_amount - ($data['student']->paid_amount + $data['student']->discount))+ $data['student']->fine;

        $data['document'] = Document::select('id', 'member_type','member_id', 'title', 'file','description', 'status')
            ->where('member_type','=','student')
            ->where('member_id','=',$data['student']->id)
            ->orderBy('created_by','desc')
            ->get();

        //attendance start
        $attendanceCollection = Attendance::select('attendances.id', 'attendances.attendees_type', 'attendances.link_id',
            'attendances.years_id', 'attendances.months_id', 'attendances.day_1', 'attendances.day_2', 'attendances.day_3',
            'attendances.day_4', 'attendances.day_5', 'attendances.day_6', 'attendances.day_7', 'attendances.day_8',
            'attendances.day_9', 'attendances.day_10', 'attendances.day_11', 'attendances.day_12', 'attendances.day_13',
            'attendances.day_14', 'attendances.day_15', 'attendances.day_16', 'attendances.day_17', 'attendances.day_18',
            'attendances.day_19', 'attendances.day_20', 'attendances.day_21', 'attendances.day_22', 'attendances.day_23',
            'attendances.day_24', 'attendances.day_25', 'attendances.day_26', 'attendances.day_27', 'attendances.day_28',
            'attendances.day_29', 'attendances.day_30', 'attendances.day_31', 'attendances.day_32')
            ->where('attendances.attendees_type', 1)
            ->where('attendances.link_id',$data['student']->id)
            ->join('students as s', 's.id', '=', 'attendances.link_id')
            ->orderBy('attendances.years_id','asc')
            ->orderBy('attendances.months_id','asc')
            ->get();

        $attendanceStatus = AttendanceStatus::get();
        $filteredAttendance = $attendanceCollection->filter(function ($attendance, $key) use($attendanceStatus) {
            for ($day = 1; $day <= 32; $day++) {
                $dayCode = "day_".$day;
                foreach ($attendanceStatus as $attenStatus){
                    if($attendance->$dayCode == $attenStatus->id){
                        $attenTitle = $attenStatus->title;
                        $attendance->$attenTitle = $attendance->$attenTitle + 1;
                    }
                }
            }

            return $attendance;
        });

        $data['attendance'] = $filteredAttendance;
        $data['attendanceStatus'] = $attendanceStatus;

        $subjectWiseAttendance = SubjectAttendance::select('subject_attendances.id', 'subject_attendances.subjects_id','subject_attendances.attendance_type', 'subject_attendances.link_id',
            'subject_attendances.years_id', 'subject_attendances.months_id', 'subject_attendances.day_1', 'subject_attendances.day_2', 'subject_attendances.day_3',
            'subject_attendances.day_4', 'subject_attendances.day_5', 'subject_attendances.day_6', 'subject_attendances.day_7', 'subject_attendances.day_8',
            'subject_attendances.day_9', 'subject_attendances.day_10', 'subject_attendances.day_11', 'subject_attendances.day_12', 'subject_attendances.day_13',
            'subject_attendances.day_14', 'subject_attendances.day_15', 'subject_attendances.day_16', 'subject_attendances.day_17', 'subject_attendances.day_18',
            'subject_attendances.day_19', 'subject_attendances.day_20', 'subject_attendances.day_21', 'subject_attendances.day_22', 'subject_attendances.day_23',
            'subject_attendances.day_24', 'subject_attendances.day_25', 'subject_attendances.day_26', 'subject_attendances.day_27', 'subject_attendances.day_28',
            'subject_attendances.day_29', 'subject_attendances.day_30', 'subject_attendances.day_31','subject_attendances.day_32')
            ->where('subject_attendances.link_id','=', $data['student']->id)
            ->orderBy('subject_attendances.years_id','asc')
            ->orderBy('subject_attendances.months_id','asc')
            ->orderBy('subject_attendances.subjects_id','asc')
            ->get();

        $filteredAttendance = $subjectWiseAttendance->filter(function ($attendance, $key) use($attendanceStatus) {
            for ($day = 1; $day <= 32; $day++) {
                $dayCode = "day_".$day;
                foreach ($attendanceStatus as $attenStatus){
                    if($attendance->$dayCode == $attenStatus->id){
                        $attenTitle = $attenStatus->title;
                        $attendance->$attenTitle = $attendance->$attenTitle + 1;
                    }
                }
            }

            return $attendance;
        });

        $data['subject_attendance'] = $filteredAttendance;
        //attendance end

        $data['lib_member'] = LibraryMember::where([
            'library_members.user_type' => 1,
            'library_members.member_id' => $data['student']->id,
        ])
            ->first();

        if($data['lib_member'] != null){
            $data['books_history'] = $data['lib_member']->libBookIssue()->select('book_issues.id', 'book_issues.member_id',
                'book_issues.book_id',  'book_issues.issued_on', 'book_issues.due_date','book_issues.return_date', 'b.book_masters_id',
                'b.book_code', 'bm.title','bm.categories')
                ->join('books as b','b.id','=','book_issues.book_id')
                ->join('book_masters as bm','bm.id','=','b.book_masters_id')
                ->orderBy('book_issues.issued_on', 'desc')
                ->get();
        }

        $data['note'] = Note::select('created_at', 'id', 'member_type','member_id','subject', 'note', 'status')
            ->where('member_type','=','student')
            ->where('member_id','=', $data['student']->id)
            ->orderBy('created_at','desc')
            ->get();

        $data['hostel_history'] = ResidentHistory::select('resident_histories.years_id', 'resident_histories.hostels_id',
            'resident_histories.rooms_id', 'resident_histories.beds_id',
            'resident_histories.history_type','resident_histories.created_at')
            ->where([['r.user_type','=', 1],['r.member_id','=',$data['student']->id]])
            ->join('residents as r', 'r.id', '=', 'resident_histories.residents_id')
            ->join('beds as b', 'b.id', '=', 'resident_histories.beds_id')
            ->orderBy('resident_histories.created_at')
            ->get();

        $data['academicInfos'] = $data['student']->academicInfo()->orderBy('sorting_order','asc')->get();

        /*Exam Score*/
        /*filter student with schedule subject markledger*/
        $subject = $data['student']->markLedger()
            //->select( 'exam_schedule_id',  'obtain_mark_theory', 'obtain_mark_practical','absent')
            ->get();

        //filter subject and joint mark from schedules;
        $filteredSubject  = $subject->filter(function ($subject, $key) {
            $joinSub = $subject->examSchedule()
                ->first();

            if($joinSub){
                $subject->subjects_id = $joinSub->subjects_id;
                $subject->full_mark_theory = $joinSub->full_mark_theory;
                $subject->pass_mark_theory = $joinSub->pass_mark_theory;
                $subject->full_mark_practical = $joinSub->full_mark_practical;
                $subject->pass_mark_practical = $joinSub->pass_mark_practical;

                /*attach exam detail*/
                $subject->years_id = $joinSub->years_id;
                $subject->months_id = $joinSub->months_id;
                $subject->exams_id = $joinSub->exams_id;
                $subject->faculty_id = $joinSub->faculty_id;
                $subject->semesters_id = $joinSub->semesters_id;
                //more
                $th = $subject->obtain_mark_theory;
                $pr = $subject->obtain_mark_practical;
                $absent_theory = $subject->absent_theory;
                $absent_practical = $subject->absent_practical;

                /*theory mark comparision*/
                if(isset($subject->pass_mark_theory) && $subject->pass_mark_theory != null){
                    if($absent_theory == 1) {
                        $subject->obtain_mark_theory = "AB";
                    }else{
                        //dd($th);//35
                        if(!is_numeric($th)){
                            $subject->obtain_mark_theory = "*";
                        }
                    }
                }else{
                    $subject->obtain_mark_theory = "-";
                }

                /*Practical mark comparision*/
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


                /*verify again the new obtain values are number or not*/
                $th_new = $subject->obtain_mark_theory;
                $pr_new = $subject->obtain_mark_practical;

                $subject->total_obtain_mark = (is_numeric($th_new)?$th_new:0) + (is_numeric($pr_new)?$pr_new:0);

                if($th_new >= $subject->pass_mark_theory && $pr_new >= $subject->pass_mark_practical){
                    $subject->remark = '';
                    if($th_new > $subject->full_mark_theory){
                        $subject->th_remark = '*N';
                        $subject->remark = '*';
                    }

                    if($pr_new > $subject->full_mark_practical){
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

                return $subject;
            }
        });

        $data['student']->markLedger->subjects = $filteredSubject;

        $data['examScore'] = $data['student']->markLedger->subjects->groupBY('months_id');

        /*Certificate History*/
        $data['certificate_history'] = $data['student']->certificateHistory()->get();

        /*Transport History*/
        $data['transport_history'] = TransportHistory::select('transport_histories.id', 'transport_histories.years_id',
            'transport_histories.routes_id', 'transport_histories.vehicles_id',  'transport_histories.history_type',
            'transport_histories.created_at','tu.member_id','tu.user_type')
            ->where([['tu.user_type','=', 1],['tu.member_id','=',$data['student']->id]])
            ->join('transport_users as tu','tu.id','=','transport_histories.travellers_id')
            ->orderBy('transport_histories.created_at')
            ->get();


        //login credential
        $data['student_login'] = User::where([['role_id',6],['hook_id',$data['student']->id]])->first();
        $data['guardian_login'] = User::where([['role_id',7],['hook_id',$data['student']->guardian_id]])->first();

        $data['url'] = URL::current();
        return view(parent::loadDataToView($this->view_path.'.detail.index'), compact('data'));
    }

    public function edit(Request $request, $id)
    {
        $data = [];

        $data['row'] = Student::select('students.id','students.reg_no', 'students.reg_date', 'students.university_reg',
            'students.faculty','students.semester','students.batch', 'students.academic_status', 'students.first_name', 'students.middle_name',
            'students.last_name', 'students.date_of_birth', 'students.gender', 'students.blood_group', 'students.religion', 'students.caste', 'students.nationality',
            'students.mother_tongue', 'students.email', 'students.extra_info','students.student_image', 'students.student_signature', 'students.status',
            'pd.grandfather_first_name',
            'pd.grandfather_middle_name', 'pd.grandfather_last_name', 'pd.father_first_name', 'pd.father_middle_name',
            'pd.father_last_name', 'pd.father_eligibility', 'pd.father_occupation', 'pd.father_office', 'pd.father_office_number',
            'pd.father_residence_number', 'pd.father_mobile_1', 'pd.father_mobile_2', 'pd.father_email', 'pd.mother_first_name',
            'pd.mother_middle_name', 'pd.mother_last_name', 'pd.mother_eligibility', 'pd.mother_occupation', 'pd.mother_office',
            'pd.mother_office_number', 'pd.mother_residence_number', 'pd.mother_mobile_1', 'pd.mother_mobile_2', 'pd.mother_email',
            'pd.father_image', 'pd.mother_image',
            'ai.address', 'ai.state', 'ai.country', 'ai.temp_address', 'ai.temp_state', 'ai.temp_country', 'ai.home_phone',
            'ai.mobile_1', 'ai.mobile_2', 'gd.id as guardians_id', 'gd.guardian_first_name', 'gd.guardian_middle_name', 'gd.guardian_last_name',
            'gd.guardian_eligibility', 'gd.guardian_occupation', 'gd.guardian_office', 'gd.guardian_office_number',
            'gd.guardian_residence_number', 'gd.guardian_mobile_1', 'gd.guardian_mobile_2', 'gd.guardian_email',
            'gd.guardian_relation', 'gd.guardian_address', 'gd.guardian_image')
            ->where('students.id','=',$id)
            ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
            ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
            ->join('student_guardians as sg', 'sg.students_id','=','students.id')
            ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
            ->first();

        if (!$data['row'])
            return parent::invalidRequest();

        $data['faculties'] = $this->activeFaculties();
        $data['semester'] = $this->activeSemester();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();


        $data['academicInfo'] = $data['row']->academicInfo()->orderBy('sorting_order','asc')->get();
        //dd($data['academicInfo']->toArray());
        $data['academicInfo-html'] = view($this->view_path.'.registration.includes.forms.academic_tr_edit', [
            'academicInfos' => $data['academicInfo']
        ])->render();

        return view(parent::loadDataToView($this->view_path.'.registration.edit'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        if (!$row = Student::find($id))
            return parent::invalidRequest();

        if ($request->hasFile('student_main_image')) {
            // remove old image from folder
            if (file_exists($this->folder_path.$row->student_image))
                @unlink($this->folder_path.$row->student_image);

            /*upload new student image*/
            $student_image = $request->file('student_main_image');
            $student_image_name = $request->reg_no.'.'.$student_image->getClientOriginalExtension();
            $student_image->move($this->folder_path, $student_image_name);
        }

        if ($request->hasFile('student_signature_main_image')) {
            // remove old image from folder
            if (file_exists($this->folder_path.$row->student_signature))
                @unlink($this->folder_path.$row->student_signature);

            /*upload new student signature*/
            $student_signature = $request->file('student_signature_main_image');
            $student_signature_name = $request->reg_no.'_signature.'.$student_signature->getClientOriginalExtension();
            $student_signature->move($this->folder_path, $student_signature_name);
        }

        $request->request->add(['updated_by' => auth()->user()->id]);
        $request->request->add(['student_image' => isset($student_image_name)?$student_image_name:$row->student_image]);
        $request->request->add(['student_signature' => isset($student_signature_name)?$student_signature_name:$row->student_signature]);

        $student = $row->update($request->all());

        /*Update Associate Address Info*/
        $row->address()->update([
            'address'    =>  $request->address,
            'state'      =>  $request->state,
            'country'    =>  $request->country,
            'temp_address' =>  $request->temp_address,
            'temp_state' =>  $request->temp_state,
            'temp_country' =>  $request->temp_country,
            'home_phone'   =>  $request->home_phone,
            'mobile_1'   =>  $request->mobile_1,
            'mobile_2'   =>  $request->mobile_2

        ]);

        /*Update Associate Parents Info with Images*/
        $parent = $row->parents()->first();
        $guardian = $row->guardian()->first();

        $parential_image_path = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'parents'.DIRECTORY_SEPARATOR;
        if ($request->hasFile('father_main_image')){
            // remove old image from folder
            if (file_exists($parential_image_path.$parent->father_image))
                @unlink($parential_image_path.$parent->father_image);

            $father_image = $request->file('father_main_image');
            $father_image_name = $row->reg_no.'_father.'.$father_image->getClientOriginalExtension();
            $father_image->move($parential_image_path, $father_image_name);
        }

        if ($request->hasFile('mother_main_image')){
            // remove old image from folder
            if (file_exists($parential_image_path.$parent->mother_image))
                @unlink($parential_image_path.$parent->mother_image);

            $mother_image = $request->file('mother_main_image');
            $mother_image_name = $row->reg_no.'_mother.'.$mother_image->getClientOriginalExtension();
            $mother_image->move($parential_image_path, $mother_image_name);
        }


        if ($request->hasFile('guardian_main_image')){
            // remove old image from folder
            if (file_exists($parential_image_path.$guardian->guardian_image))
                @unlink($parential_image_path.$guardian->guardian_image);

            $guardian_image = $request->file('guardian_main_image');
            $guardian_image_name = $row->reg_no.'_guardian.'.$guardian_image->getClientOriginalExtension();
            $guardian_image->move($parential_image_path, $guardian_image_name);
        }

        $father_image_name = isset($father_image_name)?$father_image_name:$parent->father_image;
        $mother_image_name = isset($mother_image_name)?$mother_image_name:$parent->mother_image;
        $guardian_image_name = isset($guardian_image_name)?$guardian_image_name:$guardian->guardian_image;

        $row->parents()->update([
            'grandfather_first_name'    =>  $request->grandfather_first_name,
            'grandfather_middle_name'   =>  $request->grandfather_middle_name,
            'grandfather_last_name'     =>  $request->grandfather_last_name,
            'father_first_name'         =>  $request->father_first_name,
            'father_middle_name'        =>  $request->father_middle_name,
            'father_last_name'          =>  $request->father_last_name,
            'father_eligibility'        =>  $request->father_eligibility,
            'father_occupation'         =>  $request->father_occupation,
            'father_office'             =>  $request->father_office,
            'father_office_number'      =>  $request->father_office_number,
            'father_residence_number'   =>  $request->father_residence_number,
            'father_mobile_1'           =>  $request->father_mobile_1,
            'father_mobile_2'           =>  $request->father_mobile_2,
            'father_email'              =>  $request->father_email,
            'mother_first_name'         =>  $request->mother_first_name,
            'mother_middle_name'        =>  $request->mother_middle_name,
            'mother_last_name'          =>  $request->mother_last_name,
            'mother_eligibility'        =>  $request->mother_eligibility,
            'mother_occupation'         =>  $request->mother_occupation,
            'mother_office'             =>  $request->mother_office,
            'mother_office_number'      =>  $request->mother_office_number,
            'mother_residence_number'   =>  $request->mother_residence_number,
            'mother_mobile_1'           =>  $request->mother_mobile_1,
            'mother_mobile_2'           =>  $request->mother_mobile_2,
            'mother_email'              =>  $request->mother_email,
            'father_image'              =>  $father_image_name,
            'mother_image'              =>  $mother_image_name

        ]);

        //if guardian link modified or not condition
        if($request->guardian_link_id == null){
            $sgd = $row->guardian()->first();
            $guardiansInfo = [
                'guardian_first_name'         =>  $request->guardian_first_name,
                'guardian_middle_name'        =>  $request->guardian_middle_name,
                'guardian_last_name'          =>  $request->guardian_last_name,
                'guardian_eligibility'        =>  $request->guardian_eligibility,
                'guardian_occupation'         =>  $request->guardian_occupation,
                'guardian_office'             =>  $request->guardian_office,
                'guardian_office_number'      =>  $request->guardian_office_number,
                'guardian_residence_number'   =>  $request->guardian_residence_number,
                'guardian_mobile_1'           =>  $request->guardian_mobile_1,
                'guardian_mobile_2'           =>  $request->guardian_mobile_2,
                'guardian_email'              =>  $request->guardian_email,
                'guardian_relation'           =>  $request->guardian_relation,
                'guardian_address'            =>  $request->guardian_address,
                'guardian_image'              =>  $guardian_image_name
            ];
            GuardianDetail::where('id',$sgd->guardians_id)->update($guardiansInfo);
        }else{
            $studentGuardian = StudentGuardian::where('students_id', $row->id)->update([
                'students_id' => $row->id,
                'guardians_id' => $request->guardian_link_id,
            ]);
        }

        /*Academic Info Start*/
        if ($row && $request->has('institution')) {
            foreach ($request->get('institution') as $key => $institution) {
                $academicInfoId = isset($request->get('academic_info_id')[$key])?$request->get('academic_info_id')[$key]:$key+1;
                $academicInfoExist = AcademicInfo::where('id',$academicInfoId)->first();
                if($academicInfoExist){
                    $academicInfoUpdate = [
                        'students_id' => $row->id,
                        'institution' => $institution,
                        'board' => $request->get('board')[$key],
                        'pass_year' => $request->get('pass_year')[$key],
                        'symbol_no' => $request->get('symbol_no')[$key],
                        'percentage' => $request->get('percentage')[$key],
                        'division_grade' => $request->get('division_grade')[$key],
                        'major_subjects' => $request->get('major_subjects')[$key],
                        'remark' => $request->get('remark')[$key],
                        'sorting_order' => $key+1,
                        'last_updated_by' => auth()->user()->id
                    ];
                    $academicInfoExist->update($academicInfoUpdate);
                }else{
                    AcademicInfo::create([
                        'students_id' => $row->id,
                        'institution' => $institution,
                        'board' => $request->get('board')[$key],
                        'pass_year' => $request->get('pass_year')[$key],
                        'symbol_no' => $request->get('symbol_no')[$key],
                        'percentage' => $request->get('percentage')[$key],
                        'division_grade' => $request->get('division_grade')[$key],
                        'major_subjects' => $request->get('major_subjects')[$key],
                        'remark' => $request->get('remark')[$key],
                        'sorting_order' => $key+1,
                        'created_by' => auth()->user()->id,
                    ]);
                }
            }
        }
        /*Academic Info End*/
        $request->session()->flash($this->message_success, $this->panel. ' Info Updated Successfully.');
        //return redirect()->route($this->base_route);
        return back();

    }

    public function delete(Request $request, $id)
    {
        $errCount = 0;
        $errors = [];
        if (!$row = Student::find($id)) return parent::invalidRequest();

        //User
            $userInfo = User::where(['role_id' => 6, 'hook_id'=> $id])->first();
            if($userInfo) {
                $errCount = $errCount+1;
                $errors[] = "User Found, Please Delete.";
            }

        //Document & Notes
            //Documents
            $document = $row->studentDocuments()->get();
            if($document->count() > 0){
                $errCount = $errCount+1;
                $errors[] = "Documents Found, Please Delete.";
            }

            //Notes
            $notes = $row->studentNotes()->get();
            if($notes->count() > 0){
                $errCount = $errCount+1;
                $errors[] = "Notes Found, Please Delete.";
            }

        //Assignment
            $assignmentAnswer = $row->assignmentAnswers()->get();
            if($assignmentAnswer->count() > 0){
                $errCount = $errCount+1;
                $errors[] = "Assignment Answer Found, Please Delete.";
            }

        //Transport
            $transportUser = $row->transportUser()->get();
            if($transportUser->count() > 0){
                $transportHistory = TransportHistory::where('travellers_id',$transportUser->first()->id)->get();
                if($transportHistory->count() > 0){
                    $errCount = $errCount+1;
                    $errors[] = "Transport History Found, Please Delete.";
                }
                $errCount = $errCount+1;
                $errors[] = "Transport User Found, Please Delete.";
            }

        //Hostel
            $hostelResident = $row->hostelResident()->get();
            if($hostelResident->count() > 0){
                $residentHistory = ResidentHistory::where('residents_id',$hostelResident->first()->id)->get();
                if($residentHistory->count() > 0){
                    $errCount = $errCount+1;
                    $errors[] = "Hostel Resident History Found, Please Delete.";
                }
                $errCount = $errCount+1;
                $errors[] = "Hostel Resident Found, Please Delete.";
            }

        //Certificates
            //Certificate History
            $certificateHistories = $row->certificateHistory()->get();
            if($certificateHistories->count() > 0){
                $errCount = $errCount+1;
                $errors[] = "Certificate History Found, Please Delete.";
            }

            //attendance certificate
            $attendanceCertificates = $row->attendanceCertificate()->get();
            if($attendanceCertificates->count() > 0){
                $errCount = $errCount+1;
                $errors[] = "Attendance Certificate Found, Please Delete.";
            }

            //bonafied Certificate
            $bonafideCertificates = $row->bonafideCertificate()->get();
            if($bonafideCertificates->count() > 0){
                $errCount = $errCount+1;
                $errors[] = "Bonafied Certificate Found, Please Delete.";
            }

            //Course Completion Certificate
            $courseCompletionCertificates = $row->courseCompletionCertificate()->get();
            if($courseCompletionCertificates->count() > 0){
                $errCount = $errCount+1;
                $errors[] = "Course Completion Certificate Found, Please Delete.";
            }

            //Transfer Certificate
            $transferCertificates = $row->transferCertificate()->get();
            if($transferCertificates->count() > 0){
                $errCount = $errCount+1;
                $errors[] = "Transfer Certificate Found, Please Delete.";
            }

        //exam mark ledger
            $examMarkLedger = $row->markLedger()->get();
            if($examMarkLedger->count() > 0){
                $errCount = $errCount+1;
                $errors[] = "Mark Ledger Found, Please Delete.";
            }

        //attendance (regular & Subject)
            //Regular Attendance
            $attendacne = $row->regularAttendance()->get();
            if($attendacne->count() > 0){
                $errCount = $errCount+1;
                $errors[] = "Regular Attendance Found, Please Delete.";
            }

            //Subject Attendance
            $subjectAttendance = $row->subjectAttendance()->get();
            if($subjectAttendance->count() > 0){
                $errCount = $errCount+1;
                $errors[] = "Subject Attendance Found, Please Delete.";
            }

        //library Membership & History
            $libraryMember = $row->libraryMember()->get();
            if($libraryMember->count() > 0){
                $bookIssue = BookIssue::where('member_id',$libraryMember->first()->id)->get();
                if($bookIssue->count() > 0){
                    $errCount = $errCount+1;
                    $errors[] = "Book Issue Found, Please Delete.";
                }
                $errCount = $errCount+1;
                $errors[] = "Library Member Found, Please Delete.";
            }

        //Fee Master, Fee Collection
            $feeMaster = $row->feeMaster()->get();
            if($feeMaster->count() > 0){
                $feeCollection = $row->feeCollect()->get();
                if($feeCollection->count() > 0){
                    $errCount = $errCount+1;
                    $errors[] = "Fee Collection Found, Please Delete.";
                }
                $errCount = $errCount+1;
                $errors[] = "Fee Master Found, Please Delete.";
            }


        //Academic Info
        $academicInfo = $row->academicInfo()->get();
        if($academicInfo->count() > 0){
            $errCount = $errCount+1;
            $errors[] = "Academic Info Found, Please Delete.";
        }

        //parent Info
            $parentInfo = $row->parents()->first();
            if(isset($parentInfo)){
                $parentInfo->delete();
                $errCount = $errCount+1;
                $errors[] = "Parent Info Found, Please Delete.";
            }

        //address info
            $addressInfo = $row->address()->first();
            if(isset($addressInfo)){
                $addressInfo->delete();
                $errCount = $errCount+1;
                $errors[] = "Address Info Found, Please Delete.";
            }

        //guardian info
            $guardian = $row->guardian()->first();
            if(isset($guardian)){
                //$guardian->delete();
                $guardianDetail = GuardianDetail::find($guardian->id);
            if($guardianDetail){
                $errCount = $errCount+1;
                $errors[] = "Guardian Detail Info Found, Please Delete.";
            }

        }

        if($errCount > 0){
            $request->session()->flash($this->message_warning, $this->panel.' not delete. If you want to erase student data, please check err below and request administrator to delete all the data first.');
            return back()->withErrors($errors);
        }else{
            //remove images
            if (file_exists($this->folder_path.$row->student_image))
                @unlink($this->folder_path.$row->student_image);

            if (file_exists($this->folder_path.$row->student_signature))
                @unlink($this->folder_path.$row->student_signature);

            /*$this->parent_folder_path = public_path().DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'parents'.DIRECTORY_SEPARATOR;
            if (file_exists($this->parent_folder_path.$row->reg_no.'_father'.'.*'))
                @unlink($this->parent_folder_path.$row->reg_no.'_father'.'.*');

            if (file_exists($this->parent_folder_path.$row->reg_no.'_mother'.'.*'))
                @unlink($this->parent_folder_path.$row->reg_no.'_mother'.'.*');

            if (file_exists($this->parent_folder_path.$row->reg_no.'_guardian'.'.*'))
                @unlink($this->parent_folder_path.$row->reg_no.'_guardian'.'.*');*/

            $row->delete();
            $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        }

        //return redirect()->route($this->base_route);
        return back();
    }

    public function active(request $request, $id)
    {
        if (!$row = Student::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->reg_no.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = Student::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);
        $row->update($request->all());

        //in active student login detail
        $login_detail = User::where([['role_id',6],['hook_id',$row->id]])->first();
        if($login_detail){
            $request->request->add(['status' => 'in-active']);
            $login_detail->update($request->all());
        }

        // in active guardian login detail
        $login_detail = User::where([['role_id',7],['hook_id',$row->id]])->first();
        if($login_detail) {
            $request->request->add(['status' => 'in-active']);
            $login_detail->update($request->all());
        }

        $request->session()->flash($this->message_success, $row->reg_no.' '.$this->panel.' In-Active Successfully.');
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
                            $row = Student::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $this->delete($request, $row_id);
                            break;
                    }
                }

                if ($request->get('bulk_action') == 'active' || $request->get('bulk_action') == 'in-active') {
                    $request->session()->flash($this->message_success, $request->get('bulk_action') . ' Action Successfully.');
                }else {
                    //$request->session()->flash($this->message_success, 'Deleted successfully.');
                }

                return redirect()->route($this->base_route);

            } else {
                $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
                return redirect()->route($this->base_route);
            }

        } else return parent::invalidRequest();

    }

    public function findSemester(Request $request)
    {
        $response = [];
        $response['error'] = true;

        if ($request->has('faculty_id')) {
            $faculty = Faculty::find($request->get('faculty_id'));
            if ($faculty) {
                $response['semester'] = $faculty->semester()->select('semesters.id', 'semesters.semester')->get();
                $response['error'] = false;
                $response['success'] = 'Semester/Sec. Available For This Faculty/Class.';
            } else {
                $response['error'] = 'No Any Semester Assign on This Faculty/Class.';
            }
        } else {
            $response['message'] = 'Invalid request!!';
        }
        return response()->json(json_encode($response));
    }

    public function transfer(Request $request)
    {
        $data = [];
        if($request->all()) {
            $data['student'] = Student::select('id', 'reg_no', 'reg_date', 'first_name', 'middle_name', 'last_name',
                'faculty', 'semester','academic_status', 'status')
                ->where(function ($query) use ($request) {
                    $this->commonStudentFilterCondition($query, $request);
                })
                ->get();
        }

        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.transfer.index'), compact('data'));
    }

    public function transfering(Request $request)
    {
        if($request->faculty > 0 && $request->semester_select > 0){
            if ($request->has('chkIds')) {
                $studIds = $request->get('chkIds');
                $students = Student::whereIn('id',$studIds)->get();
                //filter student & update new data & send alert if active
                /*Here We prepare message, contact number and email ids*/
                $emailIds = [];
                $contactNumbers = [];
                $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','StudentTransfer')->first();

                $filteredStudent  = $students->filter(function ($student, $key) use ($alert, $emailIds, $contactNumbers, $request){
                    $updateData = [
                        'faculty' => $request->get('faculty'),
                        'semester' => $request->get('semester_select'),
                        'academic_status' => $request->get('student_status')
                    ];
                    $updateStudent = $student->update($updateData);
                    $semesterName = $this->getSemesterById($request->get('semester_select'));

                    if(!$alert) {

                    }else{
                        //send alert
                        //Dear {{first_name}}, We would like to inform you are successfully transferred to {{semester}}. Thank You.
                        $subject = $alert->subject;
                        $message = $alert->template;
                        $message = str_replace('{{first_name}}', $student->first_name, $message );
                        $message = str_replace('{{semester}}', $semesterName, $message );
                        $emailIds[] = $student->email;
                        $contactNumbers[] = $this->getStudentMobileNumber($student->id);

                        /*Now Send SMS On First Mobile Number*/
                        if($alert->sms == 1){
                            $contactNumbers = $this->contactFilter($contactNumbers);
                            $smssuccess = $this->sendSMS($contactNumbers,$message);
                        }

                        /*Now Send Email With Subject*/
                        if($alert->email == 1){
                            $emailIds = $this->emailFilter($emailIds);
                            /*sending email*/
                            $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                        }

                    }
                });
            }else {
                $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
                return redirect()->route($this->base_route.'.transfer');
            }

            $faculty_title = ViewHelper::getFacultyTitle( $request->faculty );
            $semester_title = ViewHelper::getSemesterTitle( $request->semester_select );
            $request->session()->flash($this->message_success, 'Students Transfer on : '.$faculty_title.' / '.$semester_title.' Successfully.');

        }else{
            $request->session()->flash($this->message_success, 'Please Choose Faculty and Semester Correctly.');
        }
        return redirect()->route($this->base_route.'.transfer');
    }

    public function academicInfoHtml()
    {
        $response['html'] = view($this->view_path.'.registration.includes.forms.academic_tr')->render();
        return response()->json(json_encode($response));
    }

    public function deleteAcademicInfo(Request $request, $id)
    {
        if (!$row = AcademicInfo::find($id)) return parent::invalidRequest();

        $row->delete();

        $request->session()->flash($this->message_success,'Academic Info Deleted Successfully.');
        return redirect()->back();
    }

    /*guardian's info link*/
    public function guardianNameAutocomplete(Request $request)
    {
        if ($request->has('q')) {

            $guardians = GuardianDetail::select('id','guardian_first_name',
                'guardian_middle_name', 'guardian_last_name', 'guardian_eligibility',
                'guardian_occupation', 'guardian_office', 'guardian_office_number',
                'guardian_residence_number', 'guardian_mobile_1', 'guardian_mobile_2',
                'guardian_email', 'guardian_relation', 'guardian_address','guardian_image')
                ->where('guardian_first_name', 'like', '%'.$request->get('q').'%')
                ->orWhere('guardian_middle_name', 'like', '%'.$request->get('q').'%')
                ->orWhere('guardian_last_name', 'like', '%'.$request->get('q').'%')
                ->orWhere('guardian_mobile_1', 'like', '%'.$request->get('q').'%')
                ->orWhere('guardian_mobile_2', 'like', '%'.$request->get('q').'%')
                ->orWhere('guardian_email', 'like', '%'.$request->get('q').'%')
                ->get();

            $response = [];
            foreach ($guardians as $guardian) {
                $guardianName = $guardian->guardian_first_name.' '.$guardian->guardian_middle_name.' '.$guardian->guardian_last_name;
                $response[] = ['id' => $guardian->id, 'text' => $guardianName.'- [MoNo.-'.$guardian->guardian_mobile_1.'] - [Email-'.$guardian->guardian_email.']'];
            }

            return json_encode($response);
        }

        abort(501);
    }

    public function guardianInfo(Request $request)
    {
        $response = [];
        $response['error'] = true;
        if ($request->has('id')) {
            if ($guardianInfo = GuardianDetail::find($request->get('id'))) {
                $response['error'] = false;
                $response['html'] = view($this->view_path.'.registration..includes.forms.pull-guardian-info', [
                    'guardianInfo' => $guardianInfo,
                ])->render();
                $response['message'] = 'Operation successful.';

            } else{
                $response['message'] = $request->get('subject_id').'Invalid request!!';
            }
        } else{
            $response['message'] = $request->get('id').'Invalid request!!';
        }

        return response()->json(json_encode($response));
    }

    /*bulk import*/
    public function importStudent()
    {
        /* $row['reg_date'] = '01-12-2017';
         $reg_date = Carbon::parse($row['reg_date'])->format('Y-m-d');
         dd($reg_date);*/
        return view(parent::loadDataToView($this->view_path.'.registration.import'));
    }

    public function handleImportStudent(Request $request)
    {
        //file present or not validation
        $validator = Validator::make($request->all(), [
            'file' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $file = $request->file('file');
        $csvData = file_get_contents($file);
        $rows = array_map("str_getcsv", explode("\n", $csvData));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            if (count($header) != count($row)) {
                continue;
            }

            $row = array_combine($header, $row);

            //Faculty id
            /* $faculty = Faculty::where('faculty',$row['faculty'])->first();
             if($faculty){
                 $facultyId = $faculty->id;
             }else{
                 $facultyId = "";
             }*/

            //Semester id
            /* $semester = Semester::where('semester',$row['semester'])->first();
             if($semester){
                 $semesterId = $semester->id;
             }else{
                 $semesterId = "";
             }*/

            //Academic Status
            /*$academicStatus = StudentStatus::where('title',$row['academic_status'])->first();
            if($academicStatus){
                $academicStatusId = $academicStatus->id;
            }else{
                $academicStatusId = 1; //1 for new Admission
            }*/

            //RegNo Generator Start
                if(!isset($row['reg_no'])){                 
					$oldStudent = Student::where('faculty',$request->faculty)->orderBy('id', 'DESC')->first();
                    if (!$oldStudent){
                        $sn = 1;
                    }else{
                        $oldReg = intval(substr($oldStudent->reg_no,-4));
                        $sn = $oldReg + 1;
                    }

                    $sn = substr("00000{$sn}", - 4);
                    $year = intval(substr(Year::where('active_status','=',1)->first()->title,-2));
                    $faculty = Faculty::find(intval($row['faculty']));
                    $facultyCode = $faculty->faculty_code;
                    //$regNum = $faculty.'-'.$year.'-'.$sn;
                    $regNum = $facultyCode.$year.$sn;
                    $row['reg_no'] = $regNum;
                }else{
                    //$row['reg_no'] = '';
                }

            //reg generator End

            //Student validation
            $validator = Validator::make($row, [
                'reg_no'                        => 'required  | max:25 | unique:students,reg_no',
                'reg_date'                      => 'required',
                'faculty'                       => 'required | exists:faculties,id',
                'semester'                      => 'required | exists:semesters,id',
                'first_name'                    => 'required | max:100',
                'last_name'                     => 'required | max:25',
                'date_of_birth'                 => 'required',
                'gender'                        => 'required',
                'religion'                      => 'max:15',
                'caste'                         => 'max:15',
                'nationality'                   => 'required | max:25',
                'address'                       => 'required | max:100',
                'state'                         => 'required | max:25',
                'country'                       => 'required | max:25',
                'temp_address'                  => 'max:100',
                'temp_state'                    => 'max:25',
                'temp_country'                  => 'max:25',
                /*'email'                         => 'required | max:100 | unique:students,email',*/
                'extra_info'                    => 'max:100',
                'home_phone'                    => 'max:25',
                'mobile_1'                      => 'max:25',
                'mobile_2'                      => 'max:25',
                'grandfather_first_name'        => 'max:25',
                'grandfather_middle_name'       => 'max:25',
                'grandfather_last_name'         => 'max:25',
                'father_first_name'             => 'max:25',
                'father_middle_name'            => 'max:25',
                'father_last_name'              => 'max:25',
                'father_eligibility'            => 'max:50',
                'father_occupation'             => 'max:50',
                'father_office'                 => 'max:100',
                'father_office_number'          => 'max:25',
                'father_residence_number'       => 'max:25',
                'father_mobile_1'               => 'max:25',
                'father_mobile_2'               => 'max:25',
                'father_email'                  => 'max:100',
                'mother_first_name'             => 'max:25',
                'mother_middle_name'            => 'max:25',
                'mother_last_name'              => 'max:25',
                'mother_eligibility'            => 'max:50',
                'mother_occupation'             => 'max:50',
                'mother_office'                 => 'max:100',
                'mother_office_number'          => 'max:25',
                'mother_residence_number'       => 'max:25',
                'mother_mobile_1'               => 'max:25',
                'mother_mobile_2'               => 'max:25',
                'mother_email'                  => 'max:100',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator);
            }

            /*Manage Date's Format*/
            $reg_date = Carbon::parse($row['reg_date'])->format('Y-m-d');
            $date_of_birth =  Carbon::parse($row['date_of_birth'])->format('Y-m-d');
            //Student import
            $student = Student::create([
                "reg_no"                => $row['reg_no'],
                "reg_date"              => $reg_date,
                "university_reg"        => $row['university_reg'],
                "faculty"               => $row['faculty'],
                "semester"              => $row['semester'],
                "academic_status"       => $row['academic_status'],
                "batch"                 => $row['batch'],
                "first_name"            => $row['first_name'],
                "middle_name"           => $row['middle_name'],
                "last_name"             => $row['last_name'],
                "date_of_birth"         => $date_of_birth,
                "gender"                => $row['gender'],
                "blood_group"           => $row['blood_group'],
                "religion"              => $row['religion'],
                "caste"                 => $row['caste'],
                "nationality"           => $row['nationality'],
                "mother_tongue"         => $row['mother_tongue'],
                "email"                 => $row['email'],
                "extra_info"            => $row['extra_info'],
                'created_by'            => auth()->user()->id
            ]);

            if($student){
                //address info
                Addressinfo::create([
                    "students_id"           => $student->id,
                    "home_phone"            => $row['home_phone'],
                    "mobile_1"              => $row['mobile_1'],
                    "mobile_2"              => $row['mobile_2'],
                    "address"               => $row['address'],
                    "state"                 => $row['state'],
                    "country"               => $row['country'],
                    "temp_address"          => $row['temp_address'],
                    "temp_state"            => $row['temp_state'],
                    "temp_country"          => $row['temp_country'],
                    'created_by'            => auth()->user()->id
                ]);

                //parents detail
                ParentDetail::create([
                    "students_id"               => $student->id,
                    "home_phone"                => $row['home_phone'],
                    "grandfather_first_name"    => $row['grandfather_first_name'],
                    "grandfather_middle_name"   => $row['grandfather_middle_name'],
                    "grandfather_last_name"     => $row['grandfather_last_name'],
                    "father_first_name"         => $row['father_first_name'],
                    "father_middle_name"        => $row['father_middle_name'],
                    "father_last_name"          => $row['father_last_name'],
                    "father_eligibility"        => $row['father_eligibility'],
                    "father_occupation"         => $row['father_occupation'],
                    "father_office"             => $row['father_office'],
                    "father_office_number"      => $row['father_office_number'],
                    "father_residence_number"   => $row['father_residence_number'],
                    "father_mobile_1"           => $row['father_mobile_1'],
                    "father_mobile_2"           => $row['father_mobile_2'],
                    "father_email"              => $row['father_email'],
                    "mother_first_name"         => $row['mother_first_name'],
                    "mother_middle_name"        => $row['mother_middle_name'],
                    "mother_last_name"          => $row['mother_last_name'],
                    "mother_eligibility"        => $row['mother_eligibility'],
                    "mother_occupation"         => $row['mother_occupation'],
                    "mother_office"             => $row['mother_office'],
                    "mother_office_number"      => $row['mother_office_number'],
                    "mother_residence_number"   => $row['mother_residence_number'],
                    "mother_mobile_1"           => $row['mother_mobile_1'],
                    "mother_mobile_2"           => $row['mother_mobile_2'],
                    "mother_email"              => $row['mother_email'],
                    'created_by'                => auth()->user()->id
                ]);

                //Guardian detail
                $guardian = GuardianDetail::create([
                    "students_id"                 => $student->id,
                    "guardian_first_name"         => $row['guardian_first_name'],
                    "guardian_middle_name"        => $row['guardian_middle_name'],
                    "guardian_last_name"          => $row['guardian_last_name'],
                    "guardian_eligibility"        => $row['guardian_eligibility'],
                    "guardian_occupation"         => $row['guardian_occupation'],
                    "guardian_office"             => $row['guardian_office'],
                    "guardian_office_number"      => $row['guardian_office_number'],
                    "guardian_residence_number"   => $row['guardian_residence_number'],
                    "guardian_mobile_1"           => $row['guardian_mobile_1'],
                    "guardian_mobile_2"           => $row['guardian_mobile_2'],
                    "guardian_email"              => $row['guardian_email'],
                    "guardian_relation"           => $row['guardian_relation'],
                    "guardian_address"            => $row['guardian_address'],
                    'created_by'                  => auth()->user()->id
                ]);

                /*student guardian link*/

                if($guardian){
                    StudentGuardian::create([
                        'students_id' => $student->id,
                        'guardians_id' => $guardian->id,
                    ]);
                }
            }

        }

        $request->session()->flash($this->message_success,'Students imported Successfully');
        return redirect()->route($this->base_route);
    }

    /*student name auto complete*/
    public function studentNameAutocomplete(Request $request)
    {
        if ($request->has('q')) {
            $students = Student::select('students.id', 'students.reg_no', 'students.university_reg',
                'students.first_name', 'students.middle_name', 'students.last_name', 'students.semester','students.email',
                'ai.mobile_1', 'ai.mobile_2')
                ->where('students.reg_no', 'like', '%'.$request->get('q').'%')
                ->orWhere('students.university_reg', 'like', '%'.$request->get('q').'%')
                ->orWhere('students.first_name', 'like', '%'.$request->get('q').'%')
                ->orWhere('students.middle_name', 'like', '%'.$request->get('q').'%')
                ->orWhere('students.last_name', 'like', '%'.$request->get('q').'%')
                ->orWhere('students.email', 'like', '%'.$request->get('q').'%')
                ->orWhere('ai.mobile_1', 'like', '%'.$request->get('q').'%')
                ->orWhere('ai.mobile_2', 'like', '%'.$request->get('q').'%')
                ->join('addressinfos as ai','ai.students_id','=','students.id')
                ->get();

            $response = [];
            foreach ($students as $student) {
                $response[] = ['id' => $student->id, 'text' => $student->reg_no.' | '.$student->first_name.' '.$student->middle_name.' '.$student->last_name.' | '.$this->getSemesterById($student->semester).' | '.$student->mobile_1];
            }

            return json_encode($response);
        }

        abort(501);
    }
}
