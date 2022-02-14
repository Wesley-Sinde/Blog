<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Meeting;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Meeting\AddValidation;
use App\Http\Requests\Meeting\EditValidation;
use App\Models\AlertSetting;
use App\Models\Faculty;
use App\Models\Meeting;
use App\Models\Semester;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Subject;
use App\Traits\MeetingScopes;
use App\Traits\SmsEmailScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use ViewHelper;
use URL, view;

class ZoomMeetingController extends CollegeBaseController
{
    protected $base_route = 'meeting';
    protected $view_path = 'meeting';
    protected $panel = 'Meeting';
    protected $filter_query = [];
    protected $zoom;

    use MeetingScopes;
    use SmsEmailScope;

    public function __construct()
    {
        $this->zoom = new \MacsiDigital\Zoom\Zoom;
    }

    public function zoomIndex(Request $request)
    {
        $data = [];
        $setting = $this->getMeetingSetting();
        $meetingSetting = json_decode($setting['Zoom'],true);
        $data['meetings'] = $this->zoom->user->find($meetingSetting['Email'])->meetings()->all();
        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.zoom-index'), compact('data'));
    }

    public function index(Request $request)
    {
        $data = [];
        if($request->all()) {
            if(auth()->user()->hasRole('staff')) {
                $id = auth()->user()->id;
                $staffId = auth()->user()->hook_id;
                $subjects = Subject::where('staff_id',$staffId)->get()->pluck('id');
                $data['meetings'] = Meeting::where(function ($query) use ($request) {

                                            if ($request->semesters_id && $request->semesters_id != "" && $request->semesters_id > 0) {
                                                $query->where('semesters_id', '=', $request->semesters_id);
                                                $this->filter_query['semesters_id'] = $request->semesters_id;
                                            }

                                            if ($request->subjects_id && $request->subjects_id != "" && $request->subjects_id > 0) {
                                                $query->where('subjects_id', '=', $request->subjects_id);
                                                $this->filter_query['subjects_id'] = $request->subjects_id;
                                            }

                                            if ($request->has('schedule_date_start') && $request->has('schedule_date_end')) {
                                                $query->whereBetween('start_time', [$request->get('schedule_date_start'), $request->get('schedule_date_end')]);
                                                $this->filter_query['schedule_date_start'] = $request->get('schedule_date_start');
                                                $this->filter_query['schedule_date_end'] = $request->get('schedule_date_end');
                                            }
                                            elseif ($request->has('schedule_date_start')) {
                                                $query->where('start_time', '>=', $request->get('schedule_date_start'));
                                                $this->filter_query['schedule_date_start'] = $request->get('schedule_date_start');
                                            }
                                            elseif($request->has('schedule_date_end')) {
                                                $query->where('start_time', '<=', $request->get('schedule_date_end'));
                                                $this->filter_query['schedule_date_end'] = $request->get('schedule_date_end');
                                            }

                                        })
                                        ->where(function ($query) use($subjects,$id){
                                            $query->whereIn('subjects_id',$subjects)
                                                ->orWhere('created_by',$id);
                                        })
                                        ->latest()
                                        ->get();
            }else{
                $data['meetings'] = Meeting::where(function ($query) use ($request) {

                    if ($request->semesters_id && $request->semesters_id != "" && $request->semesters_id > 0) {
                        $query->where('semesters_id', '=', $request->semesters_id);
                        $this->filter_query['semesters_id'] = $request->semesters_id;
                    }

                    if ($request->subjects_id && $request->subjects_id != "" && $request->subjects_id > 0) {
                        $query->where('subjects_id', '=', $request->subjects_id);
                        $this->filter_query['subjects_id'] = $request->subjects_id;
                    }

                    if ($request->has('schedule_date_start') && $request->has('schedule_date_end')) {
                        $query->whereBetween('start_time', [$request->get('schedule_date_start'), $request->get('schedule_date_end')]);
                        $this->filter_query['schedule_date_start'] = $request->get('schedule_date_start');
                        $this->filter_query['schedule_date_end'] = $request->get('schedule_date_end');
                    }
                    elseif ($request->has('schedule_date_start')) {
                        $query->where('start_time', '>=', $request->get('schedule_date_start'));
                        $this->filter_query['schedule_date_start'] = $request->get('schedule_date_start');
                    }
                    elseif($request->has('schedule_date_end')) {
                        $query->where('start_time', '<=', $request->get('schedule_date_end'));
                        $this->filter_query['schedule_date_end'] = $request->get('schedule_date_end');
                    }
                })
                    ->latest()
                    ->get();
            }
        }else{
            if(auth()->user()->hasRole('staff')) {
                $id = auth()->user()->id;
                $staffId = auth()->user()->hook_id;
                $subjects = Subject::where('staff_id',$staffId)->get()->pluck('id');
                $data['meetings'] = Meeting::whereIn('subjects_id',$subjects)
                            ->orWhere('created_by',$id)
                            ->latest()
                            ->limit(100)
                            ->get();
            }else {
                $data['meetings'] = Meeting::latest()
                    ->limit(100)
                    ->get();
            }
        }

        $data['faculties'] = $this->activeFaculties();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add()
    {
        $data = [];
        $data['faculties'] = $this->activeFaculties();

        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(AddValidation $request)
    {

        $setting = $this->getMeetingSetting();
        $meetingSetting = json_decode($setting['Zoom'],true);

        $startTime = $request->start_time;
        $date = Carbon::parse($startTime)->format('Y-m-d');
        $time = Carbon::parse($startTime)->format('H:i:s');
        $datetime = $date.'T'.$time.'Z';
        $request->request->add(['start_time' => $datetime]);

        $request->request->add(['type' => 2]);
        $request->request->add(['timezone' => getenv('APP_TIMEZONE','')]);

        $user = $this->zoom->user->find($meetingSetting['Email']);
        $meeting = $user->meetings()->create($request->all());

        //manage History
        if($meeting){
            $meetingId = $meeting->id;
            //extra info reference text
            $reftext = [
                "uuid"          =>  $meeting->uuid,
                "id"            =>  $meetingId,
                "host_id"       =>  $meeting->host_id,
                "created_at"    =>  $meeting->created_at,
                "join_url"      =>  $meeting->join_url,
                "topic"         =>  $meeting->topic,
                "type"          =>  $meeting->type,
                "status"        =>  $meeting->status,
                "start_time"    =>  $meeting->start_time,
                "duration"      =>  $meeting->duration,
                "timezone"      =>  $meeting->timezone,
                "password"      =>  $meeting->password,
                "agenda"        =>  $meeting->agenda,
                "start_url"     =>  $meeting->start_url,
            ];

            $CreateHistory = Meeting::create([
                'created_by' => auth()->user()->id,
                'semesters_id' => $request->semesters_id,
                'subjects_id' => $request->subjects_id,
                'meeting_id' => $meetingId,
                'topic' => $meeting->topic,
                'start_time' => $startTime,
                'duration' => $meeting->duration,
                'timezone' => $meeting->timezone,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
                'history_type' => 'created',
                'ref_text' => json_encode($reftext),
            ]);

            //send Invitation Through Email/SMS Alert
            if($CreateHistory && $request->send_alert == 1){
                $this->meetingAlert('schedule',encrypt($CreateHistory->id));
            }
        }

        if($request->add_meeting_another) {
            return back();
        }else{
            return redirect()->route($this->base_route);
        }
    }

    public function delete(Request $request, $id)
    {
        $id = decrypt($id);
        //get user and create meetings
        $row = Meeting::find($id);
        if (!$row) return parent::invalidRequest();

        if(auth()->user()->hasRole('staff')) {
            $UserId = auth()->user()->id;
            if($row->created_by != $UserId){
                return parent::invalidRequest();
            }
        }

      /*  $zoomMeeting = $this->zoom->meeting->find($row->meeting_id);

        if($zoomMeeting){
            $zoomMeeting->delete();
        }*/

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

    public function bulkAction(Request $request)
    {
        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['complete', 'pending', 'delete'])) {

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    $id = decrypt($row_id);
                    switch ($request->get('bulk_action')) {
                        case 'complete':
                        case 'pending':
                            $row = Meeting::find($id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            //get user and create meetings
                            $row = Meeting::find($id);
                            if ($row) {
                                if(auth()->user()->hasRole('staff')) {
                                    $UserId = auth()->user()->id;
                                    if($row->created_by == $UserId){
                                        $row->delete();
                                    }
                                }else{
                                    /*$zoomMeeting = $this->zoom->meeting->find($row->meeting_id);
                                    if($zoomMeeting){
                                        $zoomMeeting->delete();
                                    }*/
                                    $row->delete();
                                }

                            }

                            break;
                    }
                }

                if ($request->get('bulk_action') == 'complete' || $request->get('bulk_action') == 'pending')
                    $request->session()->flash($this->message_success, $this->panel.' '.$request->get('bulk_action'). ' Successfully.');
                else
                    $request->session()->flash($this->message_success, $this->panel.' Deleted successfully.');

                return redirect()->route($this->base_route);

            } else {
                $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
                return redirect()->route($this->base_route);
            }

        } else return parent::invalidRequest();

    }

