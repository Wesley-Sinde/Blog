<?php
namespace App\Traits\SmsGateway;

trait AakashNepalSMS{


    public function aakashSMS($contactNumbers, $message)
    {
        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['AakashNepal'],true);
        $AuthToken    = $sms['AuthToken'];

        $message = str_replace(' ','%20',$message);

        $url =  'https://aakashsms.com/admin/public/sms/v3/send?auth_token='.$AuthToken.'&to='.$contactNumbers.'&text='.$message;

        $response = file_get_contents($url);
    }


}