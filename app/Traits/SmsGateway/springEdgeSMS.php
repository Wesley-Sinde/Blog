<?php
namespace App\Traits\SmsGateway;

use Twilio\Rest\Client;


trait springEdgeSMS{

    /*Sparrow SMS*/
    public function SpringEdge($contactNumbers, $message)
    {
        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['springEdge'],true);
        $apikey = $sms['API_KEY'];
        $sender = $sms['SenderID'];
        //$contactNumbers = implode(',',$contactNumbers);
        $contactNumbers = str_replace(' ','',$contactNumbers);

        //https://instantalerts.co/api/web/send?apikey=6925gb1sdem70j5u657o201129r41829h&sender=SEDEMO&to=919632xxxxxx&message=Hi%2C+this+is+a+test+message
        $url = "https://instantalerts.co/api/web/send?apikey=".$apikey.'&sender='.$sender.'&to='.$contactNumbers.'&message='.$message;
        $response = file_get_contents($url);
    }

}