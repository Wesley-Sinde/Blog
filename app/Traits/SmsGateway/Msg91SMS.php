<?php
namespace App\Traits\SmsGateway;

use Twilio\Rest\Client;


trait Msg91SMS{

    /*Sparrow SMS*/
    public function msg91SMS($contactNumbers, $message)
    {

        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['Msg91'],true);
        $Authkey = $sms['Authkey'];
        $Sender = $sms['Sender'];
        $Route = $sms['Route'];
        $Country = $sms['Country'];
        //$contactNumbers = implode(',',$contactNumbers);
        $contactNumbers = str_replace(' ','',$contactNumbers);
        //$message = str_replace(' ','%26',$message);
        //http://api.msg91.com/api/sendhttp.php?route=4&sender=TESTIN&mobiles=&authkey=&encrypt=&message=Hello!%20This%20is%20a%20test%20message&flash=&unicode=&schtime=&afterminutes=&response=&campaign=&country=91"
        //$url = "http://sms.msg91.com/api/sendhttp.php?".'authkey='.$Authkey.'&mobiles='.$contactNumbers.'&message='.$message.'&sender='.$Sender.'&route='.$Route.'&country='.$Country;
        //$url = "http://api.msg91.com/api/sendhttp.php?"."route=".$Route."&sender=".$Sender."&mobiles=".$contactNumbers."&authkey=".$Authkey."&message=".$message."&country=".$Country;
        //$response = file_get_contents($url);

        //Prepare you post parameters
        $postData = array(
            'authkey' => $Authkey,
            'mobiles' => $contactNumbers,
            'message' => $message,
            'sender' => $Sender,
            'route' => $Route
        );

        //API URL
        $url="http://api.msg91.com/api/sendhttp.php";

        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));


    //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        //get response
        $output = curl_exec($ch);

    //Print error if any
        if(curl_errno($ch))
        {
            echo 'error:' . curl_error($ch);
        }

        curl_close($ch);
    }

}