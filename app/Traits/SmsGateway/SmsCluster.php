<?php
namespace App\Traits\SmsGateway;

trait SmsCluster{

    /*Sparrow SMS*/
    public function SmsClusterSMS($contactNumbers, $message)
    {
        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['SmsCluster'],true);
        $AUTH_KEY    = $sms['AUTH_KEY'];
        $senderId    = $sms['senderId'];
        $routeId    = $sms['routeId'];
        $smsContentType    = $sms['smsContentType'];
        /*array to string comma separated number*/
        //$contactNumbers = implode(",",$contactNumbers);
        //http://msg.smscluster.com/rest/services/sendSMS/sendGroupSms?
        // AUTH_KEY=YourAuthKey&message=message&senderId=dddddd&routeId=1&mobileNos=9999999999,9999999999&smsContentType=English
        $api_url = "http://msg.smscluster.com/rest/services/sendSMS/sendGroupSms?".'AUTH_KEY='.$AUTH_KEY.'&senderId='.$senderId.'&routeId='.$routeId. '&smsContentType='.$smsContentType.'&to='.$contactNumbers.'&message='.$message;

        file_get_contents($api_url);
    }

}