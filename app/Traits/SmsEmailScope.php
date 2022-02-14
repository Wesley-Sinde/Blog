<?php
namespace App\Traits;

use App\Mail\EmailAlerts;
use App\Models\EmailSetting;
use App\Models\SmsSetting;

use App\Traits\SmsGateway\AakashNepalSMS;
use App\Traits\SmsGateway\AfricasTalkingSMS;
use App\Traits\SmsGateway\BudgetSmsNet;
use App\Traits\SmsGateway\CallFireSMS;
use App\Traits\SmsGateway\ClickatelSMS;
use App\Traits\SmsGateway\DigimilesSMS;
use App\Traits\SmsGateway\FullTimeSMS;
use App\Traits\SmsGateway\InitiativeAaayoSMS;
use App\Traits\SmsGateway\KeswaTechSMS;
use App\Traits\SmsGateway\LifetimeSMS;
use App\Traits\SmsGateway\MarketsmsPK;
use App\Traits\SmsGateway\MessageBirdSMS;
use App\Traits\SmsGateway\Msg91SMS;
use App\Traits\SmsGateway\Msg94SMS;
use App\Traits\SmsGateway\MsgClub;
use App\Traits\SmsGateway\NexmoSMS;
use App\Traits\SmsGateway\SendpkSMS;
use App\Traits\SmsGateway\SmartSmsSolutionSMS;
use App\Traits\SmsGateway\SmsAPI;
use App\Traits\SmsGateway\SmsCluster;
use App\Traits\SmsGateway\SparrowSMS;
use App\Traits\SmsGateway\springEdgeSMS;
use App\Traits\SmsGateway\TextLocalSMS;
use App\Traits\SmsGateway\TheSMSCentralSMS;
use App\Traits\SmsGateway\TwillioSMS;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use App\Jobs\AllEmail;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;


trait SmsEmailScope{
    protected $message_success = 'message_success';
    protected $message_warning = 'message_warning';
    use SparrowSMS;
    use InitiativeAaayoSMS;
    use Msg91SMS;
    use Msg94SMS;
    use KeswaTechSMS;
    use TwillioSMS;
    use SmsAPI;
    use MessageBirdSMS;
    use ClickatelSMS;
    use NexmoSMS;
    use CallFireSMS;
    use MsgClub;
    use DigimilesSMS;
    use TextLocalSMS;
    use SmartSmsSolutionSMS;
    use SendpkSMS;
    use LifetimeSMS;
    use SmsCluster;
    use MarketsmsPK;
    use BudgetSmsNet;
    use springEdgeSMS;
    use AfricasTalkingSMS;
    use TheSMSCentralSMS;
    use AakashNepalSMS;
    use FullTimeSMS;

    /*SMS SENDER*/
    public function sendSMS($contactNumbers, $message)
    {
        if($contactNumbers == "")
            return back()->with($this->message_warning, "No Any Contact Found. So Message Not Send In This Time. Please Try Again.");

        /*get Setting*/
        $smsSetting     = SmsSetting::where('status',1)->first();

        if($smsSetting == null)
            return back()->with($this->message_warning, "SMS Setting Not Detected. Please Setting Your SMS Detail.");

        $activeProvider = $smsSetting->identity;

        /*Switch Target SMS Service Provider*/
        switch ($activeProvider){
            case "Sparrow":
                $this->sparrowSMS($contactNumbers, $message);
                break;

            case "InitiativeNepal":
                $this->aayoSMS($contactNumbers, $message);
                break;

            case "Msg91":
                $this->msg91SMS($contactNumbers, $message);
                break;

            case "Msg94":
                $this->msg94SMS($contactNumbers, $message);
                break;

            case "KeswaTech":
                $this->keswaSMS($contactNumbers, $message);
                break;

            case "Twilio":
                $this->twilioSMS($contactNumbers, $message);
                break;

            case "MessageBird":
                $this->messageBird($contactNumbers, $message);
                break;

            case "smsAPI":
                $this->smsAPI($contactNumbers, $message);
                break;

            case "Clickatell":
                $this->clickatelSMS($contactNumbers, $message);
                break;

            case "BudgetSmsNet":
                $this->BudgetSMS($contactNumbers, $message);
                break;

            case "Nexmo":
                $this->nexmoSMS($contactNumbers, $message);
                break;

            //todo::
            case "CallFire":
                $this->callFireSMS($contactNumbers, $message);
                break;

            case "MsgClub":
                $this->MsgClubSMS($contactNumbers, $message);
                break;

            case "Digimiles":
                $this->digimilesSMS($contactNumbers, $message);
                break;

            case "Textlocal":
                $this->textLocalSMS($contactNumbers, $message);
                break;

            case "Textlocal":
                $this->SmartSolutionSMS($contactNumbers, $message);
                break;

            case "SendPK":
                $this->SendPkSMS($contactNumbers, $message);
                break;

            case "LifetimeSMS":
                $this->LifeTimeSMS($contactNumbers, $message);
                break;

            case "SmsCluster":
                $this->SmsClusterSMS($contactNumbers, $message);
                break;

            case "marketsmsPK":
                $this->MarketSmsPK($contactNumbers, $message);
                break;

            case "springEdge":
                $this->SpringEdge($contactNumbers, $message);
                break;

            case "africastalking":
                $this->africastalkingSMS($contactNumbers, $message);
                break;

            case "TheSMSCentral":
                $this->thesmscentralSMS($contactNumbers, $message);
                break;

            case "AakashNepal":
                $this->aakashSMS($contactNumbers, $message);
                break;

            case "FullTimeBulk":
                $this->fullTimeBulkSms($contactNumbers, $message);
                break;

            default:
                return back()->with($this->message_warning, "No Any SMS Service Provider Active. Please, Active First.");

        }

    }


