<?php
namespace App\Traits\SmsGateway;

use Twilio\Rest\Client;


trait TwillioSMS{

    /*Twilio SMS*/
    public function twilioSMS($contactNumbers, $message)
    {
        // Update the path below to your autoload.php,
        // see https://getcomposer.org/doc/01-basic-usage.md
        require_once base_path() .'\vendor\twilio\sdk\Twilio\autoload.php';

        // Your Account Sid and Auth Token from twilio.com/console

        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['Twilio'],true);
        $sid    = $sms['SID'];
        $token  = $sms['Token'];
        $from  = $sms['FromNumber'];
        $contactNumbers = $contactNumbers;
        $message = $message;

        $twilio = new Client($sid, $token);

        foreach($contactNumbers as $contact) {

            $message = $twilio->messages
                ->create($contact,
                    array(
                        "body" => $message,
                        "from" => $from
                    )
                );
        }

    }

}