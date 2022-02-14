<?php
namespace App\Traits\SmsGateway;

use Twilio\Rest\Client;


trait Msg94SMS{

    /*Sparrow SMS*/
    public function msg94SMS($contactNumbers, $message)
    {

        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['Msg94'],true);
        $Authkey = $sms['Authkey'];
        $Sender = $sms['Sender'];
        $Route = $sms['Route'];
        $Country = $sms['Country'];
        //$contactNumbers = implode(',',$contactNumbers);
        $contactNumbers = str_replace(' ','',$contactNumbers);
        //$message = str_replace(' ','%26',$message);
        //http://sms.msg94.com/api/sendhttp.php?authkey=YourAuthKey&mobiles=919999999990,919999999999&message=message&sender=ABCDEF&route=4&country=0
        $url = "http://sms.msg94.com/api/sendhttp.php?".'authkey='.$Authkey.'&mobiles='.$contactNumbers.'&message='.$message.'&sender='.$Sender.'&route='.$Route.'&country='.$Country;
        $response = file_get_contents($url);
    }

}