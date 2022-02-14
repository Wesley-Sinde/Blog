<?php

namespace App\Console\Commands;

use App\Jobs\AllEmail;
use App\Models\AlertSetting;
use App\Models\EmailSetting;
use App\Models\Student;
use App\Traits\SmsEmailScope;
use Illuminate\Console\Command;

class BalanceFeesReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:duefeereminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fee Reminder command is send Email & Sms alert to related student. Who have due fees amount.';

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
        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','BalanceFees')->first();
        if(!$alert)
            return false;

        $subject = $alert->subject;
        $message = $alert->template;

        $data = [];
        $students = Student::select('students.id','students.email', 'ai.mobile_1 as contact_number')
            ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
            ->get();

        /*filter due using call back*/
        $filtered  = $students->filter(function ($student) {
            $student->fee_amount = $student->feeMaster()->sum('fee_amount');
            $student->paid_amount = $student->feeCollect()->sum('paid_amount');
            $student->discount = $student->feeCollect()->sum('discount');
            $student->fine = $student->feeCollect()->sum('fine');
            $student->balance = ($student->fee_amount + $student->fine) - ($student->discount + $student->paid_amount);
            if($student->balance > 0){
                return $student;
            }
        });

        $data['student'] = $filtered;

        $emailIds = $data['student']->pluck('email')->toArray();
        $contactNumbers = $data['student']->pluck('contact_number')->toArray();

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
