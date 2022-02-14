<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\UserStaff;

use App\Http\Controllers\CollegeBaseController;
use App\Models\AlertSetting;
use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\AttendanceStatus;
use App\Models\BookCategory;
use App\Models\BookMaster;
use App\Models\BookRequest;
use App\Models\BookStatus;
use App\Models\Document;
use App\Models\Download;
use App\Models\Faculty;
use App\Models\LibraryMember;
use App\Models\Month;
use App\Models\Note;
use App\Models\Notice;
use App\Models\ResidentHistory;
use App\Models\Semester;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Subject;
use App\Models\TransportHistory;
use App\Models\Year;
use App\Traits\AcademicScope;
use App\Traits\LibraryScope;
use App\Traits\SmsEmailScope;
use App\Traits\StudentScopes;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ViewHelper, URL;

class HomeController extends CollegeBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $base_route = 'dashboard';
    protected $view_path = 'user-staff';
    protected $panel = 'Dashboard';
    protected $filter_query = [];

    use StudentScopes;
    use AcademicScope;
    use SmsEmailScope;
    use LibraryScope;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->hook_id;
        $userRoleId = auth()->user()->roles()->first()->id;
        $data = [];
        $data['staff'] = Staff::select('id','reg_no', 'join_date', 'first_name',  'middle_name', 'last_name',
            'father_name', 'mother_name', 'date_of_birth', 'gender', 'blood_group', 'nationality','mother_tongue', 'address', 'state', 'country',
            'temp_address', 'temp_state', 'temp_country', 'home_phone', 'mobile_1', 'mobile_2', 'email', 'qualification',
            'experience', 'experience_info', 'other_info','staff_image', 'status')
            ->where('id','=',$id)
            ->first();

        if (!$data['staff']){
            request()->session()->flash($this->message_warning, "Not a Valid Staff");
            return redirect()->route($this->base_route);
        }

        $data['note'] = Note::select('created_at', 'id', 'member_type','member_id','subject', 'note', 'status')
            ->where('member_type','=','staff')
            ->where('member_id','=', $data['staff']->id)
            ->orderBy('created_at','desc')
            ->get();

        $data['document'] = Document::select('id', 'member_type','member_id', 'title', 'file','description', 'status')
            ->where('member_type','=','staff')
            ->where('member_id','=',$data['staff']->id)
            ->orderBy('created_by','desc')
            ->get();

        /*Notice*/
        $now = date('Y-m-d');
        $data['notice_disaplay'] = Notice::select('last_updated_by', 'title', 'message',  'publish_date', 'end_date',
            'display_group', 'status')
            ->where('display_group','like','%'.$userRoleId.'%')
            ->where('publish_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->latest()
            ->get();

        $data['staff_login'] = User::where([['role_id',5],['hook_id',$id]])->first();

        return view(parent::loadDataToView($this->view_path.'.dashboard.index'), compact('data'));
    }

    public function password(Request $request, $id)
    {
        if (!$row = User::find($id)) return parent::invalidRequest();

        if ($request->get('password') === $request->get('confirmPassword')){
            $new_password= bcrypt($request->get('password'));
        }else{
            $request->session()->flash($this->message_warning, 'Password & Confirm Password Not Match.');
            return redirect()->back();
        }

        $request->request->add(['password' => isset($new_password)?$new_password:$row->password]);

        $row->update($request->all());

        $request->session()->flash($this->message_success, 'Login Detail Updated Successfully.');
        return redirect()->back();
    }

    public function payroll()
    {
        $this->panel = 'Payroll | Staff User';
        $id = auth()->user()->hook_id;
        $data = [];
        $data['staff'] = Staff::select('id','reg_no', 'join_date', 'first_name',  'middle_name', 'last_name',
            'father_name', 'mother_name', 'date_of_birth', 'gender', 'blood_group', 'nationality','mother_tongue', 'address', 'state', 'country',
            'temp_address', 'temp_state', 'temp_country', 'home_phone', 'mobile_1', 'mobile_2', 'email', 'qualification',
            'experience', 'experience_info', 'other_info','staff_image', 'status')
            ->where('id','=',$id)
            ->first();

        if (!$data['staff']){
            request()->session()->flash($this->message_warning, "Not a Valid Staff");
            return redirect()->route($this->base_route);
        }

        $data['payroll_master'] = $data['staff']->payrollMaster()->orderBy('due_date','desc')->get();
        $data['pay_salary'] = $data['staff']->paySalary()->get();

        return view(parent::loadDataToView($this->view_path.'.payroll.index'), compact('data'));
    }

    public function library()
    {
        $this->panel = "Library";
        $id = auth()->user()->hook_id;
        $data['lib_member'] = LibraryMember::where(['library_members.user_type' => 2, 'library_members.member_id' => $id])
            ->first();

        if($data['lib_member'] != null){
            $data['circulation'] = $data['lib_member']->libCirculation()->first();

            $data['books_taken'] = $data['lib_member']->libBookIssue()->select('book_issues.id', 'book_issues.member_id',
                'book_issues.book_id',  'book_issues.issued_on', 'book_issues.due_date', 'b.book_masters_id',
                'b.book_code', 'bm.title','bm.categories','bm.image')
                ->where('book_issues.status',1)
                ->join('books as b','b.id','=','book_issues.book_id')
                ->join('book_masters as bm','bm.id','=','b.book_masters_id')
                ->orderBy('book_issues.issued_on', 'desc')
                ->get();

            $data['books_history'] = $data['lib_member']->libBookIssue()->select('book_issues.id', 'book_issues.member_id',
                'book_issues.book_id',  'book_issues.issued_on', 'book_issues.due_date','book_issues.return_date', 'b.book_masters_id',
                'b.book_code', 'bm.title','bm.categories','bm.image')
                ->join('books as b','b.id','=','book_issues.book_id')
                ->join('book_masters as bm','bm.id','=','b.book_masters_id')
                ->orderBy('book_issues.issued_on', 'desc')
                ->get();
        }

        return view(parent::loadDataToView($this->view_path.'.library.index'), compact('data'));
    }

    public function bookList(Request $request)
    {
        $this->panel = "Library - Book";
        $id = auth()->user()->hook_id;
        $data = [];
        $data['books'] = BookMaster::select('id','code', 'title', 'image', 'categories', 'author', 'publisher', 'status')
            ->where(function ($query) use ($request) {

                if ($request->has('isbn_number')) {
                    $query->where('isbn_number', 'like', '%'.$request->isbn_number.'%');
                    $this->filter_query['isbn_number'] = $request->isbn_number;
                }

                if ($request->has('code')) {
                    $query->where('code', 'like', '%'.$request->code.'%');
                    $this->filter_query['code'] = $request->code;
                }

                if ($request->has('categories')) {
                    $query->where('categories', 'like', '%'.$request->categories.'%');
                    $this->filter_query['categories'] = $request->categories;
                }

                if ($request->has('title')) {
                    $query->where('title', 'like', '%'.$request->title.'%');
                    $this->filter_query['title'] = $request->title;
                }

                if ($request->has('author')) {
                    $query->where('author', 'like', '%'.$request->author.'%');
                    $this->filter_query['author'] = $request->author;
                }

                if ($request->has('language')) {
                    $query->where('language', 'like', '%'.$request->language.'%');
                    $this->filter_query['language'] = $request->language;
                }

                if ($request->has('publisher')) {
                    $query->where('publisher', 'like', '%'.$request->publisher.'%');
                    $this->filter_query['publisher'] = $request->publisher;
                }

                if ($request->has('publish_year')) {
                    $query->where('publish_year', 'like', '%'.$request->publish_year.'%');
                    $this->filter_query['publish_year'] = $request->publish_year;
                }

                if ($request->has('edition')) {
                    $query->where('edition', 'like', '%'.$request->edition.'%');
                    $this->filter_query['edition'] = $request->edition;
                }

                if ($request->has('edition_year')) {
                    $query->where('edition_year', 'like', '%'.$request->edition_year.'%');
                    $this->filter_query['edition_year'] = $request->edition_year;
                }

                if ($request->has('series')) {
                    $query->where('series', 'like', '%'.$request->series.'%');
                    $this->filter_query['series'] = $request->series;
                }

                if ($request->has('rack_location')) {
                    $query->where('rack_location', 'like', '%'.$request->rack_location.'%');
                    $this->filter_query['rack_location'] = $request->rack_location;
                }
            })
            ->orderBy('title','asc')
            ->get();

        $data['categories'] = $this->activeBookCategories();

        $data['lib_member'] = LibraryMember::where(['library_members.user_type' => 2, 'library_members.member_id' => $id])
            ->first();

        if($data['lib_member']){
            $data['book_request'] = BookMaster::select('book_masters.id','book_masters.code', 'book_masters.title', 'book_masters.image',
                'book_masters.categories', 'book_masters.author', 'book_masters.publisher',
                'br.created_at as requested_date')
                ->where('br.member_id',$data['lib_member']->id)
                ->orderBy('book_masters.title','asc')
                ->join('book_requests as br','br.book_masters_id','=','book_masters.id')
                ->get();

            $data['book_request_ids'] = $data['book_request']->pluck('id')->toArray();
        }else{
            $request->session()->flash($this->message_warning, 'You are not a valid member of Library. Please, contact Library Department for Membership.');
        }

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.library.book-list.index'), compact('data'));
    }

    public function requestBook(Request $request, $bookId)
    {
        $this->panel = "Library- Book Request";
        $id = auth()->user()->hook_id;
        $bookId = decrypt($bookId);
        $data['lib_member'] = LibraryMember::where(['library_members.user_type' => 2, 'library_members.member_id' => $id])
            ->first();

        if($data['lib_member'] != null){
            $memberId = $data['lib_member']->id;

            $data['circulation'] = $data['lib_member']->libCirculation()->first();
            $issueLimitBooks = $data['circulation']->issue_limit_books;

            $data['books_taken'] = $data['lib_member']->libBookIssue()->select('book_issues.id', 'book_issues.member_id',
                'book_issues.book_id',  'book_issues.issued_on', 'book_issues.due_date', 'b.book_masters_id',
                'b.book_code', 'bm.title','bm.categories','bm.image')
                ->where('book_issues.status',1)
                ->join('books as b','b.id','=','book_issues.book_id')
                ->join('book_masters as bm','bm.id','=','b.book_masters_id')
                ->orderBy('book_issues.issued_on', 'desc')
                ->get();

            $currentlyTakenBooks = $data['books_taken']->count();
            $eligibleBookTaken = $issueLimitBooks - $currentlyTakenBooks;

            $bookRequestedBooks = BookRequest::where('member_id',$memberId)->count();

            $eligibleReqestBook = $issueLimitBooks - $bookRequestedBooks;

            if($eligibleReqestBook > 0  ){
                $bookRequested = BookRequest::where('member_id',$memberId)->where('book_masters_id',$bookId)->count();
                if($bookRequested > 0){
                    $request->session()->flash($this->message_warning, 'This book is Already Requested by You. Please, Request another book.');
                }else{
                    BookRequest::create([
                        'book_masters_id' => $bookId,
                        'member_id' => $memberId,
                        'created_by' => auth()->user()->id,
                    ]);

                    $request->session()->flash($this->message_success, 'Book Successfully Requested. Contact library department to take your requested books.');
                }

            }else{
                $request->session()->flash($this->message_warning, 'You were requested maximum books. You will not able to requesting more books now. ');
            }
        }else{
            $request->session()->flash($this->message_warning, 'You are not a valid member of Library. Please, contact Library Department for Membership.');
        }
        return back();
    }

    public function hostel()
    {
        $this->panel = 'Hostel | Staff User';
        $id = auth()->user()->hook_id;
        $data = [];

        $data['history'] = ResidentHistory::select('resident_histories.years_id', 'resident_histories.hostels_id',
            'resident_histories.rooms_id', 'resident_histories.beds_id',
            'resident_histories.history_type','resident_histories.created_at')
            ->where(['r.user_type' => 2, 'r.member_id' => $id])
            ->join('residents as r', 'r.id', '=', 'resident_histories.residents_id')
            ->join('beds as b', 'b.id', '=', 'resident_histories.beds_id')
            ->orderBy('resident_histories.created_at')
            ->get();

        return view(parent::loadDataToView($this->view_path.'.hostel.index'), compact('data'));
    }

    public function transport()
    {
        $this->panel = 'Transport | Staff User';
        $id = auth()->user()->hook_id;
        $reg_no = $this->getStaffById($id);
        $data = [];

        /*Transport History*/
        $data['transport_history'] = TransportHistory::select('transport_histories.id', 'transport_histories.years_id',
            'transport_histories.routes_id', 'transport_histories.vehicles_id',  'transport_histories.history_type',
            'transport_histories.created_at','tu.member_id','tu.user_type')
            ->where(['tu.user_type' => 2, 'tu.member_id' => $id])
            ->join('transport_users as tu','tu.id','=','transport_histories.travellers_id')
            ->latest()
            ->get();

        return view(parent::loadDataToView($this->view_path.'.transport.index'), compact('data'));
    }

    public function subject()
    {
        $this->panel = 'Course | Staff User';
        $id = auth()->user()->hook_id;
        $data = [];
        $data['subject'] = Subject::where('staff_id',$id)->orderBy('title')->get();

        return view(parent::loadDataToView($this->view_path.'.subject.index'), compact('data'));
    }

    public function notice()
    {
        $this->panel = 'Notice | Staff User';
        $data = [];
        $userRoleId = auth()->user()->roles()->first()->id;
        $data['rows'] = Notice::select('id', 'title', 'message', 'publish_date', 'end_date', 'display_group','status')
            ->where('display_group','like','%'.$userRoleId.'%')
            ->latest()
            ->get();

        return view(parent::loadDataToView($this->view_path.'.notice.index'), compact('data'));
    }

    public function attendance()
    {
        $this->panel = 'Attendance | Staff User';
        $id = auth()->user()->hook_id;
        $data = [];
        $data['attendance'] = Attendance::select('attendances.id', 'attendances.attendees_type', 'attendances.link_id',
            'attendances.years_id', 'attendances.months_id', 'attendances.day_1', 'attendances.day_2', 'attendances.day_3',
            'attendances.day_4', 'attendances.day_5', 'attendances.day_6', 'attendances.day_7', 'attendances.day_8',
            'attendances.day_9', 'attendances.day_10', 'attendances.day_11', 'attendances.day_12', 'attendances.day_13',
            'attendances.day_14', 'attendances.day_15', 'attendances.day_16', 'attendances.day_17', 'attendances.day_18',
            'attendances.day_19', 'attendances.day_20', 'attendances.day_21', 'attendances.day_22', 'attendances.day_23',
            'attendances.day_24', 'attendances.day_25', 'attendances.day_26', 'attendances.day_27', 'attendances.day_28',
            'attendances.day_29', 'attendances.day_30', 'attendances.day_31', 's.id as staff_id', 's.reg_no',
            's.first_name', 's.middle_name', 's.last_name', 's.designation')
            ->where('attendances.status', 1)
            ->where('attendances.attendees_type', 2)
            ->where('attendances.link_id',$id)
            ->join('staff as s', 's.id', '=', 'attendances.link_id')
            ->orderBy('s.id','asc')
            ->orderBy('attendances.years_id','asc')
            ->orderBy('attendances.months_id','asc')
            ->get();

        return view(parent::loadDataToView($this->view_path.'.attendance.index'), compact('data'));
    }

    /*Send Attendance Alert*/
    public function attendanceConfirm($semester, $date)
    {
        $month = Carbon::createFromFormat('Y-m-d H:i:s', $date)->month;
        $day = "day_".Carbon::createFromFormat('Y-m-d H:i:s', $date)->day;
        $yearTitle = Carbon::createFromFormat('Y-m-d H:i:s', $date)->year;
        $year = Year::where('title',$yearTitle)->first()->id;


        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','AttendanceConfirmation')->first();
        if(!$alert)
            return back()->with($this->message_warning, "Alert Setting not Setup. Contact Admin For More Detail.");

        $sms = false;
        $email = false;

        $attendanceExist = Attendance::select('attendances.id','attendances.attendees_type','attendances.link_id',
            'attendances.years_id','attendances.months_id','attendances.'.$day,
            's.id as students_id','s.first_name as student_name','gd.guardian_first_name','gd.guardian_mobile_1','gd.guardian_email')
            ->where('attendances.attendees_type',1)
            ->where('attendances.years_id',$year)
            ->where('attendances.months_id',$month)
            ->where('s.semester', $semester)
            ->join('students as s','s.id','=','attendances.link_id')
            ->join('student_guardians as sg', 'sg.students_id','=','s.id')
            ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
            ->get();

        if($attendanceExist && $attendanceExist->count() > 0) {
            foreach ($attendanceExist as $attendance) {
                $subject = $alert->subject;
                $guardianName = $attendance->guardian_first_name;
                $guardianContact = $attendance->guardian_mobile_1;
                $guardianEmail = $attendance->guardian_email;
                $message = str_replace('{{first_name}}', $guardianName, $alert->template);
                $message = str_replace('{{status}}', $this->getAttendanceFullStatus($attendance->$day), $message);
                $message = str_replace('{{date}}', Carbon::parse($date)->format('M d , Y'), $message);

                /*Now Send SMS On First Mobile Number*/
                if ($alert->sms == 1 && isset($guardianContact)) {
                    $contactNumbers = array($guardianContact);
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
    }

}
