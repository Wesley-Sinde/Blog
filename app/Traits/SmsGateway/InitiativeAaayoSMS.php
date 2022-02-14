<?php
namespace App\Traits\SmsGateway;

use Twilio\Rest\Client;


trait InitiativeAaayoSMS{

    /*Sparrow SMS*/
    public function aayoSMS($contactNumbers, $message)
    {

        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['InitiativeNepal'],true);
        $userName = $sms['UserName'];
        $password = $sms['Password'];
        $sender = $sms['Sender'];

        $message = str_replace(' ','%20',$message);
       // $contactNumbers = implode(",",$contactNumbers);

        $url = "http://api.ininepal.com/api/index?".'username='.$userName.'&password='.$password.'&message='.$message.'&destination='.$contactNumbers.'&sender='.$sender;
        $response = file_get_contents($url);
    }

}