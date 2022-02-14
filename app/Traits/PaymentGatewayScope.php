<?php
namespace App\Traits;

use App\Mail\EmailAlerts;
use App\Models\EmailSetting;
use App\Models\PaymentSetting;
use App\Models\SmsSetting;

use App\Traits\PaymentGateway\StripePayment;
use App\Traits\SmsGateway\CallFireSMS;
use App\Traits\SmsGateway\ClickatelSMS;
use App\Traits\SmsGateway\DigimilesSMS;
use App\Traits\SmsGateway\InitiativeAaayoSMS;
use App\Traits\SmsGateway\KeswaTechSMS;
use App\Traits\SmsGateway\MessageBirdSMS;
use App\Traits\SmsGateway\Msg91SMS;
use App\Traits\SmsGateway\Msg94SMS;
use App\Traits\SmsGateway\MsgClub;
use App\Traits\SmsGateway\NexmoSMS;
use App\Traits\SmsGateway\SmartSmsSolutionSMS;
use App\Traits\SmsGateway\SmsAPI;
use App\Traits\SmsGateway\SparrowSMS;
use App\Traits\SmsGateway\TextLocalSMS;
use App\Traits\SmsGateway\TwillioSMS;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use App\Jobs\AllEmail;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;


trait PaymentGatewayScope{
    protected $message_success = 'message_success';
    protected $message_warning = 'message_warning';
    use StripePayment;

    public function payOnline(Request $request)
    {
        dd('pay online traits');
        //payOnline($gateway, $paymentDetail)
        $gateway = 0;
        $paymentDetail = 0;
        /*get Setting*/
        //dd('here');
        //$setting    = $this->getPaymentSetting();

        //$d = json_decode($data['payment_setting'],true);
        //$gatewaySetting = array_pluck($setting,'config','identity');
       // dd($gatewaySetting['Stripe']);

        /*if($setting == null)
            return back()->with($this->message_warning, "Payment Gateway Setting Not Detected. Please Setting Your Gateway Detail.");

        $activeGateway = $setting->identity;*/

        /*Switch Target SMS Service Provider*/
        switch ($gateway){
            case "Stripe":
                $this->stripe($paymentDetail);
                break;

            default:
                return back()->with($this->message_warning, "No Any Payment Gateway Provider Active. Please, Active First.");

        }

    }


    /*SMS SENDER*/
    protected function getPaymentSetting()
    {
        $data['payment_setting'] = PaymentSetting::where('status',1)->get();
        if(isset($data['payment_setting']) && $data['payment_setting']->count() > 0){
            return $d = json_decode($data['payment_setting'],true);
            //dd($d);
            /*$d = json_decode($data['payment_setting'],true);
            $manageSetting = array_pluck($d,'config','identity');
            return $manageSetting;*/
        }
    }


}