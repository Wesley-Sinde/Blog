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
use App\Models\AttendanceMaster;
use App\Models\AttendanceStatus;
use App\Models\Month;
use App\Models\Staff;
use App\Models\StaffDesignation;
use App\Models\Year;
use App\Traits\AcademicScope;
use App\Traits\SmsEmailScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use View, URL;

class StaffAttendanceController extends CollegeBaseController
{
    protected $base_route = 'attendance.staff';
    protected $view_path = 'attendance.staff';
    protected $panel = 'Staff Attendance';
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
            $staffs = Attendance::select('attendances.id', 'attendances.attendees_type', 'attendances.link_id',
                'attendances.years_id', 'attendances.months_id', 'attendances.day_1', 'attendances.day_2', 'attendances.day_3',
                'attendances.day_4', 'attendances.day_5', 'attendances.day_6', 'attendances.day_7', 'attendances.day_8',
                'attendances.day_9', 'attendances.day_10', 'attendances.day_11', 'attendances.day_12', 'attendances.day_13',
                'attendances.day_14', 'attendances.day_15', 'attendances.day_16', 'attendances.day_17', 'attendances.day_18',
                'attendances.day_19', 'attendances.day_20', 'attendances.day_21', 'attendances.day_22', 'attendances.day_23',
                'attendances.day_24', 'attendances.day_25', 'attendances.day_26', 'attendances.day_27', 'attendances.day_28',
                'attendances.day_29', 'attendances.day_30', 'attendances.day_31','attendances.day_32', 'staff.id as staff_id', 'staff.reg_no',
                'staff.first_name', 'staff.middle_name', 'staff.last_name', 'staff.designation')
                ->where('attendances.attendees_type', 2)
                ->where(function ($query) use ($request) {
                    $this->commonStaffFilterCondition($query, $request);

                    if ($request->has('year') && $request->get('year') != 0) {
                        $query->where('attendances.years_id', '=', $request->year);
                        $this->filter_query['attendances.years_id'] = $request->year;
                    }

                    if ($request->has('month') && $request->get('month') != 0) {
                        $query->where('attendances.months_id', '=', $request->month);
                        $this->filter_query['attendances.months_id'] = $request->month;
                    }

                })
                ->join('staff', 'staff.id', '=', 'attendances.link_id')
                ->orderBy('staff.id','asc')
                ->orderBy('attendances.years_id','asc')
                ->orderBy('attendances.months_id','asc')
                ->orderBy('attendances.link_id','asc')
                ->get();

        }else{
            $staffs = Attendance::select('attendances.id', 'attendances.attendees_type', 'attendances.link_id',
                'attendances.years_id', 'attendances.months_id', 'attendances.day_1', 'attendances.day_2', 'attendances.day_3',
                'attendances.day_4', 'attendances.day_5', 'attendances.day_6', 'attendances.day_7', 'attendances.day_8',
                'attendances.day_9', 'attendances.day_10', 'attendances.day_11', 'attendances.day_12', 'attendances.day_13',
                'attendances.day_14', 'attendances.day_15', 'attendances.day_16', 'attendances.day_17', 'attendances.day_18',
                'attendances.day_19', 'attendances.day_20', 'attendances.day_21', 'attendances.day_22', 'attendances.day_23',
                'attendances.day_24', 'attendances.day_25', 'attendances.day_26', 'attendances.day_27', 'attendances.day_28',
                'attendances.day_29', 'attendances.day_30', 'attendances.day_31','attendances.day_32', 'staff.id as students_id', 'staff.reg_no',
                'staff.first_name', 'staff.middle_name', 'staff.last_name', 'staff.designation')
                ->where('attendances.attendees_type', 2)
                ->join('staff', 'staff.id', '=', 'attendances.link_id')
                ->orderBy('attendances.years_id','asc')
                ->orderBy('attendances.months_id','asc')
                ->get();
        }

        $attendanceStatus = AttendanceStatus::get();

        if(isset($staffs)){
            $filteredStaff = $staffs->filter(function ($staff, $key) use($attendanceStatus) {
                for ($day = 1; $day <= 32; $day++) {
                    $dayCode = "day_".$day;
                    foreach ($attendanceStatus as $attenStatus){
                        if($staff->$dayCode == $attenStatus->id){
                            $attenTitle = $attenStatus->title;
                            $staff->$attenTitle = $staff->$attenTitle + 1;
                        }
                    }
                }

                return $staff;

            });

            $data['staff'] = $filteredStaff;
        }

        $data['attendanceStatus'] = $attendanceStatus;
        $data['years'] = $this->activeYears();
        $data['months'] = $this->activeMonths();
        $data['designation'] = $this->staffDesignationList();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];
        $data['designation'] = $this->staffDesignationList();
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

        $designation = $request->get('designation');

        if($request->has('staffs_id')) {
            foreach ($request->get('staffs_id') as $staff) {

                if($designation >0){
                    $attendanceExist = Attendance::select('attendances.id','attendances.attendees_type','attendances.link_id',
                        'attendances.years_id','attendances.months_id','attendances.'.$day,
                        'staff.id as students_id','staff.reg_no','staff.first_name','staff.middle_name','staff.last_name')
                        ->where('attendances.attendees_type',2)
                        ->where('attendances.years_id',$year)
                        ->where('attendances.months_id',$month)
                        ->where([['staff.id', '=' , $staff],['staff.designation', '=' , $designation]])
                        ->join('staff','staff.id','=','attendances.link_id')
                        ->first();
                }else{
                    $attendanceExist = Attendance::select('attendances.id','attendances.attendees_type','attendances.link_id',
                        'attendances.years_id','attendances.months_id','attendances.'.$day,
                        'staff.id as students_id','staff.reg_no','staff.first_name','staff.middle_name','staff.last_name')
                        ->where('attendances.attendees_type',2)
                        ->where('attendances.years_id',$year)
                        ->where('attendances.months_id',$month)
                        ->where([['staff.id', '=' , $staff]])
                        ->join('staff','staff.id','=','attendances.link_id')
                        ->first();
                }

                /*get ledger exist student id*/
                if ($attendanceExist) {
                    /*Update Already Register Attendance Ledger*/
                    $Update = [
                        'attendees_type' => 2,
                        'link_id' => $staff,
                        'years_id' => $year,
                        'months_id' => $month,
                        $day => $request->get($staff),
                        'last_updated_by' => auth()->user()->id
                    ];

                    $attendanceExist->update($Update);
                }else{
                    /*Schedule When Not Scheduled Yet*/
                    Attendance::create([
                        'attendees_type' => 2,
                        'link_id' => $staff,
                        'years_id' => $year,
                        'months_id' => $month,
                        $day => $request->get($staff),
                        'created_by' => auth()->user()->id,
                    ]);

                }
            }

            /*confirmation*/
            if($request->has('send_alert') && $request->get('send_alert') ==1){
                $this->attendanceConfirm($date);
            }

            /*Absent confirmation*/
            if($request->has('send_alert') && $request->get('send_alert') ==2){
                $this->attendanceAbsentConfirm($date);
            }

            /*Absent confirmation to Head*/
            if($request->has('send_alert') && $request->get('send_alert') ==3){
                $this->attendanceAbsentConfirmToHead($date);
            }

            $request->session()->flash($this->message_success, $this->panel. ' Managed Successfully.');
            return redirect()->back();
        }else{
            $request->session()->flash($this->message_warning, 'You Have No Any Staff to Managed Attendance. ');
            return back();
        }


        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = Attendance::find($id)) return parent::invalidRequest();

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
                            $row = Attendance::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = Attendance::find($row_id);
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

    public function staffHtmlRow(Request $request)
    {
        $response = [];
        $response['error'] = true;
        $date = Carbon::parse($request->get('date'));
        $month = Carbon::createFromFormat('Y-m-d H:i:s', $date)->month;
        $day = "day_" . Carbon::createFromFormat('Y-m-d H:i:s', $date)->day;
        $yearTitle = Carbon::createFromFormat('Y-m-d H:i:s', $date)->year;
        $year = Year::where('title', $yearTitle)->first()->id;

        $attendanceStatus = AttendanceStatus::get();

        $designation = $request->get('designation_id');

        if($designation > 0){

            /*For Staff List*/
            $attendanceExist = Attendance::select('attendances.attendees_type', 'attendances.link_id',
                'attendances.years_id', 'attendances.months_id', 'attendances.' . $day,
                'staff.id as staff_id', 'staff.reg_no', 'staff.first_name', 'staff.middle_name', 'staff.last_name', 'staff.staff_image')
                ->where('attendances.attendees_type', 2)
                ->where('attendances.years_id', $year)
                ->where('attendances.months_id', $month)
                ->where($day, '<>', 0)
                ->where('staff.designation', $designation)
                ->join('staff', 'staff.id', '=', 'attendances.link_id')
                ->get();

            /*get ledger exist staff id*/
            $dayStatus = array_pluck($attendanceExist, $day);
            $existStaffId = array_pluck($attendanceExist, 'staff_id');

            //Get Active Staff For Related Designation
            $activeStaff = Staff::select('id', 'reg_no', 'first_name', 'middle_name', 'last_name', 'staff_image')
                ->where('designation', $designation)
                ->whereNotIn('id', $existStaffId)
                ->Active()
                ->orderBy('id', 'asc')
                ->get();

        }else{

            /*For Staff List*/
            $attendanceExist = Attendance::select('attendances.attendees_type', 'attendances.link_id',
                'attendances.years_id', 'attendances.months_id', 'attendances.' . $day,
                'staff.id as staff_id', 'staff.reg_no', 'staff.first_name', 'staff.middle_name', 'staff.last_name', 'staff.staff_image')
                ->where('attendances.attendees_type', 2)
                ->where('attendances.years_id', $year)
                ->where('attendances.months_id', $month)
                ->where($day, '<>', 0)
                ->join('staff', 'staff.id', '=', 'attendances.link_id')
                ->get();

            /*get ledger exist staff id*/
            $dayStatus = array_pluck($attendanceExist, $day);
            $existStaffId = array_pluck($attendanceExist, 'staff_id');

            //Get Active Staff For Related Designation
            $activeStaff = Staff::select('id', 'reg_no', 'first_name', 'middle_name', 'last_name', 'staff_image')
                ->whereNotIn('id', $existStaffId)
                ->Active()
                ->orderBy('id', 'asc')
                ->get();
        }

        if($activeStaff) {
            if($attendanceExist){
                $response['error'] = false;

                $response['exist'] = view($this->view_path.'.includes.staff_tr_rows', [
                    'exist' => $attendanceExist,
                    'attendanceStatus' => $attendanceStatus,
                    'dayStatus' => $dayStatus,
                    'day' => $day,
                ])->render();

                $response['staffs'] = view($this->view_path.'.includes.staff_tr', [
                    'staffs' => $activeStaff,
                    'attendanceStatus' => $attendanceStatus
                ])->render();

                $response['message'] = 'Active Staff Found. Please, Managed Attendance.';
            }else{
                $response['error'] = false;

                $response['staffs'] = view($this->view_path.'.includes.staff_tr', [
                    'staffs' => $activeStaff
                ])->render();

                $response['message'] = 'Active Staff Found. Please, Managed Attendance.';
            }
        }else{
            $response['error'] = 'No Any Active Staffs Found.';
        }

        return response()->json(json_encode($response));
    }

    /*Send Attendance Alert*/
    public function attendanceConfirm($date)
    {
        $month = Carbon::createFromFormat('Y-m-d H:i:s', $date)->month;
        $day = "day_".Carbon::createFromFormat('Y-m-d H:i:s', $date)->day;
        $yearTitle = Carbon::createFromFormat('Y-m-d H:i:s', $date)->year;
        $year = Year::where('title',$yearTitle)->first()->id;


        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','StaffAttendance')->first();
        if(!$alert)
            return back()->with($this->message_warning, "Alert Setting not Setup. Contact Admin For More Detail.");

        $sms = false;
        $email = false;

        $attendanceExist = Attendance::select('attendances.id','attendances.attendees_type','attendances.link_id',
            'attendances.years_id','attendances.months_id','attendances.'.$day,
            'staff.id as staff_id','staff.first_name','staff.mobile_1','staff.email')
            ->where('attendances.attendees_type',2)
            ->where('attendances.years_id',$year)
            ->where('attendances.months_id',$month)
            ->join('staff','staff.id','=','attendances.link_id')
            ->get();

        if($attendanceExist && $attendanceExist->count() > 0) {
            foreach ($attendanceExist as $attendance) {
                $subject = $alert->subject;
                $Name = $attendance->first_name;
                $contact = $attendance->mobile_1;
                $email = $attendance->email;
                $message = str_replace('{{first_name}}', $Name, $alert->template);
                $message = str_replace('{{status}}', $this->getAttendanceFullStatus($attendance->$day), $message);
                $message = str_replace('{{date}}', Carbon::parse($date)->format('M d , Y'), $message);


                /*Now Send SMS On First Mobile Number*/
                if ($alert->sms == 1 && isset($contact)) {
                    $contactNumbers = array($contact);
                    $contactNumbers = $this->contactFilter($contactNumbers);
                    $smssuccess = $this->sendSMS($contactNumbers, $message);
                    $sms = true;
                }

                if ($alert->email == 1 && isset($email)) {
                    $emailIds = array($email);
                    $emailIds = $this->emailFilter($emailIds);
                    $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                    $email = true;
                }

            }

        }
    }

    public function attendanceAbsentConfirm( $date)
    {
        $month = Carbon::createFromFormat('Y-m-d H:i:s', $date)->month;
        $day = "day_".Carbon::createFromFormat('Y-m-d H:i:s', $date)->day;
        $yearTitle = Carbon::createFromFormat('Y-m-d H:i:s', $date)->year;
        $year = Year::where('title',$yearTitle)->first()->id;


        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','StaffAttendance')->first();
        if(!$alert)
            return back()->with($this->message_warning, "Alert Setting not Setup. Contact Admin For More Detail.");

        $sms = false;
        $email = false;

        $attendanceExist = Attendance::select('attendances.id','attendances.attendees_type','attendances.link_id',
            'attendances.years_id','attendances.months_id','attendances.'.$day,
            'staff.id as staff_id','staff.first_name','staff.mobile_1','staff.email')
            ->where('attendances.attendees_type',2)
            ->where('attendances.years_id',$year)
            ->where('attendances.months_id',$month)
            ->where('attendances.'.$day,2)//2 for absent
            ->join('staff','staff.id','=','attendances.link_id')
            ->get();

        if($attendanceExist && $attendanceExist->count() > 0) {
            foreach ($attendanceExist as $attendance) {
                $subject = $alert->subject;
                $Name = $attendance->first_name;
                $contact = $attendance->mobile_1;
                $email = $attendance->email;
                $message = str_replace('{{first_name}}', $Name, $alert->template);
                $message = str_replace('{{status}}', $this->getAttendanceFullStatus($attendance->$day), $message);
                $message = str_replace('{{date}}', Carbon::parse($date)->format('M d , Y'), $message);

                /*Now Send SMS On First Mobile Number*/
                if ($alert->sms == 1 && isset($contact)) {
                    $contactNumbers = array($contact);
                    $contactNumbers = $this->contactFilter($contactNumbers);
                    $smssuccess = $this->sendSMS($contactNumbers, $message);
                    $sms = true;
                }

                if ($alert->email == 1 && isset($email)) {
                    $emailIds = array($email);
                    $emailIds = $this->emailFilter($emailIds);
                    $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                    $email = true;
                }

            }

        }
    }

    public function attendanceAbsentConfirmToHead( $date)
    {
        $month = Carbon::createFromFormat('Y-m-d H:i:s', $date)->month;
        $day = "day_".Carbon::createFromFormat('Y-m-d H:i:s', $date)->day;
        $yearTitle = Carbon::createFromFormat('Y-m-d H:i:s', $date)->year;
        $year = Year::where('title',$yearTitle)->first()->id;

        //$generalSetting = $this->getGeneralSetting();
        $headNumbers= explode(',',getenv('STAFF_ABSENT_NOTIFICATION_HEAD_NUMBERS'));

        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','StaffAbsentNotification')->first();
        if(!$alert)
            return back()->with($this->message_warning, "Alert Setting not Setup. Contact Admin For More Detail.");

        $sms = false;
        $email = false;

        $attendanceExist = Attendance::select('attendances.id','attendances.attendees_type','attendances.link_id',
            'attendances.years_id','attendances.months_id','attendances.'.$day,
            'staff.id as staff_id','staff.first_name','staff.mobile_1','staff.email')
            ->where('attendances.attendees_type',2)
            ->where('attendances.years_id',$year)
            ->where('attendances.months_id',$month)
            ->where('attendances.'.$day,2)//2 for absent
            ->join('staff','staff.id','=','attendances.link_id')
            ->get();
       //Dear Sir, This is to inform you following staffs are absent today.{{staffs_name}}

        $staffs_name = implode(',',$attendanceExist->pluck('first_name')->toArray());

        $subject = $alert->subject;
        $contact = $headNumbers;
        $message = str_replace('{{staffs_name}}', $staffs_name, $alert->template);

        /*Now Send SMS On First Mobile Number*/
        if ($alert->sms == 1 && isset($contact)) {
            $contactNumbers = $contact;
            $contactNumbers = $this->contactFilter($contactNumbers);
            $smssuccess = $this->sendSMS($contactNumbers, $message);
            $sms = true;
        }

        if ($alert->email == 1 && isset($email)) {
            $emailIds = array($email);
            $emailIds = $this->emailFilter($emailIds);
            $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
            $email = true;
        }

    }


}