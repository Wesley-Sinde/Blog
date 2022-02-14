<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Hostel;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Hostel\Resident\AddValidation;
use App\Http\Requests\Hostel\Resident\EditValidation;
use App\Models\AlertSetting;
use App\Models\Bed;
use App\Models\Hostel;
use App\Models\Resident;
use App\Models\ResidentHistory;
use App\Models\Room;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Year;
use App\Traits\HostelScope;
use App\Traits\SmsEmailScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use URL;

class ResidentController extends CollegeBaseController
{
    protected $base_route = 'hostel.resident';
    protected $view_path = 'hostel.resident';
    protected $panel = 'Resident';
    protected $filter_query = [];

    use HostelScope;
    use SmsEmailScope;

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $data = [];
        $data['resident'] = Resident::select('id', 'hostels_id', 'rooms_id', 'beds_id', 'register_date', 'leave_date', 'user_type', 'member_id', 'status')
            ->where(function ($query) use ($request) {

                if ($request->get('user_type') > 0) {
                    $query->where('user_type', '=', $request->user_type);
                    $this->filter_query['user_type'] = $request->user_type;

                    if ($request->reg_no != null) {
                        if($request->get('user_type') == 1){
                            $studentId = $this->getStudentIdByReg($request->reg_no);
                            $query->where('member_id', '=', $studentId);
                            $this->filter_query['member_id'] = $studentId;
                        }
                        if($request->get('user_type') == 2){
                                $staffId = $this->getStaffByReg($request->reg_no);
                                $query->where('member_id', '=', $staffId);
                                $this->filter_query['member_id'] = $staffId;
                        }
                    }
                }

                if ($request->get('hostel') > 0) {
                    $query->where('hostels_id', '=', $request->get('hostel'));
                    $this->filter_query['hostels_id'] = $request->get('hostel');
                }

                if ($request->get('room') > 0) {
                    $query->where('rooms_id', '=', $request->get('room'));
                    $this->filter_query['rooms_id'] = $request->get('room');
                }

                if ($request->get('bed') > 0) {
                    $query->where('beds_id', '=', $request->get('bed'));
                    $this->filter_query['beds_id'] = $request->get('bed');
                }

                if ($request->get('status') > 0) {
                    $query->where('status', $request->get('status') == '1' ? 1 : 0);
                    $this->filter_query['status'] = $request->get('status');
                }
            })
            ->get();

        $data['hostels'] = $this->activeHostel();

