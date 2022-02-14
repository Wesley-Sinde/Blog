<?php
namespace App\Traits\SmsGateway;

use SMSApi\Client;
use SMSApi\Api\SmsFactory;
use SMSApi\Exception\SmsapiException;


trait SmsAPI{

    /*SMS API - UK*/
    public function smsAPI($contactNumber, $message)
    {
        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['smsAPI'],true);
        $UserName    = $sms['UserName'];
        $Password  = md5($sms['Password']);
        $TokenName  = $sms['TokenName'];
        $Token  = $sms['Token'];

        $contactNumbers = $contactNumber;
        $message =$message;


        require_once base_path() .'\vendor\smsapi.com\php-client\smsapi\Autoload.php';

        $client = new Client($UserName);
        $client->setPasswordHash($Password);

        $smsapi = new SmsFactory;
        $smsapi->setClient($client);


        try {
            $actionSend = $smsapi->actionSend();

            $actionSend->setTo($contactNumbers);
            $actionSend->setText($message);
            $actionSend->setSender($TokenName);

            $smsResponse = $actionSend->execute();

            foreach ($smsResponse->getList() as $status) {
                echo $status->getNumber() . ' ' . $status->getPoints() . ' ' . $status->getStatus();
            }
        } catch (SmsapiException $exception) {
            echo 'ERROR: ' . $exception->getMessage();
        }

    }

}