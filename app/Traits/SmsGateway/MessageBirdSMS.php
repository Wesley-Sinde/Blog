<?php
namespace App\Traits\SmsGateway;

use Twilio\Rest\Client;


trait MessageBirdSMS{

    /*Message Bird SMS*/
    public function messageBird($contactNumbers, $messagetext)
    {
        //get Setting
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['MessageBird'],true);
        $AcccessKey    = $sms['AcccessKey'];
        $originator    = $sms['Originator'];

        $MessageBird = new \MessageBird\Client($AcccessKey);
        $Message = new \MessageBird\Objects\Message();
        $Message->originator = $originator;
        $Message->recipients = explode(',',$contactNumbers);
        $Message->body = $messagetext;
        $response = $MessageBird->messages->create($Message);

        // Old
        // Update the path below to your autoload.php,
        // see https://getcomposer.org/doc/01-basic-usage.md
       /*require_once base_path() .'\vendor\messagebird\php-rest-api\autoload.php';
        // Your Account Sid and Auth Token from twilio.com/console



        $MessageBird = new \MessageBird\Client($AcccessKey); // Set your own API access key here.
        //$Balance = $MessageBird->balance->read();
        $Message             = new \MessageBird\Objects\Message();
        $Message->originator = $originator;
        $Message->recipients = ;
        $Message->body       = $message;

        $smsResponse = $MessageBird->messages->create($Message);

        try {
            $smsResponse = $MessageBird->messages->create($Message);
            var_dump($smsResponse);
        } catch (\MessageBird\Exceptions\AuthenticateException $e) {
            // That means that your accessKey is unknown
            echo 'wrong login';
        } catch (\MessageBird\Exceptions\BalanceException $e) {
            // That means that you are out of credits, so do something about it.
            echo  'no balance';
        } catch (\Exception $e) {
            echo $e->getMessage();
        }*/

    }

}