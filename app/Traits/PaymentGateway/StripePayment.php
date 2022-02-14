<?php
namespace App\Traits\PaymentGateway;

use App\Models\PaymentSetting;
use Twilio\Rest\Client;


trait StripePayment{

    /*stripe*/
    public function stripe(Request $request)
    {
        /*pull payment setting*/
        $setting = PaymentSetting::where(['identity'=> 'Stripe', 'status'=>1])->get();
        if(isset($setting) && $setting->count() > 0){
            $d = json_decode($setting,true);
            $gatewayConfig = array_pluck($d,'config','identity');
            $stripe  = json_decode($gatewayConfig['Stripe']);
        }

        if(!isset($stripe->Publishable_Key) && !isset($stripe->Secret_Key)){
            return back()->with($this->message_warning, 'Sorry, Strip Keys Not Setup. Please try again.');
        }

        $net_balance = $request->get('net_balance');
        $description = $request->get('description');
        $student_id = $request->get('student_id');
        $fee_masters_id = $request->get('fee_masters_id');
        $date = Carbon::now()->format('Y-m-d');

        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        Stripe::setApiKey($stripe['Secret_Key']);

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $request->get('stripeToken');

        $charge = \Stripe\Charge::create([
            'amount' => $net_balance*100,
            'currency' => 'usd',
            'description' => $description,
            'source' => $token,
        ]);

        dd($charge);

        if($charge) {

            $feecollect =  FeeCollection::create([
                'students_id' => $student_id,
                'fee_masters_id' => $fee_masters_id,
                'date' => $date,
                'paid_amount' => $net_balance,
                'discount' => 0,
                'fine' => 0,
                'payment_mode' => 'Stripe',
                'note' => $description,
                'created_by' => auth()->user()->id
            ]);

            if ($feecollect) {
                $request->session()->flash($this->message_success, 'Successfully Charge : ' . $net_balance);
            } else {
                $request->session()->flash($this->message_warning, 'Not Collect Yet');
            }
        }else{
            $request->session()->flash($this->message_warning, 'Sorry, something went wrong. Please try again.');
        }

        return back();

    }


    /*Sparrow SMS*/
    public function sparrowSMS($contactNumbers, $message)
    {

        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['Sparrow'],true);
        $from    = $sms['From'];
        $token    = $sms['Token'];

        //filter contact numbers
        /*The Contact Number length and filter array*/
        /*$contactNumbers =array_values((array_filter($contactNumbers, function($v){
            return strlen($v) == 10;
        })));*/
        /*Filter Duplicate Number get unique number*/
        //$contactNumbers = array_unique($contactNumbers);
        /*array to string comma separated number*/
        $contactNumbers = implode(",",$contactNumbers);


        $api_url = "http://api.sparrowsms.com/v2/sms/?".
            http_build_query(array(
                'token' => $token,
                'from'  => $from,
                'to'    => $contactNumbers,
                'text'  => $message));

        file_get_contents($api_url);
    }

}