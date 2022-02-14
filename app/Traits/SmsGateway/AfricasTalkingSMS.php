<?php
namespace App\Traits\SmsGateway;

use AfricasTalking\SDK\AfricasTalking;

trait AfricasTalkingSMS{

    /*Sparrow SMS*/
    public function africastalkingSMS($contactNumbers, $message)
    {

        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['africastalking'],true);
        $Api    = $sms['API_KEY'];
        $UserName    = $sms['UserName'];

        $AT       = new AfricasTalking($UserName, $Api);

        // Get one of the services
        $sms      = $AT->sms();

        // Use the service
        $result   = $sms->send([
            'to'      => $contactNumbers,
            'message' => $message
        ]);

    }

}