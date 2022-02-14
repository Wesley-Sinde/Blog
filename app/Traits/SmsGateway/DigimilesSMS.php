<?php
namespace App\Traits\SmsGateway;

use Twilio\Rest\Client;


trait DigimilesSMS{

    /*Digi SMS*/
    public function digimilesSMS($contactNumbers, $message)
    {

        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['Digimiles'],true);
        $UserName    = $sms['UserName'];
        $Password    = $sms['Password'];
        $Type        = $sms['Type']?$sms['Type']:0;
        $Sender_ID    = $sms['Sender_ID'];

        //filter contact numbers
        /*The Contact Number length and filter array*/
        /*$contactNumbers =array_values((array_filter($contactNumbers, function($v){
            return strlen($v) == 10;
        })));*/

        /*Filter Duplicate Number get unique number*/
        $contactNumbers = array_unique($contactNumbers);
        /*array to string comma separated number*/
        $contactNumbers = implode(",",$contactNumbers);
        //dd($contactNumbers);

        $api_url = "http://sms.digimiles.in/bulksms/bulksms?".
            http_build_query(array(
                'username' => $UserName,
                'password'  => $Password,
                'type'  => $Type,
                'dlr'    => 1,
                'destination'    => $contactNumbers,
                'source'    => $Sender_ID,
                'message'  => $message));


        $response = file_get_contents($api_url);

        /*
         * Error Codes:
            1701: Success, Message Submitted successfully, in this case you will receive
            the response 1701|<CELL_NO>|<MESSAGE ID>, the message Id can Then
            be used later to map the delivery reports to this message.
            1702: Invalid URL Error, This means that one of the parameters
            was not provided or left blank
            1703: Invalid value in username or password field
            1704: Invalid value in "type" field
            1705: Invalid Message
            1706: Invalid Destination
            1707: Invalid Source (Sender)
            1708: Invalid value for "dlr" field
            1709: User validation failed
            1710: Internal Error
            1025: Insufficient Credit
            1028: Spam message content
         *
         * */
    }

}