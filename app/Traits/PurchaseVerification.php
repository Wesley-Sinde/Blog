<?php
namespace App\Traits;

use Carbon\Carbon;

trait PurchaseVerification {

    public function getPurchaseDetail()
    {

        $connected = @fsockopen("www.google.com", 80); //website, port  (try 80 or 443)
        if ($connected){

        }else{
            return true;
        }

        $date = Carbon::today()->format('d');
        if($date==1){
            $code = getenv('PURCHASE_CODE');
            $personalToken = decrypt('eyJpdiI6IjFsSUx3ZzN5cVRqSVJGdjV3QTl1VXc9PSIsInZhbHVlIjoiSGJZeUV5Smc2TkxtcFJRa3RuRFd3KzVrNDJUN3pqVjRTMVwvYzVSSmpZa0Z0c3NxWThQMUpIVCt0cnh2SUUzSk4iLCJtYWMiOiIyYTNjMTA5ZTMyMzRjZmVhMzI1MjM2YjJjZDZhMGEyNzM2M2VjZWQzOTZkNWE1NTU2ZmExNTUzN2Q1MThkYTEwIn0=');
            $userAgent = "Purchase code verification on unlimitededufirm.com";

            if(isset($code) && $code != ''){
                $code = trim($code);

                if (!preg_match("/^(\w{8})-((\w{4})-){3}(\w{12})$/", $code)) {
                    throw new Exception("Invalid code");
                }

                $ch = curl_init();
                curl_setopt_array($ch, array(
                    CURLOPT_URL => "https://api.envato.com/v3/market/author/sale?code={$code}",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 20,

                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer {$personalToken}",
                        "User-Agent: {$userAgent}"
                    )
                ));

                $response = @curl_exec($ch);

                if (curl_errno($ch) > 0) {
                    throw new Exception("Error connecting to API: " . curl_error($ch));
                }

                $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                if ($responseCode === 400) {
                    abort(401, "A parameter or argument in the request was invalid");
                }

                if ($responseCode === 401) {
                    abort(401, "The authorization header is missing or malformed. Verify that your code is correct");
                }

                if ($responseCode === 403) {
                    abort(401, "The personal token is incorrect or does not have the required permission(s)");
                }

                if ($responseCode === 404) {
                    abort(401, "The purchase code was invalid, not real");
                }

                if ($responseCode !== 200) {
                    abort(401, "Failed to validate code due to an error: HTTP {$responseCode}");
                }

                $body = @json_decode($response);
                //dd($body);


                if ($body === false && json_last_error() !== JSON_ERROR_NONE) {
                    abort(401, "Error parsing response");
                }

                $expire = Carbon::parse($body->sold_at)->addYear();
                $date = new Carbon;
                if($date > $expire)
                {
                    //its already expired
                    abort(401, "License Expired Issue ");
                }else{
                    //$body->expire = Carbon::parse($expire)->format('d-m-Y');
                    return $body;
                }
            }else{
                abort(401, "Input Correct Purchase Code on .env PURCHASE_CODE variable");
            }
        }


    }

}



