<?php

namespace App\Console\Commands;

use App\Models\AlertSetting;
use App\Models\Student;
use App\Traits\SmsEmailScope;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendSMSEmail extends Command
{

    use SmsEmailScope;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:smsemail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Send Alert on time.';

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

        //check student birthday-BirthdayWish
        $today = Carbon::now()->format('Y-m-d');

        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','BirthdayWish')->first();
        if(!$alert)
            return false;

        $subject = $alert->subject;
        $message = $alert->template;

        $students = Student::select('students.first_name', 'students.date_of_birth', 'students.email',  'ai.mobile_1')
            ->where('students.date_of_birth',"=", $today)
            ->join('addressinfos as ai','ai.students_id','=','students.id')
            ->get();

        foreach($students as $student){
            $emailIds[] = $student->email;
            $contactNumbers[] = $student->mobile_1;
        }

        //send SMS
        if($alert->sms == 1) {
            $contactNumbers = $this->contactFilter($contactNumbers);
            $smsSuccess = $this->sendSMS($contactNumbers,$message);
        }

        //send Email
        if($alert->email == 1) {
            $emailIds = $this->emailFilter($emailIds);
            $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
        }


    }
}
