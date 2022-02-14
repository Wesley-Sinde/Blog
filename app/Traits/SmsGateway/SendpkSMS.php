<?php
namespace App\Traits\SmsGateway;

trait SendpkSMS{

    /*Sparrow SMS*/
    public function SendPkSMS($contactNumbers, $message)
    {
        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['SendPK'],true);
        $username    = $sms['UserName'];
        $password    = $sms['Password'];
        $sender    = $sms['Sender'];
        $type    = $sms['Type'];
        /*array to string comma separated number*/
        //$contactNumbers = implode(",",$contactNumbers);

        //https://sendpk.com/api/sms.php?username=username&password=password&sender=Masking&mobile=923001234567,923101234567&message=Hello&type=unicode

        if($type == 'unicode' || $type == 'UNICODE') {
            $api_url = "https://sendpk.com/api/sms.php?username=".$username.'&password='.$password.'&sender='.$sender.'&type=unicode&mobile='.$contactNumbers.'&message='.$message;
        }else{
            $api_url = "https://sendpk.com/api/sms.php?username=".$username.'&password='.$password.'&sender='.$sender.'&mobile='.$contactNumbers.'&message='.$message;
        }

        file_get_contents($api_url);
    }

}