        /*Active Hostel For Shift List*/
        $hostels = Hostel::select('id','name')->Active()->get();
        $map_hostels = array_pluck($hostels,'name','id');
        $data['active_hostels'] = array_prepend($map_hostels,'Select Hostel...','0');

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];
        $data['hostels'] = $this->activeHostel();
        $data['reg_no'] ='';
        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        $userType = $request->get('user_type');
        $regNo = $request->get('reg_no');
        $hostel = $request->get('hostel');
        $room = $request->get('room_select');
        $bed = $request->get('bed_select');
        $year = Year::where('active_status','=',1)->first();

        /*User Type and User Verification. only valid student or staff will get membership*/
        if($userType && $regNo){
            switch ($userType){
                case 1:
                    $data = Student::where('reg_no','=',$regNo)->first();
                    break;
                case 2:
                    $data = Staff::where('reg_no','=',$regNo)->first();
                    break;
                default:
                    return parent::invalidRequest();
            }
        }else{
            $request->session()->flash($this->message_warning,' Registration Number or User Type is not Valid.');
        }

        if(isset($data)){
            $request->request->add(['hostels_id' => $hostel]);
            $request->request->add(['rooms_id' => $room]);
            $request->request->add(['beds_id' => $bed]);
            $request->request->add(['user_type' => $userType]);
            $request->request->add(['member_id' => $data->id]);
            $request->request->add(['register_date' => Carbon::now()]);
            $request->request->add(['created_by' => auth()->user()->id]);

            /*Check Member Alreday Register or not*/
            $ResidentStatus = Resident::where(['user_type' => $request->user_type, 'member_id' => $data->id])->orderBy('id','desc')->first();

            if($ResidentStatus){
                $request->session()->flash($this->message_success, $this->panel. ' Already Registered. Please Edit This Resident');
                return back();
            }else{
                $ResidentRegister = Resident::create($request->all());
                /*check Resident Register and add on history table*/
                if($ResidentRegister){
                    $CreateHistory = ResidentHistory::create([
                            'years_id' => $year->id,
                            'hostels_id' => $hostel,
                            'rooms_id' => $room,
                            'beds_id' => $bed,
                            'residents_id' => $ResidentRegister->id,
                            'history_type' => "Registration",
                            'created_by' => auth()->user()->id,
                        ]);
                    /*if History Create/Assign Bed for Resident Bed Status Occupied*/
                    if($CreateHistory){
                        Bed::where('id','=',$bed)->update([
                            'bed_status' => 2
                        ]);
                    }
                }

                //send alert
                $memberId = $ResidentRegister->member_id ;
                $userType = $ResidentRegister->user_type;
                $emailIds = [];
                $contactNumbers = [];
                $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','HostelRegistration')->first();
                if(!$alert) {

                }else{
                    if($userType == 1){
                        $student = Student::select('students.id', 'students.first_name','students.email', 'ai.mobile_1')
                            ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
                            ->find($memberId);
                        //send alert
                        //Dear {{first_name}}, Congratulation! You are successfully registered in our hostel.
                        $subject = $alert->subject;
                        $message = $alert->template;
                        $message = str_replace('{{first_name}}', $student->first_name, $message );
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
                            /*sending email*/
                            $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                        }
                    }

                    if($userType == 2){
                        $staff = Staff::select('first_name','email', 'mobile_1')
                            ->find($memberId);
                        //send alert
                        //Dear {{first_name}}, Congratulation! You are successfully registered in our hostel.
                        $subject = $alert->subject;
                        $message = $alert->template;
                        $message = str_replace('{{first_name}}', $staff->first_name, $message );
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
                            /*sending email*/
                            $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                        }
                    }
                }
                //alert end

                $request->session()->flash($this->message_success, $this->panel. ' Created Successfully.');
            }
        }else{
            $request->session()->flash($this->message_warning,' Registration Number or User Type is not Valid.');
        }

        if($request->add_resident_another) {
            return back();
        }else{
            return redirect()->route($this->base_route);
        }

    }

    public function quickResident(Request $request)
    {
        $id = $request->get('residentId');
        $userType = $request->get('user_type');
        $hostel = $request->get('hostel_assign');
        $room = $request->get('room_assign');
        $bed = $request->get('bed_assign');
        $year = Year::where('active_status','=',1)->first();

        /*User Type and User Verification. only valid student or staff will get membership*/
        if($userType && $id){
            switch ($userType){
                case 1:
                    $data = Student::find($id);
                    break;
                case 2:
                    $data = Staff::find($id);
                    break;
                default:
                    return parent::invalidRequest();
            }
        }else{
            $request->session()->flash($this->message_warning,' Registration Number or User Type is not Valid.');
        }

        if(isset($data)){
            $request->request->add(['hostels_id' => $hostel]);
            $request->request->add(['rooms_id' => $room]);
            $request->request->add(['beds_id' => $bed]);
            $request->request->add(['user_type' => $userType]);
            $request->request->add(['member_id' => $data->id]);
            $request->request->add(['register_date' => Carbon::now()]);
            $request->request->add(['created_by' => auth()->user()->id]);

            /*Check Member Alreday Register or not*/
            $ResidentStatus = Resident::where(['user_type' => $request->user_type, 'member_id' => $data->id])->orderBy('id','desc')->first();

            if($ResidentStatus){
                $request->session()->flash($this->message_warning, $this->panel. ' Already Registered. Please Edit This Resident');
                return back();
            }else{
                $ResidentRegister = Resident::create($request->all());
                /*check Resident Register and add on history table*/
                if($ResidentRegister){
                    $CreateHistory = ResidentHistory::create([
                        'years_id' => $year->id,
                        'hostels_id' => $hostel,
                        'rooms_id' => $room,
                        'beds_id' => $bed,
                        'residents_id' => $ResidentRegister->id,
                        'history_type' => "Registration",
                        'created_by' => auth()->user()->id,
                    ]);
                    /*if History Create/Assign Bed for Resident Bed Status Occupied*/
                    if($CreateHistory){
                        Bed::where('id','=',$bed)->update([
                            'bed_status' => 2
                        ]);
                    }
                }

                //send alert
                $memberId = $ResidentRegister->member_id ;
                $userType = $ResidentRegister->user_type;
                $emailIds = [];
                $contactNumbers = [];
                $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','HostelRegistration')->first();
                if(!$alert) {

                }else{
                    if($userType == 1){
                        $student = Student::select('students.id', 'students.first_name','students.email', 'ai.mobile_1')
                            ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
                            ->find($memberId);
                        //send alert
                        //Dear {{first_name}}, Congratulation! You are successfully registered in our hostel.
                        $subject = $alert->subject;
                        $message = $alert->template;
                        $message = str_replace('{{first_name}}', $student->first_name, $message );
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
                            /*sending email*/
                            $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                        }
                    }

                    if($userType == 2){
                        $staff = Staff::select('first_name','email', 'mobile_1')
                            ->find($memberId);
                        //send alert
                        //Dear {{first_name}}, Congratulation! You are successfully registered in our hostel.
                        $subject = $alert->subject;
                        $message = $alert->template;
                        $message = str_replace('{{first_name}}', $staff->first_name, $message );
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
                            /*sending email*/
                            $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                        }
                    }
                }
                //alert end

                $request->session()->flash($this->message_success, $this->panel. ' Created Successfully.');
                return back();
            }
        }else{
            $request->session()->flash($this->message_warning,' Registration Number or User Type is not Valid.');
        }

    }

    public function edit(Request $request, $id)
    {
        $data = [];
        if (!$data['row'] = Resident::find($id))
            return parent::invalidRequest();

        if($data['row']->user_type == 1){
            $data['reg_no'] = Student::find($data['row']->member_id)->reg_no;
        }

        if($data['row']->user_type == 2){
            $data['reg_no'] = Staff::find($data['row']->member_id)->reg_no;
        }

        /*Hostel List*/
        $hostels = Hostel::select('id','name')->Active()->get();
        $map_hostels = array_pluck($hostels,'name','id');
        $data['hostels'] = array_prepend($map_hostels,'Select Hostel...','0');

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {

        if (!$row = Resident::find($id)) return parent::invalidRequest();

        /*User Type and User Verification. only valid student or staff will get membership*/
        if($request->get('user_type') && $request->has('reg_no')){

            switch ($request->get('user_type')){
                case 1:
                    //$data = Student::find($row->member_id);
                    $data = Student::where('reg_no','=',$request->get('reg_no'))->first();
                    break;
                case 2:
                    $data = Staff::where('reg_no','=',$request->get('reg_no'))->first();
                    break;
                default:
                    return parent::invalidRequest();
            }
        }

        if($data){
            $request->request->add(['reg_no' => $request->get('reg_no')]);
            $request->request->add(['member_id' => $data->id]);
            $request->request->add(['last_updated_by' => auth()->user()->id]);
            $request->request->add(['created_by' => auth()->user()->id]);
            /*Check Member Alreday Register or not*/
            $ResidentStatus = Resident::where([['reg_no','=',$request->reg_no],['member_id','=', $data->id]])->get();

            if($ResidentStatus->count() > 0){
                $request->session()->flash($this->message_success, $this->panel. ' Already Registered or Duplicate Registration. Please, Find on Resident List and Edit');
            }else{
                $ResidentRegister = Resident::create($request->all());
                /*check Resident Register and add on history table*/
                if($ResidentRegister){
                    $row->update($request->all());

                    $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
                }
            }
        }else{
            $request->session()->flash($this->message_warning,' Registration Number or User Type is not Valid.');
        }

        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = Resident::find($id)) return parent::invalidRequest();

        /*Delete History*/
        ResidentHistory::where('residents_id','=',$row->id)->delete();
        /*Delete Resident*/
        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

    public function bulkAction(Request $request)
    {
        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['Active', 'Shift', 'Leave', 'Delete'])) {
            /*Assign request values*/
            $hostel = $request->get('hostel_bulk');
            $room = $request->get('room_bulk');
            $bed = $request->get('bed_bulk');
            $year = Year::where('active_status','=',1)->first();

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    $row = Resident::find($row_id);
                    if($row) {
                        switch ($request->get('bulk_action')) {
                            case 'Active':
                                if($hostel && $room && $bed){
                                    /*Create Bed Available When Resident Leave*/
                                    $oldBedStatus = Bed::where([
                                        ['hostels_id', '=', $row->hostels_id],
                                        ['rooms_id', '=', $row->rooms_id],
                                        ['id', '=', $row->beds_id]
                                    ])->first();

                                    if($oldBedStatus) $oldBedStatus->update(['bed_status' => 1]);

                                    /*New Bed Occupied*/
                                    $newBedStatus = Bed::where([
                                        ['hostels_id', '=', $hostel],
                                        ['rooms_id', '=', $room],
                                        ['id', '=', $bed]
                                    ])->first();

                                    if($newBedStatus) $newBedStatus->update(['bed_status' => 2]);

                                    /*Resident New Hostel, Room & Bed Assign*/
                                    $shift = $row->update([
                                        'hostels_id' => $hostel,
                                        'rooms_id' => $room,
                                        'beds_id' => $bed,
                                        'status' => 'active'
                                    ]);

                                    if($shift) {
                                        /*Create History for Transfer Future Record*/
                                        ResidentHistory::create([
                                            'years_id' => $year->id,
                                            'hostels_id' => $hostel,
                                            'rooms_id' => $room,
                                            'beds_id' => $bed,
                                            'residents_id' => $row->id,
                                            'history_type' => "Shift",
                                            'created_by' => auth()->user()->id
                                        ]);

                                        //send alert
                                        $memberId = $row->member_id;
                                        $userType = $row->user_type;
                                        $newHostel = 'Hostel-'.$this->getHostelNameById($hostel).', Room-'.$this->getRoomNumberById($room).', Bed-'.$this->getBedNumberById($bed);
                                        $this->hostelActiveNotify($memberId,$userType, $newHostel);
                                        //alert end
                                    }

                                    $request->session()->flash($this->message_success, 'Resident Re-Activate Successfully.');
                                }elseif($hostel && $room){
                                    /*Create Bed Available When Resident Leave*/
                                    $oldBedStatus = Bed::find($row->beds_id);
                                    /*Update Old Bed Status As Available*/
                                    if($oldBedStatus) $oldBedStatus->update(['bed_status' => 1]);

                                    /*Find Available Bed To Assign Resident Automatically*/
                                    $availableBed = Bed::select('id','hostels_id','rooms_id')
                                        ->where([['hostels_id','=',$hostel],['rooms_id','=',$room],['bed_status','=',1]])
                                        ->first();

                                    if($availableBed) {
                                        /*Resident New Hostel, Room & Bed Assign*/
                                        $shift = $row->update([
                                            'hostels_id' => $hostel,
                                            'rooms_id' => $room,
                                            'beds_id' => $availableBed->id,
                                            'status' => 'active'
                                        ]);

                                        if ($shift) {
                                            /*Create History for Transfer Future Record*/
                                            ResidentHistory::create([
                                                'years_id' => $year->id,
                                                'hostels_id' => $hostel,
                                                'rooms_id' => $room,
                                                'beds_id' => $availableBed->id,
                                                'residents_id' => $row->id,
                                                'history_type' => "Shift",
                                                'created_by' => auth()->user()->id
                                            ]);

                                            //send alert
                                            $memberId = $row->member_id;
                                            $userType = $row->user_type;
                                            $newHostel = 'Hostel-'.$this->getHostelNameById($hostel).', Room-'.$this->getRoomNumberById($room);
                                            $this->hostelActiveNotify($memberId,$userType, $newHostel);
                                            //alert end
                                        }

                                        /*Update Bed Status As Occupied*/
                                        $availableBed->update(['bed_status' => 2]);
                                        $request->session()->flash($this->message_success, 'Resident Re-Activate Successfully.');
                                    }else{
                                        $request->session()->flash($this->message_success, 'No Any Bed Available in Your Target Hostel Room.');
                                    }
                                }elseif($hostel){
                                    /*Create Bed Available When Resident Leave*/
                                    $oldBedStatus = Bed::find($row->beds_id);

                                    /*Update Old Bed Status As Available*/
                                    if($oldBedStatus) $oldBedStatus->update(['bed_status' => 1]);

                                    /*Find Available Bed To Assign Resident Automatically*/
                                    $availableBed = Bed::select('id','hostels_id','rooms_id')
                                        ->where([['hostels_id','=',$hostel],['bed_status','=',1]])
                                        ->first();

                                    if($availableBed) {
                                        /*Resident New Hostel, Room & Bed Assign*/
                                        $shift = $row->update([
                                            'hostels_id' => $hostel,
                                            'rooms_id' => $availableBed->rooms_id,
                                            'beds_id' => $availableBed->id,
                                            'status' => 'active'
                                        ]);

                                        if ($shift) {
                                            /*Create History for Transfer Future Record*/
                                            ResidentHistory::create([
                                                'years_id' => $year->id,
                                                'hostels_id' => $hostel,
                                                'rooms_id' => $availableBed->rooms_id,
                                                'beds_id' => $availableBed->id,
                                                'residents_id' => $row->id,
                                                'history_type' => "Shift",
                                                'created_by' => auth()->user()->id
                                            ]);
                                            //send alert
                                            $memberId = $row->member_id;
                                            $userType = $row->user_type;
                                            $newHostel = 'Hostel-'.$this->getHostelNameById($hostel);
                                            $this->hostelActiveNotify($memberId,$userType, $newHostel);
                                            //alert end
                                        }

                                        /*Update Bed Status As Occupied*/
                                        $availableBed->update(['bed_status' => 2]);
                                    }
                                    $request->session()->flash($this->message_success, 'Resident Re-Activate Successfully.');
                                }else{
                                    $request->session()->flash($this->message_warning, 'No Any Hostel Selected. Please, Select Hostel.');
                                }
                                break;
                            case 'Shift':
                                if($hostel && $room && $bed){
                                    /*Create Bed Available When Resident Leave*/
                                    $oldBedStatus = Bed::where([
                                        ['hostels_id', '=', $row->hostels_id],
                                        ['rooms_id', '=', $row->rooms_id],
                                        ['id', '=', $row->beds_id]
                                    ])->first();

                                    if($oldBedStatus) $oldBedStatus->update(['bed_status' => 1]);

                                    /*New Bed Occupied*/
                                    $newBedStatus = Bed::where([
                                        ['hostels_id', '=', $hostel],
                                        ['rooms_id', '=', $room],
                                        ['id', '=', $bed]
                                    ])->first();

                                    if($newBedStatus) $newBedStatus->update(['bed_status' => 2]);

                                    /*Resident New Hostel, Room & Bed Assign*/
                                    $shift = $row->update([
                                        'hostels_id' => $hostel,
                                        'rooms_id' => $room,
                                        'beds_id' => $bed,
                                        'status' => 'active'
                                    ]);

                                    if($shift) {
                                        /*Create History for Transfer Future Record*/
                                        ResidentHistory::create([
                                            'years_id' => $year->id,
                                            'hostels_id' => $hostel,
                                            'rooms_id' => $room,
                                            'beds_id' => $bed,
                                            'residents_id' => $row->id,
                                            'history_type' => "Shift",
                                            'created_by' => auth()->user()->id
                                        ]);

                                        //send alert
                                        $memberId = $row->member_id;
                                        $userType = $row->user_type;
                                        $newHostel = 'Hostel-'.$this->getHostelNameById($hostel).', Room-'.$this->getRoomNumberById($room).', Bed-'.$this->getBedNumberById($bed);
                                        $this->hostelShiftNotify($memberId,$userType,$newHostel);
                                        //alert end
                                    }

                                    $request->session()->flash($this->message_success, 'Resident Shifted Successfully.');
                                }elseif($hostel && $room){
                                    /*Create Bed Available When Resident Leave*/
                                    $oldBedStatus = Bed::find($row->beds_id);
                                    /*Update Old Bed Status As Available*/
                                    if($oldBedStatus) $oldBedStatus->update(['bed_status' => 1]);

                                    /*Find Available Bed To Assign Resident Automatically*/
                                    $availableBed = Bed::select('id','hostels_id','rooms_id')
                                        ->where([['hostels_id','=',$hostel],['rooms_id','=',$room],['bed_status','=',1]])
                                        ->first();

                                    if($availableBed) {
                                        /*Resident New Hostel, Room & Bed Assign*/
                                        $shift = $row->update([
                                            'hostels_id' => $hostel,
                                            'rooms_id' => $room,
                                            'beds_id' => $availableBed->id,
                                            'status' => 'active'
                                        ]);

                                        if ($shift) {
                                            /*Create History for Transfer Future Record*/
                                            ResidentHistory::create([
                                                'years_id' => $year->id,
                                                'hostels_id' => $hostel,
                                                'rooms_id' => $room,
                                                'beds_id' => $availableBed->id,
                                                'residents_id' => $row->id,
                                                'history_type' => "Shift",
                                                'created_by' => auth()->user()->id
                                            ]);

                                            //send alert
                                            $memberId = $row->member_id;
                                            $userType = $row->user_type;
                                            $newHostel = 'Hostel-'.$this->getHostelNameById($hostel).', Room-'.$this->getRoomNumberById($room);
                                            $this->hostelShiftNotify($memberId,$userType,$newHostel);
                                            //alert end
                                        }

                                        /*Update Bed Status As Occupied*/
                                        $availableBed->update(['bed_status' => 2]);
                                        $request->session()->flash($this->message_success, 'Resident Shifted Successfully.');
                                    }else{
                                        $request->session()->flash($this->message_success, 'No Any Bed Available in Your Target Hostel Room.');
                                    }
                                }elseif($hostel){
                                    /*Create Bed Available When Resident Leave*/
                                    $oldBedStatus = Bed::find($row->beds_id);

                                    /*Update Old Bed Status As Available*/
                                    if($oldBedStatus) $oldBedStatus->update(['bed_status' => 1]);

                                    /*Find Available Bed To Assign Resident Automatically*/
                                    $availableBed = Bed::select('id','hostels_id','rooms_id')
                                        ->where([['hostels_id','=',$hostel],['bed_status','=',1]])
                                        ->first();

                                    if($availableBed) {
                                        /*Resident New Hostel, Room & Bed Assign*/
                                        $shift = $row->update([
                                            'hostels_id' => $hostel,
                                            'rooms_id' => $availableBed->rooms_id,
                                            'beds_id' => $availableBed->id
                                        ]);

                                        if ($shift) {
                                            /*Create History for Transfer Future Record*/
                                            ResidentHistory::create([
                                                'years_id' => $year->id,
                                                'hostels_id' => $hostel,
                                                'rooms_id' => $availableBed->rooms_id,
                                                'beds_id' => $availableBed->id,
                                                'residents_id' => $row->id,
                                                'history_type' => "Shift",
                                                'created_by' => auth()->user()->id
                                            ]);

                                            //send alert
                                            $memberId = $row->member_id;
                                            $userType = $row->user_type;
                                            $newHostel = 'Hostel-'.$this->getHostelNameById($hostel);
                                            $this->hostelShiftNotify($memberId,$userType,$newHostel);
                                            //alert end
                                        }

                                        /*Update Bed Status As Occupied*/
                                        $availableBed->update(['bed_status' => 2]);
                                    }
                                    $request->session()->flash($this->message_success, 'Resident Shifted Successfully.');
                                }else{
                                    $request->session()->flash($this->message_warning, 'No Any Hostel Selected. Please, Select Hostel.');
                                }
                                break;
                            case 'Leave':
                                    /*Create Bed Available When Resident Leave*/
                                    $bedStatus = Bed::where([
                                        ['hostels_id', '=', $row->hostels_id],
                                        ['rooms_id', '=', $row->rooms_id],
                                        ['id', '=', $row->beds_id]
                                    ])->first();

                                    if ($bedStatus) $bedStatus->update(['bed_status' => 1]);

                                    /*Create History for Leave Resident Future Record*/
                                    $CreateHistory = ResidentHistory::create([
                                        'years_id' => $year->id,
                                        'hostels_id' => $row->hostels_id,
                                        'rooms_id' => $row->rooms_id,
                                        'beds_id' => $row->beds_id,
                                        'residents_id' => $row->id,
                                        'history_type' => "Leave",
                                        'created_by' => auth()->user()->id
                                    ]);

                                    /*update Resident*/
                                    $request->request->add(['rooms_id' => null]);
                                    $request->request->add(['beds_id' => null]);
                                    $request->request->add(['status' => 'in-active']);
                                    $request->request->add(['last_updated_by' => auth()->user()->id]);
                                    $row->update($request->all());
                                    //send alert
                                    $memberId = $row->member_id;
                                    $userType = $row->user_type;
                                    $this->hostelLeaveNotify($memberId,$userType);
                                    //alert end
                                    $request->session()->flash($this->message_success, ' Residents Leave Successfully.');

                                break;
                            case 'Delete':
                                $row = Resident::find($row_id);
                                /*Delete History*/
                                ResidentHistory::where('residents_id', '=', $row->id)->delete();
                                /*Delete Resident*/
                                $row->delete();
                                $request->session()->flash($this->message_success, 'Residents Deleted With History Successfully.');
                                break;
                        }
                    }
                }
                return redirect()->back();
            } else {
                $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
                return redirect()->back();
            }
        } else return parent::invalidRequest();
    }

    public function renew(request $request)
    {
        $id = $request->get('residentId');
        $hostel = $request->get('hostel_assign');
        $room = $request->get('room_assign');
        $bed = $request->get('bed_assign');
        $year = Year::where('active_status','=',1)->first();

        if (!$row = Resident::find($id)) return parent::invalidRequest();

        $renewResident = $row->update([
                            'hostels_id' => $hostel,
                            'rooms_id' => $room,
                            'beds_id' => $bed,
                            'status' => 'active'
                        ]);

        if($renewResident){
            /*Create Renew History*/
            $CreateHistory = ResidentHistory::create([
                'years_id' => $year->id,
                'hostels_id' => $hostel,
                'rooms_id' => $room,
                'beds_id' => $bed,
                'residents_id' => $row->id,
                'history_type' => "Renew",
                'created_by' => auth()->user()->id,
            ]);
            /*if History Create/Assign Bed for Resident Bed Status Occupied*/
            if($CreateHistory){
                Bed::where('id','=',$bed)->update([
                    'bed_status' => 2
                ]);
            }

            //send alert
            $memberId = $row->member_id;
            $userType = $row->user_type;
            $newHostel = 'Hostel-'.$this->getHostelNameById($hostel).', Room-'.$this->getRoomNumberById($room).', Bed-'.$this->getBedNumberById($bed);
            $this->hostelActiveNotify($memberId,$userType, $newHostel);
            //alert end

            $request->session()->flash($this->message_success, $this->panel.' Re-Active Successfully.');
        }else{
            $request->session()->flash($this->message_warning, 'Not A Valid Resident.');
        }

        return redirect()->back();
    }

    public function leave(request $request, $id)
    {
        if (!$row = Resident::where('id',$id)->Active()->first()) return parent::invalidRequest();
        $hostel = $row->hostels_id;
        $room = $row->rooms_id;
        $bed = $row->beds_id;
        /*Create Bed Available When Resident Leave*/
        $bedStatus = Bed::where([
            ['hostels_id','=', $row->hostels_id],
            ['rooms_id','=', $row->rooms_id],
            ['id','=', $row->beds_id]
        ])->first();

        if($bedStatus) $bedStatus->update(['bed_status' => 1 ]);

        /*update Resident*/
        $request->request->add(['rooms_id' => null]);
        $request->request->add(['beds_id' => null]);
        $request->request->add(['status' => 'in-active']);
        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $resident = $row->update($request->all());

        $year = Year::where('active_status','=',1)->first();

        if($resident) {
            /*Create History for Leave Resident Future Record*/
            $CreateHistory = ResidentHistory::create([
                'years_id' => $year->id,
                'hostels_id' => $hostel,
                'rooms_id' => $room,
                'beds_id' => $bed,
                'residents_id' => $row->id,
                'history_type' => "Leave",
                'created_by' => auth()->user()->id
            ]);

            //send alert
            $memberId = $row->member_id;
            $userType = $row->user_type;
            $this->hostelLeaveNotify($memberId,$userType);
            //alert end

            $request->session()->flash($this->message_success, 'Resident Leave Successfully.');
        }

        return redirect()->route($this->base_route);
    }

    public function shift(request $request)
    {
        /*Get Request values on Variables */
        $id = $request->get('residentId');
        $hostel = $request->get('hostel_shift');
        $room = $request->get('room_shift');
        $bed = $request->get('bed_shift');
        $year = Year::where('active_status','=',1)->first();

        if($hostel > 0 && $room > 0 && $bed > 0) {
            $resident = Resident::where('id', $id)->Active()->first();

            if ($resident) {
                /*Create Bed Available When Resident Leave*/
                $oldBedStatus = Bed::where([
                    ['hostels_id', '=', $resident->hostels_id],
                    ['rooms_id', '=', $resident->rooms_id],
                    ['id', '=', $resident->beds_id]
                ])->first();

                if ($oldBedStatus)
                    $oldBedStatus->update(['bed_status' => 1]);

                /*New Bed Occupied*/
                $newBedStatus = Bed::where([
                    ['hostels_id', '=', $hostel],
                    ['rooms_id', '=', $room],
                    ['id', '=', $bed]
                ])->first();

                if ($newBedStatus)
                    $newBedStatus->update(['bed_status' => 2]);

                /*Resident New Hostel, Room & Bed Assign*/
                $shift = $resident->update([
                    'hostels_id' => $hostel,
                    'rooms_id' => $room,
                    'beds_id' => $bed
                ]);

                if ($shift) {
                    /*Create History for Transfer Future Record*/
                    $CreateHistory = ResidentHistory::create([
                        'years_id' => $year->id,
                        'hostels_id' => $hostel,
                        'rooms_id' => $room,
                        'beds_id' => $bed,
                        'residents_id' => $resident->id,
                        'history_type' => "Shift",
                        'created_by' => auth()->user()->id
                    ]);

                    //send alert
                    $memberId = $resident->member_id;
                    $userType = $resident->user_type;
                    $newHostel = 'Hostel-'.$this->getHostelNameById($hostel).', Room-'.$this->getRoomNumberById($room).', Bed-'.$this->getBedNumberById($bed);
                    $this->hostelShiftNotify($memberId,$userType,$newHostel);
                    //alert end
                }

                $request->session()->flash($this->message_success, 'Resident Shifted Successfully.');
            } else {
                $request->session()->flash($this->message_warning, 'Resident Not Select or Not Active, Please Active First.');
            }
        }else{
            $request->session()->flash($this->message_warning, 'Please, Select Hostel, Room and Bed First.');
        }
        return redirect()->route($this->base_route);
    }

    public function history(Request $request)
    {
        $data = [];
        if($request->all()) {
            $data['history'] = ResidentHistory::select('resident_histories.id', 'resident_histories.years_id',
                'resident_histories.hostels_id', 'resident_histories.rooms_id', 'resident_histories.beds_id',
                'resident_histories.residents_id', 'resident_histories.history_type','resident_histories.created_at',
                'r.user_type', 'r.member_id', 'r.status')
                ->where(function ($query) use ($request) {

                    if ($request->get('user_type') > 0 && $request->reg_no != null) {
                        $query->where('r.user_type', '=', $request->user_type);
                        $this->filter_query['r.user_type'] = $request->user_type;

                        if ($request->reg_no != null) {
                            if($request->get('user_type') == 1){
                                $studentId = $this->getStudentIdByReg($request->reg_no);
                                $query->where('r.member_id', '=', $studentId);
                                $this->filter_query['r.member_id'] = $studentId;
                            }
                            if($request->get('user_type') == 2){
                                $staffId = $this->getStaffByReg($request->reg_no);
                                $query->where('r.member_id', '=', $staffId);
                                $this->filter_query['r.member_id'] = $staffId;
                            }
                        }
                    }elseif($request->get('user_type') > 0 ){
                        $query->where('r.user_type', '=', $request->user_type);
                        $this->filter_query['r.user_type'] = $request->user_type;
                    }else{

                    }


                    if ($request->get('hostel') > 0) {
                        $query->where('resident_histories.hostels_id', '=', $request->get('hostel'));
                        $this->filter_query['resident_histories.hostels_id'] = $request->get('hostel');
                    }

                   if ($request->get('room') > 0) {
                        $query->where('resident_histories.rooms_id', '=', $request->get('room'));
                        $this->filter_query['resident_histories.rooms_id'] = $request->get('room');
                    }

                    if ($request->get('bed') > 0) {
                       $query->where('resident_histories.beds_id', '=', $request->get('bed'));
                       $this->filter_query['resident_histories.beds_id'] = $request->get('bed');
                   }

                    if ($request->get('year') > 0) {
                        $query->where('resident_histories.years_id', '=', $request->get('year'));
                        $this->filter_query['resident_histories.years_id'] = $request->get('year');
                    }

                    if ($request->history_type !== ''){
                        $query->where('resident_histories.history_type', '=', $request->get('history_type'));
                        $this->filter_query['resident_histories.history_type'] = $request->get('history_type');
                    }

                })
                ->join('residents as r', 'r.id', '=', 'resident_histories.residents_id')
                ->join('beds as b', 'b.id', '=', 'resident_histories.beds_id')
                ->orderBy('resident_histories.created_at')
                ->get();
        }

        $data['years'] = $this->activeYears();
        $data['hostels'] = $this->activeHostel();
        $data['url'] = URL::current();
        return view(parent::loadDataToView($this->view_path.'.history.index'), compact('data'));
    }

    public function findRooms(Request $request)
    {
        $response = [];
        $response['error'] = true;

        if ($request->has('hostel_id')) {
            $hostels = Room::select('id','room_number')
                ->where('hostels_id','=', $request->get('hostel_id'))
                ->get();

            if ($hostels) {
                $response['rooms'] = $hostels;
                $response['error'] = false;
                $response['success'] = 'Rooms Available For This Hostel.';
            } else {
                $response['error'] = 'No Any Rooms Assign on This Hostel.';
            }

        } else {
            $response['message'] = 'Invalid request!!';
        }
        return response()->json(json_encode($response));
    }

    public function findBeds(Request $request)
    {
        $response = [];
        $response['error'] = true;

        if ($request->has('room_id')) {
            $beds = Bed::select('id','bed_number')
                ->where('rooms_id','=', $request->get('room_id'))
                ->get();

            if ($beds) {
                $response['beds'] = $beds;
                $response['error'] = false;
                $response['success'] = 'Rooms Available For This Hostel.';
            } else {
                $response['error'] = 'No Any Rooms Assign on This Hostel.';
            }

        }else{
            $response['message'] = 'Invalid request!!';
        }
        return response()->json(json_encode($response));
    }

    //manage alert
    public function hostelActiveNotify($memberId,$userType, $newHostel)
    {
        $emailIds = [];
        $contactNumbers = [];
        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','HostelActive')->first();
        if(!$alert) {

        }else{
            if($userType == 1){
                $student = Student::select('students.id', 'students.first_name','students.email', 'ai.mobile_1')
                    ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
                    ->find($memberId);
                //send alert
                //Dear {{first_name}}, You are successfully re-Activated for our hostel service in {{new_hostel}}.
                $subject = $alert->subject;
                $message = $alert->template;
                $message = str_replace('{{first_name}}', $student->first_name, $message );
                $message = str_replace('{{new_hostel}}', $newHostel, $message );
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
                    /*sending email*/
                    $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                }
            }

            if($userType == 2){
                $staff = Staff::select('first_name','email', 'mobile_1')
                    ->find($memberId);
                //send alert
                //Dear {{first_name}}, You are successfully re-Activated for our hostel service in {{new_hostel}}.
                $subject = $alert->subject;
                $message = $alert->template;
                $message = str_replace('{{first_name}}', $staff->first_name, $message );
                $message = str_replace('{{new_hostel}}', $newHostel, $message );
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
                    /*sending email*/
                    $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                }
            }
        }
    }

    public function hostelShiftNotify($memberId,$userType, $newHostel)
    {
        $emailIds = [];
        $contactNumbers = [];
        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','HostelShift')->first();
        if(!$alert) {

        }else{
            if($userType == 1){
                $student = Student::select('students.id', 'students.first_name','students.email', 'ai.mobile_1')
                    ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
                    ->find($memberId);
                //send alert
                //Dear {{first_name}}, Congratulation! You are successfully shifted in {{new_hostel}}.
                $subject = $alert->subject;
                $message = $alert->template;
                $message = str_replace('{{first_name}}', $student->first_name, $message );
                $message = str_replace('{{new_hostel}}', $newHostel, $message );
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
                    /*sending email*/
                    $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                }
            }

            if($userType == 2){
                $staff = Staff::select('first_name','email', 'mobile_1')
                    ->find($memberId);
                //send alert
                //Dear {{first_name}}, Congratulation! You are successfully registered in our hostel.
                $subject = $alert->subject;
                $message = $alert->template;
                $message = str_replace('{{first_name}}', $staff->first_name, $message );
                $message = str_replace('{{new_hostel}}', $newHostel, $message );
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
                    /*sending email*/
                    $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                }
            }
        }
    }

    public function hostelLeaveNotify($memberId,$userType)
    {
        $emailIds = [];
        $contactNumbers = [];
        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','HostelLeave')->first();
        if(!$alert) {

        }else{
            if($userType == 1){
                $student = Student::select('students.id', 'students.first_name','students.email', 'ai.mobile_1')
                    ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
                    ->find($memberId);
                //send alert
                //Dear {{first_name}}, You are successfully leaving from our hostel. Thank you.
                $subject = $alert->subject;
                $message = $alert->template;
                $message = str_replace('{{first_name}}', $student->first_name, $message );
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
                    /*sending email*/
                    $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                }
            }

            if($userType == 2){
                $staff = Staff::select('first_name','email', 'mobile_1')
                    ->find($memberId);
                //send alert
                //Dear {{first_name}}, You are successfully leaving from our hostel. Thank you.
                $subject = $alert->subject;
                $message = $alert->template;
                $message = str_replace('{{first_name}}', $staff->first_name, $message );
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
                    /*sending email*/
                    $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                }
            }
        }
    }

}