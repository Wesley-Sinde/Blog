<?php
namespace App\Traits\SmsGateway;

use CallFire\Api\Request;
use CallFire\Api\Response;

trait CallFireSMS{

    /*Twilio SMS*/


    public function callFireSMS($contactNumbers, $message)
    {

        /*get Setting*/
        $smsSetting     = $this->getSmsSetting();
        $sms            = json_decode($smsSetting['Clickatell'],true);
        $ApiKey         = $sms['ApiKey'];


        require_once base_path() .'\vendor\callfire\php-sdk\vendor\autoload.php';

        //require 'vendor/autoload.php';


        $client = CallFire\Api\Client::Rest("<api-login>", "<api-password>", "Text");

        $request = new Request\CreateBroadcast;
        $request->setName('My CallFire Broadcast');
        $request->setType('TEXT');
        $request->setFrom('67076'); // CallFire shared short code
        $request->setMessage('Hello World!');

        $response = $client->CreateBroadcast($request);
        $result = $client::response($response);
        if($result instanceof Response\ResourceReference) {
            // Success
        }

    }

}