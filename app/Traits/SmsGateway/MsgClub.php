<?php
namespace App\Traits\SmsGateway;
use HttpRequest;
use Zend\Http\Request;

trait MsgClub{

    /*MSG CLUB SMS*/
    public function MsgClubSMS($contactNumbers, $message)
    {
        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['MsgClub'],true);
        $authKey    = $sms['AUTH_KEY'];
        $senderId   = $sms['senderId'];
        $routeId   = $sms['routeId'];

        //filter contact numbers
        /*The Contact Number length and filter array*/
        /*$contactNumbers =array_values((array_filter($contactNumbers, function($v){
            return strlen($v) == 10;
        })));*/
        /*Filter Duplicate Number get unique number*/
        //$contactNumbers = array_unique($contactNumbers);
        /*array to string comma separated number*/
        $contactNumbers = implode(",",$contactNumbers);
        $api_url = "http://msg.msgclub.net/rest/services/sendSMS/sendGroupSms?".
            http_build_query(array(
                'AUTH_KEY'          => $authKey,
                'message'           => $message,
                'senderId'          => $senderId,
                'routeId'           => $routeId,
                'mobileNos'         => $contactNumbers,
                'smsContentType'    => 'english'
            ));

        file_get_contents($api_url);
    }
}