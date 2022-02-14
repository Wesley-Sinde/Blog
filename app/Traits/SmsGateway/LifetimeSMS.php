<?php
namespace App\Traits\SmsGateway;

trait LifetimeSMS{

    /*Sparrow SMS*/
    public function LifeTimeSMS($contactNumbers, $message)
    {
        /*get Setting*/
        /*$smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['LifetimeSMS'],true);
        $username    = $sms['UserName'];
        $password    = $sms['Password'];
        $from    = $sms['From'];
        //array to string comma separated number
        //$contactNumbers = implode(",",$contactNumbers);

        //http://Lifetimesms.com/plain?username= xxxx&password= xxxx &to =44xxxxxxx&from =Brand &message =this+is+plain+api.

        $api_url = "http://Lifetimesms.com/plain?username=".$username.'&password='.$password.'&from='.$from.'&to='.$contactNumbers.'&message='.$message;
        file_get_contents($api_url);
*/

        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['LifetimeSMS'],true);

        $api_token = $sms['ApiToken'];
        $api_secret = $sms['ApiSecret'];
        $from = $sms['From'];;
        $message = $message;
        $to = $contactNumbers;

        $url = "https://lifetimesms.com/plain";

        $parameters = [
            "api_token" => $api_token,
            "api_secret" => $api_secret,
            "to" => $to,
            "from" => $from,
            "message" => $message,
        ];

        $ch = curl_init();
        $timeout  =  30;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $response = curl_exec($ch);
        curl_close($ch);

        //echo $response ;
    }

}