<?php
namespace App\Traits\SmsGateway;

use Twilio\Rest\Client;


trait SmartSmsSolutionSMS{

    /*Sparrow SMS*/
    public function SmartSolutionSMS($contactNumbers, $message)
    {

        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['SmartSMS'],true);
        $token = $sms['ACCESS_TOKEN'];
        $sender = $sms['Sender'];
        $routing = $sms['Routing'];
        $type = $sms['Type'];
        //$contactNumbers = implode(',',$contactNumbers);
        $contactNumbers = str_replace(' ','',$contactNumbers);

        //$message = str_replace(' ','%20',$message);

        //$url = "http://bhashsms.com/api/sendmsg.php?".'user='.$userName.'&pass='.$password.'&sender='.$sender.'&phone='.$contactNumbers.'&text='.$message."&priority=ndnd&stype=normal";
        //$response = file_get_contents($url);

        $message = urlencode($message);
        $sender = urlencode($sender);
        $to = $contactNumbers;
        //$token = 'ACCESS_TOKEN';
        //$routing = 2; //basic route = 2
        //$type = 0;
        $baseurl = 'https://smartsmssolutions.com/api/json.php?';
        $sendsms = $baseurl.'message='.$message.'&to='.$to.'&sender='.$sender.'&type='.$type.'&routing='.$routing.'&token='.$token;

        $response = file_get_contents($sendsms);


    }

}