    /*EMAIL SENDING*/
    public function sendEmail($emailIds, $subject, $message){
        /*check internet connection for email sending*/
        $connection = Parent::checkConnection();
        if(!$connection)
            return back()->with($this->message_warning, $this->internet_status);

        $emailSetting = EmailSetting::first();

        if($emailSetting == null){
            return back()->with($this->message_warning, "Email Setting Not Detected. Please Setting Your Out Going Email Detail.");
        }

        if($emailSetting->status == "in-active")
            return back()->with($this->message_warning, "Email Setting Not Active. Please Active First.");

        /*sending email*/
        $emailIds = explode(',',$emailIds);


        /*Mail::to(['nepalcomputercare@gmail.com'])->send(new EmailAlerts([
            'subject' => 'test',
            'message' => 'sadfsadfsdfsdaf',
        ]));*/

        /*sending email*/
        Mail::to($emailIds)->send(new EmailAlerts([
            'subject' => $subject,
            'message' => $message,
        ]));


        /*Mail Queue*/
        //dispatch(new AllEmail($emailIds, $subject, $message));

        //dispatch(new AllEmail($emailIds, $subject, $message))->delay(Carbon::now()->addSeconds(10));

    }

    /*Common Helper Function for this class*/
    public function emailFilter($emailCollections)
    {
        if(!empty($emailCollections)){
            //remove unwanted space from email address
            $emailCollections=array_map('trim',$emailCollections);
            $emailIds‍‍= [];
            foreach($emailCollections as $email){
                /*chek email id is correct or not if correct add on array other wise not*/
                $filterMail = filter_var($email,FILTER_VALIDATE_EMAIL);
                if($filterMail){
                    $emailIds[] = $filterMail;
                }
            }

            if(!isset($emailIds)) {
                return back()->with($this->message_warning, "No Any Email Id Found. Please, Select Your Target With Valid Email Group");
            }

            $emailIds = array_unique($emailIds);
            /*array to string separated with comma*/
            return $emailIds = implode(",",$emailIds);

        }else{
            return back()->with($this->message_warning, "No Any Email Id Found. Please, Select Your Target With Valid Email Group");
        }
    }

    public function contactFilter($contactNumbers){
        /*The Contact Number length and filter array*/
        /*$contactNumbers =array_values((array_filter($numbers, function($v){
            return strlen($v) == 10;
        })));*/
        /*Filter Duplicate Number get unique number*/
        $contactNumbers = array_unique($contactNumbers);
        /*array to string comma separated number*/
        return $contactNumbers = implode(",",$contactNumbers);
    }

    /*Check SMS CREDIT*/
    public function checkSmsCredit(Request $request)
    {
        /*Check Internet connectivity*/
        $connection = Parent::checkConnection();
        if(!$connection)
            return back()->with($this->message_warning, $this->internet_status);

        $smsSetting = SmsSetting::select('setting')->first();
        if($smsSetting == null){
            return back()->with($this->message_warning, "SMS Setting Not Detected. Please Setting Your SMS Detail First.");
        }

        $api_url = "http://api.sparrowsms.com/v2/credit/?" .
            http_build_query(array(
                'token' => $smsSetting->setting));
        $response = file_get_contents($api_url);
        $response = json_decode($response);

        if($response->credits_available > 0){
            return back()->with($this->message_success,  "You Have ".$response->credits_available." SMS CREDIT AVAILABLE");
        }else{
            return back()->with($this->message_warning, "You Have No Any SMS Credit/".$response->credits_available." SMS CREDIT AVAILABLE");
        }
    }

    /*Text Replace*/
    public function msgTextReplace($query, $message)
    {

    }

    protected function getSmsSetting()
    {
        $data['sms_setting'] = SmsSetting::where('status',1)->get();
        if(isset($data['sms_setting']) && $data['sms_setting']->count() > 0){
            $d = json_decode($data['sms_setting'],true);
            $manageSetting = array_pluck($d,'config','identity');
            return $manageSetting;
        }
    }


}