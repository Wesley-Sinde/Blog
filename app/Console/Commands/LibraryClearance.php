<?php

namespace App\Console\Commands;

use App\Jobs\AllEmail;
use App\Models\AlertSetting;
use App\Models\BookIssue;
use App\Models\EmailSetting;
use App\Traits\SmsEmailScope;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LibraryClearance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:libraryclearance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'If the Library Return Period Over. User can get clearance Message';

    use SmsEmailScope;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $emailIds = [];
        $contactNumbers = [];
        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','LibraryReturnPeriodOver')->first();
        if(!$alert)
            return false;

        $subject = $alert->subject;
        $message = $alert->template;

        /*get email id and contact number of Library Over Period Student*/
        $students = BookIssue::select('s.first_name', 's.email', 'ai.mobile_1')
            ->where('lm.user_type','=',1)
            ->where('book_issues.due_date',"<", Carbon::now())
            ->join('library_members as lm','lm.id','=','book_issues.member_id')
            ->join('students as s','s.id','=','lm.member_id')
            ->join('addressinfos as ai','ai.students_id','=','s.id')
            ->get();

        foreach($students as $student){
            $emailIds[] = $student->email;
            $contactNumbers[] = $student->mobile_1;
        }

        /*get email id and contact number of Library Over Period Staff*/
        $staffs = BookIssue::select('s.mobile_1', 's.email')
            ->where('lm.user_type','=', 2)
            ->where('book_issues.due_date',"<", Carbon::now())
            ->join('library_members as lm','lm.id','=','book_issues.member_id')
            ->join('staff as s','s.id','=','lm.member_id')
            ->get();

        foreach($staffs as $staff){
            /*chek email id is correct or not if correct add on array other wise not*/
            $filterMail = filter_var($staff->email,FILTER_VALIDATE_EMAIL);
            if($filterMail){
                $emailIds[] = $filterMail;
            }
            $contactNumbers[] = $staff->mobile_1;
        }

        if($contactNumbers != [] || $emailIds =[] ) {

            if ($alert->sms == 1) {
                /*Now Send SMS On First Mobile Number*/
                $contactNumbers = $this->contactFilter($contactNumbers);
                $smssuccess = $this->sendSMS($contactNumbers, $message);
            }

            if ($alert->email == 1) {

                /*Now Send Email With Subject*/
                $emailIds = $this->emailFilter($emailIds);
                //$emailSuccess = $this->sendEmail($emailIds, $subject, $message);
                $emailSetting = EmailSetting::first();

                if ($emailSetting == null) {
                    return false;
                }

                if ($emailSetting->status == "in-active")
                    return false;

                /*sending email*/
                $emailIds = explode(',', $emailIds);

                /*Mail Queue*/
                dispatch(new AllEmail($emailIds, $subject, $message));
            }
        }
    }
}
