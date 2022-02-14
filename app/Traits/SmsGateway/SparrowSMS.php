<?php
namespace App\Traits\SmsGateway;

use Twilio\Rest\Client;


trait SparrowSMS{

    /*Sparrow SMS*/
    public function sparrowSMS($contactNumbers, $message)
    {

        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['Sparrow'],true);
        $from    = $sms['From'];
        $token    = $sms['Token'];

        //filter contact numbers
        /*The Contact Number length and filter array*/
        /*$contactNumbers =array_values((array_filter($contactNumbers, function($v){
            return strlen($v) == 10;
        })));*/
        /*Filter Duplicate Number get unique number*/
        //$contactNumbers = array_unique($contactNumbers);
        /*array to string comma separated number*/
        $contactNumbers = implode(",",$contactNumbers);


        $api_url = "http://api.sparrowsms.com/v2/sms/?".
            http_build_query(array(
                'token' => $token,
                'from'  => $from,
                'to'    => $contactNumbers,
                'text'  => $message));

        file_get_contents($api_url);
    }

}