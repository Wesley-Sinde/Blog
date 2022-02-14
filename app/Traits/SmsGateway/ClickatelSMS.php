<?php
namespace App\Traits\SmsGateway;

use Clickatell\Rest;
use Clickatell\ClickatellException;

trait ClickatelSMS{

    /*Twilio SMS*/
    public function clickatelSMS($contactNumbers, $message)
    {
        //https://api.clickatell.com/http/sendmsg?user=xxxx&password=xxxx&api_id=xxxx&to=2799900001&text=hello&unicode=1
        /*get Setting*/
        $smsSetting     = $this->getSmsSetting();
        $sms            = json_decode($smsSetting['Clickatell'],true);
        $username = urlencode($sms['User']);
        $password = urlencode($sms['Password']);
        $api_id = urlencode($sms['API_ID']);
        $unicode = urlencode($sms['Unicode']);
        $to = urlencode($contactNumbers);
        $message = urlencode($message);
        if($unicode == 1){
            $url = "https://api.clickatell.com/http/sendmsg?user=$username&password=$password&api_id=$api_id&to=$to&text=$message&unicode=1";
        }else{
            $url = "https://api.clickatell.com/http/sendmsg?user=$username&password=$password&api_id=$api_id&to=$to&text=$message";
        }

        file_get_contents($url);
    }

}