<?php
namespace App\Traits\SmsGateway;

use Twilio\Rest\Client;


trait TheSMSCentralSMS{

    /*Sparrow SMS*/
    public function thesmscentralSMS($contactNumbers, $message)
    {
        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['TheSMSCentral'],true);
        $ApiToken    = $sms['ApiToken'];
        $Sender    = $sms['Sender'];

        $message = str_replace(' ','%20',$message);

        $url =  'http://beta.thesmscentral.com/api/v3/sms?token='.$ApiToken.'&sender='.$Sender.'&to='.$contactNumbers.'&message='.$message;

        $response = file_get_contents($url);
    }

}