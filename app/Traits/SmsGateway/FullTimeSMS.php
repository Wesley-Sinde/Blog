<?php
namespace App\Traits\SmsGateway;

use Twilio\Rest\Client;


trait FullTimeSMS{

    /*Sparrow SMS*/
    public function fullTimeBulkSms($contactNumbers, $message)
    {

        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['FullTimeBulk'],true);
        $api_token = $sms['ApiToken'];
        $api_secret = $sms['ApiSecret'];
        $from = $sms['From'];;
        $message = $message;
        $to = $contactNumbers;
        //$to = $contactNumbers = implode(",",$contactNumbers);
        $url = "http://www.sms.fulltimesms.com/plain?api_token=".urlencode($api_token)."&api_secret=".urlencode($api_secret)."&to=".$to."&from=".urlencode($from)."&message=".urlencode($message)."";

        $ch  =  curl_init();
        $timeout  =  30;
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $response = curl_exec($ch);
        curl_close($ch);
        //echo $response;
    }

}