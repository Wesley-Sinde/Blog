<?php
namespace App\Traits\SmsGateway;

use Nexmo\Client;
use Nexmo\Client\Credentials\Basic;

trait NexmoSMS{

    /*Twilio SMS*/
    public function nexmoSMS($contactNumbers, $message)
    {
        /*get Setting*/
        $smsSetting     = $this->getSmsSetting();
        $sms            = json_decode($smsSetting['Nexmo'],true);
        $From       = $sms['From'];
        $API_KEY       = $sms['API_KEY'];
        $API_SECRET    = $sms['API_SECRET'];
        //$contactNumbers = implode(',',$contactNumbers);
        //dd($contactNumbers);
        dd('Nexmo');

        $basic  = new Basic($API_KEY, $API_SECRET);
        $client = new Client($basic);
        $smsResponse = [];

        foreach($contactNumbers as $number) {
            $smsResponse[] = $client->message()->send([
                'to' => $number,
                'from' => $From,
                'text' => $message
            ]);
        }

    }

}