<?php
namespace App\Traits\SmsGateway;

trait BudgetSmsNet{

    /*Sparrow SMS*/
    public function BudgetSMS($contactNumbers, $message)
    {
        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['BudgetSmsNet'],true);
        $username    = $sms['Username'];
        $userId    = $sms['UserID'];
        $handle    = $sms['Handle'];
        $from    = $sms['From'];
        /*array to string comma separated number*/
        //$contactNumbers = implode(",",$contactNumbers);

        //https://api.budgetsms.net/sendsms/

        $api_url = "https://api.budgetsms.net/sendsms?username=".$username.'&userid='.$userId.'&handle='.$handle.'&from='.$from.'&to='.$contactNumbers.'&msg='.urlencode($message);

        file_get_contents($api_url);
    }

}