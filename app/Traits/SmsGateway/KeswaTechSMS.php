<?php
namespace App\Traits\SmsGateway;

use Twilio\Rest\Client;


trait KeswaTechSMS{

    /*Sparrow SMS*/
    public function keswaSMS($contactNumbers, $message)
    {

        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['KeswaTech'],true);
        $sender = $sms['Sender'];
        $api_key = $sms['apiKey'];
        $message = urlencode(urldecode($message));
        $to = str_replace(' ','',$contactNumbers);
        
       
       $url = 'http://sms.keswatech.com/api/v4/?api_key='.$api_key.'&method=sms&unicode=AUTO&message='.$message.'&to='.$to.'&sender='.$sender.'&output=xml';
       
             
       $response = file_get_contents($url);

    }

}