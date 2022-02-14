<?php

use Illuminate\Database\Seeder;

class AlertSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alert_settings')->insert([
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'BirthdayWish',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Wish Your Birthday Dear',
                'template' => 'Dear {{first_name}}, Sending you smiles for every moment of your special day…Have a wonderful time and a very happy birthday!',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'StudentRegistration',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Registration Information',
                'template' => 'Dear {{first_name}}, you are successfully registered in our institution with RegNo.{{reg_no}}. Thank You.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'StudentTransfer',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Transfer Information',
                'template' => 'Dear {{first_name}}, We would like to inform you are successfully transferred to {{semester}}. Thank You.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'FeeReceive',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Fees Receive Information',
                'template' => 'Dear {{first_name}}, We would like to inform you we are successfully received {{amount}} on {{date}}. Thank you for the Deposit.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'BalanceFees',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Balance Fees Information',
                'template' => 'Dear {{first_name}}, you have {{due_amount}} balance fees. please deposit on time. For more info contact the Account Department.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'SubjectAttendance',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Student Subject Wise Attendance Information',
                'template' => 'Dear {{guardian_name}}, your child {{first_name}} was Absent in {{absent_status}} subjects attendance on {{date}}.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'StudentAttendance',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Student Attendance Information',
                'template' => 'Dear Guardian, This is to inform you that {{first_name}} is {{status}} on {{date}}.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'StaffAttendance',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Staff Attendance Information',
                'template' => 'Dear {{first_name}}, This is to inform you are {{status}} on {{date}}.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'StaffAbsentNotification',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Staff Absent Information',
                'template' => 'Dear Sir, This is to inform you following staffs are absent today. {{staffs_name}}',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'ExamScoreForGuardian',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Exam Score Information',
                'template' => 'Dear Guardian, {{first_name}} has obtained the following marks in {{exam_mark_detail}}.',
                'status' => 1
            ],

            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'ExamScoreForStudent',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Exam Score Information',
                'template' => 'Dear {{first_name}}, you have obtained following marks in {{exam_mark_detail}}.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'LibraryRegistration',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Library Registration Information',
                'template' => 'Dear {{first_name}}, Congratulation! You are successfully registered in our library.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'LibraryReturnPeriodOver',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Library Clearance Reminder',
                'template' => 'Dear {{first_name}}, We would like to inform you have some books return time period is over. So, please return as soon as possible.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'HostelRegistration',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Hostel Registration Information',
                'template' => 'Dear {{first_name}}, Congratulation! You are successfully registered in our hostel.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'HostelShift',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Hostel Shift Information',
                'template' => 'Dear {{first_name}}, Congratulation! You are successfully shifted in {{new_hostel}}.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'HostelLeave',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Hostel Leave Information',
                'template' => 'Dear {{first_name}}, You are successfully leaving from our hostel. Thank you.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'HostelActive',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Hostel Active Again Information',
                'template' => 'Dear {{first_name}}, You are successfully re-Activated for our hostel service in {{new_hostel}}.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'TransportRegistration',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Transport Service Registration Information',
                'template' => 'Dear {{first_name}}, You are successfully registered for our transport service in {{transport}}.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'TransportShift',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Transport Shift Information',
                'template' => 'Dear {{first_name}}, Congratulation! You are successfully shifted in {{transport}}.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'TransportLeave',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Transport Leave Information',
                'template' => 'Dear {{first_name}}, You are successfully deactivated for transport service. Thank you.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'TransportActive',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Transport Active Again Information',
                'template' => 'Dear {{first_name}}, You are successfully re-Activated for our transport service in {{transport}}.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'CustomerRegistration',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Customer Registration Information',
                'template' => 'Dear {name}, you are successfully registered in our CRM with RegNo.{reg_no}.',
                'status' => 1
            ],
            [
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'created_by' => 1,
                'event' => 'VendorRegistration',
                'sms' => 0,
                'email' => 0,
                'subject' =>'Vendor Registration Information',
                'template' => 'Dear {name}, you are successfully registered in our CRM with RegNo.{reg_no}.',
                'status' => 1
            ],
        ]);
    }
}