    public function complete(request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Meeting::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);
        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' Successfully Completed.');
        return back();
    }

    public function start(request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Meeting::find($id)) return parent::invalidRequest();

        if(auth()->user()->hasRole('staff')) {
            $UserId = auth()->user()->id;
            if($row->created_by != $UserId){
                $request->session()->flash($this->message_warning, 'You are unable to start meeting. Please Contact Scheduler.');
            }else{
                $request->request->add(['status' => 3]);
                $meetingStart = $row->update($request->all());
                $request->session()->flash($this->message_success, $this->panel.' Meeting Status Mark with Start Successfully.');

            }
        }

        if(auth()->user()->hasRole('staff')) {
            $UserId = auth()->user()->id;
            if($row->created_by != $UserId){
                $request->session()->flash($this->message_warning, 'You are unable to start meeting. Please Contact Scheduler.');
            }else{
                $request->request->add(['status' => 3]);
                $meetingStart = $row->update($request->all());
                $request->session()->flash($this->message_success, $this->panel.' Meeting Status Mark with Start Successfully.');

            }
        }

        if(auth()->user()->ability(array('super-admin'), array('meeting-start'))) {
            $request->request->add(['status' => 3]);
            $meetingStart = $row->update($request->all());
            $request->session()->flash($this->message_success, $this->panel.' Meeting Status Mark with Start Successfully.');
        }

        //send Invitation Through Email/SMS Alert
        if($meetingStart){
            $this->meetingAlert('start',encrypt($row->id));
        }
        return back();
    }

    public function pending(request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = Meeting::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);
        $row->update($request->all());
        $request->session()->flash($this->message_success, $this->panel.' Mark on Pending.');
        return back();
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
            $response['success'] = 'Subjects Found, Select Subject and Manage Question.';
        }else {
            $response['error'] = 'No Any Subject Found. Please Contact Your Administrator.';
        }

        return response()->json(json_encode($response));
    }

    //send meeting Schedule & Start Join invitation
    public function meetingAlert($event,$id)
    {
        $id = decrypt($id);
        //get schedule
        $meetingDetail = Meeting::find($id);

        if($meetingDetail){
            //get meeting detail for alert templating;
            $semester = $this->getSemesterById($meetingDetail->semesters_id);
            $course = $this->getSubjectById($meetingDetail->subjects_id);
            $topic = $meetingDetail->topic;
            $time = Carbon::parse($meetingDetail->start_time)->format('D, d-M-Y | H:i:s A');

            //get student data
            $students = Student::select('students.first_name', 'students.email', 'ai.mobile_1')
                ->where('students.semester','=',$meetingDetail->semesters_id)
                ->join('addressinfos as ai','ai.students_id','=','students.id')
                ->distinct()
                ->get();

            if($event == 'schedule'){
                //schedule alert
                $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','MeetingScheduleInvitation')->first();
                if(!$alert)
                    return back()->with($this->message_warning, "Alert Setting not Setup. Contact Admin For More Detail.");

                /*filter student and send alert*/
                $filteredStudent  = $students->filter(function ($student, $key) use ($alert,$semester,$course,$topic,$time){
                    if(!$alert) {

                    }else{
                        //Dear {{first_name}}, {{semester}}/{{subject}}/{{topic}} Meeting Scheduled @{{start_time}}. Please Present on Time And Connect. Thank you
                        $subject = $alert->subject;
                        $message = $alert->template;
                        $message = str_replace('{{first_name}}', $student->first_name, $message);
                        $message = str_replace('{{semester}}', $semester, $message);
                        $message = str_replace('{{subject}}', $course, $message);
                        $message = str_replace('{{topic}}', $topic, $message);
                        $message = str_replace('{{start_time}}', $time, $message);
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

                        return back()->with($this->message_success, "Meeting Schedule Alert Send Successfully to target Semester.");

                    }
                });

            }elseif($event == 'start'){
                //Meeting Start Alert
                $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','MeetingStart')->first();
                if(!$alert)
                    return back()->with($this->message_warning, "Alert Setting not Setup. Contact Admin For More Detail.");

                /*filter student and send alert*/
                $filteredStudent  = $students->filter(function ($student, $key) use ($alert,$semester,$course,$topic,$time){
                    if(!$alert) {

                    }else{
                        //Dear {{first_name}}, {{semester}}/{{subject}}/{{topic}} Meeting Started, Please Connect to Attend Class. Thank you
                        $subject = $alert->subject;
                        $message = $alert->template;
                        $message = str_replace('{{first_name}}', $student->first_name, $message);
                        $message = str_replace('{{semester}}', $semester, $message);
                        $message = str_replace('{{subject}}', $course, $message);
                        $message = str_replace('{{topic}}', $topic, $message);
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

                        return back()->with($this->message_success, "Meeting Start Alert Send Successfully to target Semester.");

                    }
                });
            }else{

            }
        }

        return back();
    }
}