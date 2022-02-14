<?php

namespace App\Console\Commands;

use App\Jobs\AllEmail;
use App\Models\AlertSetting;
use App\Models\EmailSetting;
use App\Models\Staff;
use App\Models\Student;
use App\Traits\SmsEmailScope;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BirthdayWish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:birthdaywish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Birthday Wish to all the Student and Staff. If the Birthday is Today.';

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
        $today = Carbon::today()->format('Y-m-d');

        $emailIds = [];
        $contactNumbers = [];
        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','BirthdayWish')->first();
        if(!$alert)
            return false;

        /*get email id and contact number all active Students*/
        $students = Student::select('students.first_name','students.email', 'a.mobile_1 as contact_number')
            ->where('students.date_of_birth','=',$today)
            ->join('addressinfos as a','a.students_id','=','students.id')
            ->get();

        /*filter student with schedule subject markledger*/
        $filteredStudent  = $students->filter(function ($student, $key) use ($alert, $emailIds, $contactNumbers){
            //Dear {{first_name}}, Sending you smiles for every moment of your special day…Have a wonderful time and a very happy birthday!
            $subject = $alert->subject;
            $message = $alert->template;
            $message = str_replace('{{first_name}}', $student->first_name, $message );
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
                /*sending email*/
                $emailIds = explode(',',$emailIds);
                dispatch(new AllEmail($emailIds, $subject, $message))->delay(Carbon::now()->addSeconds(10));
            }

        });


        /*get email id and contact number all active Staffs*/
        $staffs = Staff::select('first_name','email', 'mobile_1')
            ->where('date_of_birth','=',$today)
            ->get();

        /*filter student with schedule subject markledger*/
        $filteredStaff  = $staffs->filter(function ($staff, $key) use ($alert, $emailIds, $contactNumbers){
            //Dear {{first_name}}, Sending you smiles for every moment of your special day…Have a wonderful time and a very happy birthday!
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
                $emailIds = explode(',',$emailIds);
                dispatch(new AllEmail($emailIds, $subject, $message))->delay(Carbon::now()->addSeconds(10));
            }

        });
    }
}
