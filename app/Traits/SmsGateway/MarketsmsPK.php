<?php
namespace App\Traits\SmsGateway;

trait MarketsmsPK{

    /*Sparrow SMS*/
    public function MarketSmsPK($contactNumbers, $message)
    {
        /*get Setting*/
        $smsSetting = $this->getSmsSetting();

        $sms = json_decode($smsSetting['marketsmsPK'],true);
        $username    = $sms['UserName'];
        $password    = $sms['Password'];
        $from    = $sms['From'];
        /*array to string comma separated number*/
        //$contactNumbers = implode(",",$contactNumbers);
        //http://marketsms.pk/api.php?username=APIKEY&password=PASSWORD&to=RECEIVERNUMBER&from=SENDERID&message=YOURTEXTMESSAGE
        $api_url = "http://marketsms.pk/api.php?username=".$username.'&password='.$password.'&from='.$from.'&to='.$contactNumbers.'&message='.$message;
        file_get_contents($api_url);
    }

}