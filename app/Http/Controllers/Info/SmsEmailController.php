<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Info;

use App\Http\Controllers\CollegeBaseController;
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
use App\Traits\SmsEmailScope;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SmsEmailController extends CollegeBaseController
{
    protected $base_route = 'info.smsemail';
    protected $view_path = 'info.smsemail';
    protected $panel = 'SMS / Email';
    protected $filter_query = [];

    protected $BalanceFees = 'BalanceFees';
    protected $FeeReceive = 'FeeReceive';
    protected $LibraryReturnPeriodOver = 'LibraryReturnPeriodOver';


    use SmsEmailScope;
    use AccountingScope;

    public function __construct()
    {

    }

    /*Message Traking*/
    public function index(Request $request)
    {
        $data = [];
        $data['rows'] = SmsEmail::select('id', 'subject', 'message', 'sms', 'email', 'group','status')
            ->latest()
            ->get();
        //dd($data['rows']->toarray());
        return view(parent::loadDataToView($this->view_path . '.index'), compact('data'));

    }

    /*Group Message*/
    public function create()
    {
        $data = [];
        $data['roles'] = Role::where('name', '<>', 'super-admin')->get();
        return view(parent::loadDataToView($this->view_path . '.create'), compact('data'));

    }

    public function send(Request $request)
    {
        $emailIds = [];
        $contactNumbers = [];
        $subject = $request->subject;
        $message = $request->message;
        $emailMessage = $request->emailMessage;
        $group = [];

        /*get email id and contact number all active college admin*/
        if(in_array("admin",$request->role)){
            $admin = User::select('email','contact_number')->whereHas('roles', function($q){
                $q->where('name','=','admin');
            })->where('status','=',1)->get();

            foreach($admin as $admin){
                /*chek email id is correct or not if correct add on array other wise not*/
                $filterMail = filter_var($admin->email,FILTER_VALIDATE_EMAIL);
                if($filterMail){
                    $emailIds[] = $filterMail;
                }
                $contactNumbers[] = $admin->contact_number;
            }

            $group[] = 2;
            //$request->request->add(['admin' => in_array("admin", $request->role) ? 1 : 0]);
        }

        /*get email id and contact number all active Accountant*/
        if(in_array("account",$request->role)){
            $accounts = User::select('email','contact_number')->whereHas('roles', function($q){
                $q->where('name','=','account');
            })->where('status','=',1)->get();

            foreach($accounts as $account){
                /*chek email id is correct or not if correct add on array other wise not*/
                $filterMail = filter_var($account->email,FILTER_VALIDATE_EMAIL);
                if($filterMail){
                    $emailIds[] = $filterMail;
                }
                $contactNumbers[] = $account->contact_number;
            }

            $group[] = 3;
        }

        /*get email id and contact number all active Librarians*/
        if(in_array("library",$request->role)){
            $librarians = User::select('email','contact_number')->whereHas('roles', function($q){
                $q->where('name','=','library');
            })->where('status','=',1)->get();

            foreach($librarians as $library){
                /*chek email id is correct or not if correct add on array other wise not*/
                $filterMail = filter_var($library->email,FILTER_VALIDATE_EMAIL);
                if($filterMail){
                    $emailIds[] = $filterMail;
                }
                $contactNumbers[] = $library->contact_number;
            }

            $group[] = 4;
        }

        /*get email id and contact number all active Students*/
        if(in_array("student",$request->role)){
            $students = Student::select('students.email', 'a.mobile_1 as contact_number')
                ->where('students.status','=',1)
                ->join('addressinfos as a','a.students_id','=','students.id')
                ->get();

            foreach($students as $student){
                /*chek email id is correct or not if correct add on array other wise not*/
                $filterMail = filter_var($student->email,FILTER_VALIDATE_EMAIL);
                if($filterMail){
                    $emailIds[] = $filterMail;
                }
                $contactNumbers[] = $student->contact_number;
            }

            $group[] = 6;
        }

        /*get email id and contact number all active Guardians*/
        if(in_array("guardian",$request->role)){
            $guardians = GuardianDetail::select('guardian_email', 'guardian_mobile_1')
                ->where('status','=',1)
                ->get();

            foreach($guardians as $guardian){
                /*chek email id is correct or not if correct add on array other wise not*/
                $filterMail = filter_var($guardian->guardian_email,FILTER_VALIDATE_EMAIL);
                if($filterMail != false){
                    $emailIds[] = $filterMail;
                }
                $contactNumbers[] = $guardian->guardian_mobile_1;
            }

            $group[] = 7;
        }

        /*get email id and contact number all active Staffs*/
        if(in_array("staff",$request->role)){
            $staffs = Staff::select('email', 'mobile_1')
                ->where('status','=',1)
                ->get();

            foreach($staffs as $staff){
                /*chek email id is correct or not if correct add on array other wise not*/
                $filterMail = filter_var($staff->email,FILTER_VALIDATE_EMAIL);
                if($filterMail != false){
                    $emailIds[] = $filterMail;
                }
                $contactNumbers[] = $staff->mobile_1;
            }

            $group[] = 5;
        }

        /*Now Send SMS On First Mobile Number*/
        if(in_array("sms",$request->type)){
            $contactNumbers = $this->contactFilter($contactNumbers);
            $smssuccess = $this->sendSMS($contactNumbers,$message);

            /*store*/
            $group = implode(',',$group);
            $request->request->add(['group' => $group]);
            $request->request->add(['sms' => 1]);
            $request->request->add(['message' => $message]);
            $request->request->add(['created_by' => auth()->user()->id]);
            SmsEmail::create($request->all());

            return back()->with($this->message_success, "SMS Send Successfully");
        }

        /*Now Send Email With Subject*/
        if(in_array("email",$request->type)){
            $emailIds = $this->emailFilter($emailIds);
            $emailSuccess = $this->sendEmail($emailIds, $subject, $emailMessage);
            if($emailSuccess !=null)
                return back();

            /*store*/
            $group = implode(',',$group);
            $request->request->add(['group' => $group]);
            $request->request->add(['email' => 1]);
            $request->request->add(['message' => $emailMessage]);
            $request->request->add(['created_by' => auth()->user()->id]);
            SmsEmail::create($request->all());

            return back()->with($this->message_success, "Email Send Successfully");
        }
    }

    public function delete(Request $request, $id)
    {
        if (!$row = SmsEmail::find($id)) return parent::invalidRequest();

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
                            $row = SmsEmail::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = SmsEmail::find($row_id);
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

    /*SMS & EMAIL FOR STUDENT & PARENTS*/
    public function studentGuardian(Request $request)
    {
        $data = [];
        if($request->all()){
            $data['student'] = Student::select('id','reg_no','reg_date', 'first_name', 'middle_name', 'last_name',
                'faculty', 'semester','academic_status','status')
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

        return view(parent::loadDataToView($this->view_path . '.studentguardian.index'), compact('data'));

    }

    public function studentGuardianSend(Request $request)
    {
        $emailIds = [];
        $contactNumbers = [];
        $message = $request->message;
        $subject = $request->subject;
        $emailMessage = $request->emailMessage;
        $group = [];

        if ($request->has('chkIds')) {
            $ids = $request->get('chkIds');
            $students = Student::select('students.email', 'a.mobile_1 as contact_number',
                'pd.father_email', 'pd.father_mobile_1 as father_number',
                'pd.mother_email', 'pd.mother_mobile_1 as mother_number',
                'gd.guardian_email', 'gd.guardian_mobile_1 as guardian_number')
                ->whereIn('students.id',$ids)
                ->where('students.status','=',1)
                ->join('addressinfos as a','a.students_id','=','students.id')
                ->join('parent_details as pd','pd.students_id','=','students.id')
                ->join('student_guardians as sg', 'sg.students_id','=','students.id')
                ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
                ->get();

            foreach($students as $student) {
                /*chek email id is correct or not if correct add on array other wise not*/
                if ($request->to){
                    /*Student*/
                    if (in_array("student", $request->to)) {
                        $emailIds[] = $student->email;
                        $contactNumbers[] = $student->contact_number;
                        $group[] = 6;
                    }

                    /*Father*/
                    if (in_array("father", $request->to)) {
                        $emailIds[] = $student->father_email;
                        $contactNumbers[] = $student->father_number;
                        $group[] = 7;
                    }

                    /*Mother*/
                    if (in_array("mother", $request->to)) {
                        $emailIds[] = $student->mother_email;
                        $contactNumbers[] = $student->mother_number;
                        $group[] = 7;
                    }

                    /*Guardian*/
                    if (in_array("guardian", $request->to)) {
                        $emailIds[] = $student->guardian_email;
                        $contactNumbers[] = $student->guardian_number;
                        $group[] = 7;
                    }
                }else{
                    $request->session()->flash($this->message_warning, 'Please, Select Target Group');
                    return redirect()->route($this->base_route);
                }

            }
        }else {
            $request->session()->flash($this->message_warning, 'Please, Select At Least One Target Record.');
            return redirect()->route($this->base_route);
        }

        if($request->type){
            /*Now Send SMS On First Mobile Number*/
            if(in_array("sms",$request->type)){
                $contactNumbers = $this->contactFilter($contactNumbers);
                //dd($contactNumbers);
                $smssuccess = $this->sendSMS($contactNumbers,$message);

                /*store*/
                $group = implode(',',array_unique($group));
                $request->request->add(['group' => $group]);
                $request->request->add(['sms' => 1]);
                $request->request->add(['message' => $message]);
                $request->request->add(['created_by' => auth()->user()->id]);
                SmsEmail::create($request->all());

                return back()->with($this->message_success, "SMS Send Successfully");
            }

            /*Now Send Email With Subject*/
            if(in_array("email",$request->type)){
                $emailIds = $this->emailFilter($emailIds);
                $emailSuccess = $this->sendEmail($emailIds, $subject, $emailMessage);
                if($emailSuccess !=null)
                    return back();

                /*store*/
                $group = implode(',',array_unique($group));
                $request->request->add(['group' => $group]);
                $request->request->add(['email' => 1]);
                $request->request->add(['message' => $emailMessage]);
                $request->request->add(['created_by' => auth()->user()->id]);
                SmsEmail::create($request->all());

                return back()->with($this->message_success, "Email Send Successfully");
            }
        }else{
            $request->session()->flash($this->message_warning, 'Please, Select Message Type');
            return redirect()->route($this->base_route);
        }

    }


    /*SMS & EMAIL FOR Staff*/
    public function staff(Request $request)
    {
        $data = [];
        if($request->all()) {
            $data = [];
            $data['staff'] = Staff::select('id', 'reg_no', 'first_name', 'middle_name', 'last_name',
                'mobile_1', 'designation', 'qualification', 'status')
                ->where(function ($query) use ($request) {
                    $this->commonStaffFilterCondition($query, $request);
                })
                ->get();
        }

        $data['designation'] = $this->staffDesignationList();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path . '.staff.index'), compact('data'));

    }

    public function staffSend(Request $request)
    {
        $emailIds = [];
        $contactNumbers = [];
        $message = $request->message;
        $subject = $request->subject;
        $emailMessage = $request->emailMessage;
        $group = [];

        if ($request->has('chkIds')) {
            $ids = $request->get('chkIds');
            $staffs = Staff::select('email', 'mobile_1')
                ->whereIn('id',$ids)
                ->where('status','=',1)
                ->get();

            foreach($staffs as $staff){
                /*chek email id is correct or not if correct add on array other wise not*/
                $emailIds[] = $staff->email;
                $contactNumbers[] = $staff->mobile_1;
                $group[] = 5;
            }
        }else{
            $request->session()->flash($this->message_warning, 'Please, Select At Least One Target Record.');
            return redirect()->route($this->base_route);
        }

        if($request->type){
            /*Now Send SMS On First Mobile Number*/
            if(in_array("sms",$request->type)){
                $contactNumbers = $this->contactFilter($contactNumbers);
                $smssuccess = $this->sendSMS($contactNumbers,$message);

                /*store*/
                $group = implode(',',$group);
                $request->request->add(['group' => $group]);
                $request->request->add(['sms' => 1]);
                $request->request->add(['message' => $message]);
                $request->request->add(['created_by' => auth()->user()->id]);
                SmsEmail::create($request->all());

                return back()->with($this->message_success, "SMS Send Successfully");
            }

            /*Now Send Email With Subject*/
            if(in_array("email",$request->type)){
                $emailIds = $this->emailFilter($emailIds);
                $emailSuccess = $this->sendEmail($emailIds, $subject, $emailMessage);
                if($emailSuccess !=null)
                    return back();

                /*store*/
                $group = implode(',',$group);
                $request->request->add(['group' => $group]);
                $request->request->add(['email' => 1]);
                $request->request->add(['message' => $emailMessage]);
                $request->request->add(['created_by' => auth()->user()->id]);
                SmsEmail::create($request->all());

                return back()->with($this->message_success, "Email Send Successfully");
            }
        }else{
            $request->session()->flash($this->message_warning, 'Please, Select Message Type');
            return redirect()->route($this->base_route);
        }
    }


    /*SMS & EMAIL FOR Individual'S*/
    public function individual(Request $request)
    {
        $data = [];
        return view(parent::loadDataToView($this->view_path . '.individual.index'), compact('data'));
    }

    public function individualSend(Request $request)
    {
        $emailIds = $request->email;;
        $contactNumbers = $request->number;
        $message = $request->message;
        $subject = $request->subject;
        $emailMessage = $request->emailMessage;
        $group = "";

        if($request->type){
            /*Now Send SMS On First Mobile Number*/
            if(in_array("sms",$request->type)){
                $contactNumbers = explode(',',$contactNumbers);
                $contactNumbers = $this->contactFilter($contactNumbers);
                $contactNumbers= str_replace(' ','',$contactNumbers);
                $smssuccess = $this->sendSMS($contactNumbers,$message);

                /*store*/
                /*$request->request->add(['sms' => 1]);
                $request->request->add(['email' => 0]);
                $request->request->add(['message' => $message]);
                $request->request->add(['created_by' => auth()->user()->id]);
                SmsEmail::create($request->all());*/

                return back()->with($this->message_success, "SMS Send Successfully");
            }

            /*Now Send Email With Subject*/
            if(in_array("email",$request->type)){
                $emailIds = explode(',',$emailIds);;
                $emailIds = $this->emailFilter($emailIds);

                $emailIds = str_replace(' ', '',$emailIds);
                $emailSuccess = $this->sendEmail($emailIds, $subject, $emailMessage);
                if($emailSuccess != null)
                    return back();

                /*store*/
                $request->request->add(['group' => $group]);
                $request->request->add(['email' => 1]);
                $request->request->add(['message' => $emailMessage]);
                $request->request->add(['created_by' => auth()->user()->id]);
                SmsEmail::create($request->all());

                return back()->with($this->message_success, "Email Send Successfully");
            }

        }else{
            $request->session()->flash($this->message_warning, 'Please, Select Message Type');
            return redirect()->route($this->base_route);
        }

    }


    /*SEND MESSAGE With Template*/
    /*Library Clearance Reminder*/
    public function bookReturnReminder(Request $request)
    {
        /*Here We prepare message, contact number and email ids*/
        $emailIds = [];
        $contactNumbers = [];
        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','LibraryReturnPeriodOver')->first();
        if(!$alert)
            return back()->with($this->message_warning, "Alert Setting not Setup. Contact Admin For More Detail.");

        /*get email id and contact number of Library Over Period Student*/
        if(in_array("student",$request->to)){
            $students = BookIssue::select('s.first_name', 's.email', 'ai.mobile_1')
                ->where('lm.user_type','=',1)
                ->where('book_issues.due_date',"<", Carbon::now())
                ->join('library_members as lm','lm.id','=','book_issues.member_id')
                ->join('students as s','s.id','=','lm.member_id')
                ->join('addressinfos as ai','ai.students_id','=','s.id')
                ->distinct()
                ->get();

            /*filter student and send alert*/
            $filteredStudent  = $students->filter(function ($student, $key) use ($alert){
                if(!$alert) {

                }else{
                    $subject = $alert->subject;
                    $message = $alert->template;
                    $message = str_replace('{{first_name}}', $student->first_name, $message);
                    $emailIds[] = $student->email;
                    $contactNumbers[] = $student->mobile_1;

                    /*Now Send SMS On First Mobile Number*/
                    if($alert->sms == 1){
                        $contactNumbers = $this->contactFilter($contactNumbers);
                        $smssuccess = $this->sendSMS($contactNumbers,$message);
                    }

                    /*Now Send Email With Subject*/
                    if($alert->email == 1){
                        $emailIds = $this->emailFilter($emailIds);
                        $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                    }

                }
            });

        }

        /*get email id and contact number of Library Over Period Staff*/
        if(in_array("staff",$request->to)){
            $staffs = BookIssue::select('s.first_name','s.mobile_1', 's.email')
                ->where('lm.user_type','=', 2)
                ->where('book_issues.due_date',"<", Carbon::now())
                ->join('library_members as lm','lm.id','=','book_issues.member_id')
                ->join('staff as s','s.id','=','lm.member_id')
                ->distinct()
                ->get();

            /*filter student and send alert*/
            $filteredStaff  = $staffs->filter(function ($staff, $key) use ($alert){
                if(!$alert) {

                }else{
                    $subject = $alert->subject;
                    $message = $alert->template;
                    $message = str_replace('{{first_name}}', $staff->first_name, $message);
                    $emailIds[] = $staff->email;
                    $contactNumbers[] = $staff->mobile_1;

                    /*Now Send SMS On First Mobile Number*/
                    if($alert->sms == 1){
                        $contactNumbers = $this->contactFilter($contactNumbers);
                        $smssuccess = $this->sendSMS($contactNumbers,$message);
                    }

                    /*Now Send Email With Subject*/
                    if($alert->email == 1){
                        $emailIds = $this->emailFilter($emailIds);
                        $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                    }

                }
            });

        }

        $request->session()->flash($this->message_success, 'Library Return Period Over Alert Send Successfully');
        return redirect()->back();

    }

    /*Fee Receipt Confirmation*/
    public function feeReceipt(Request $request, $id)
    {
        $today = Carbon::today();
        $student = Student::select('students.id','students.reg_no', 'students.first_name','students.email', 'ai.mobile_1')
            ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
            ->find($id);
        $feeCollection = $student->feeCollect()
            ->where('date','=',$today)
            ->sum('paid_amount');

        if($feeCollection >= 0) {
            $alert = AlertSetting::select('sms', 'email', 'subject', 'template')->where('event', '=', $this->FeeReceive)->first();
            if (!$alert)
                return back()->with($this->message_warning, "Alert Setting not Setup. Contact Admin For More Detail.");

            $date = Carbon::parse($today)->format('Y-m-d');
            $subject = $alert->subject;
            $message = str_replace('{first_name}', $student->first_name, $alert->template);
            $message = str_replace('{amount}', $feeCollection, $message);
            $message = str_replace('{date}', $date, $message);

            $sms = false;
            $email = false;
            /*Now Send SMS On First Mobile Number*/
            if ($alert->sms == 1) {

                $contactNumbers = array($student->mobile_1);
                $contactNumbers = $this->contactFilter($contactNumbers);
                $smssuccess = $this->sendSMS($contactNumbers, $message);
                $sms = true;
            }

            if ($alert->email == 1) {
                $emailIds = array($student->email);
                $emailIds = $this->emailFilter($emailIds);
                $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                if($emailSuccess !=null)
                    return back();

                $email = true;
            }

            if ($sms == true || $email == true) {
                return back()->with($this->message_success, "Fee Receive Alert Send.");
            } else {
                return back()->with($this->message_warning, "Alert Not Send. Something is Wrong");
            }
        }else{
            return back()->with($this->message_success, "Today's Collection is Less than 0. Not Send Yet.");
        }

    }

    /*Due Reminder*/
    public function dueReminder(Request $request)
    {
        /*Here We prepare message, contact number and email ids*/
        $emailIds = [];
        $contactNumbers = [];
        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=',$this->BalanceFees)->first();
        if(!$alert)
            return back()->with($this->message_warning, "Alert Setting not Setup. Contact Admin For More Detail.");

        if ($request->has('chkIds')) {
            $studId = $request->get('chkIds');

            $students = Student::select('students.id','students.email','students.first_name', 'a.mobile_1 as contact_number')
                ->whereIn('students.id',$studId)
                ->join('addressinfos as a','a.students_id','=','students.id')
                ->get();

            /*filter student with schedule subject markledger*/
            $filteredStudent  = $students->filter(function ($student, $key) use ($alert, $emailIds, $contactNumbers){
                $balanceFee = $this->getBalanceFeeByStudentId($student->id);
                if(!$alert) {
                    return back()->with($this->message_warning, "Alert Setting not Setup. Contact Admin For More Detail.");
                }else{
                    $subject = $alert->subject;
                    $message = str_replace('{{first_name}}', $student->first_name, $alert->template );
                    $message = str_replace('{{due_amount}}', $balanceFee, $message );
                    $emailIds[] = $student->email;
                    $contactNumbers[] = $student->contact_number;

                    /*Now Send SMS On First Mobile Number*/
                    if($alert->sms == 1){
                        $contactNumbers = $this->contactFilter($contactNumbers);
                        $smssuccess = $this->sendSMS($contactNumbers,$message);
                    }

                    /*Now Send Email With Subject*/
                    if($alert->email == 1){
                        $emailIds = $this->emailFilter($emailIds);
                        $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                    }

                }
                return $student;
            });

            $request->session()->flash($this->message_success, 'Alert, Send Successfully');
            return redirect()->back();
        }else {
            $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
            return redirect()->route($this->base_route);
        }

    }



}