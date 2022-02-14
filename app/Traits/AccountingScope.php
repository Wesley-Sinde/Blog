<?php
namespace App\Traits;

use App\Models\AccountCategory;
use App\Models\Addressinfo;
use App\Models\AlertSetting;
use App\Models\Assets;
use App\Models\Bank;
use App\Models\FeeCollection;
use App\Models\FeeHead;
use App\Models\FeeMaster;
use App\Models\PaymentMethod;
use App\Models\PayrollHead;
use App\Models\Student;
use App\Models\TransactionHead;
use Carbon\Carbon;

trait AccountingScope{

    //use SmsEmailScope;
    //todo:

    public function getFeeHeadById($id)
    {
        $feeHead = FeeHead::find($id);
        if ($feeHead) {
            return $feeHead->fee_head_title;
        }else{
            return "Unknown";
        }
    }

    public function getTransactionHeadById($id)
    {
        $trHead = TransactionHead::find($id);
        if ($trHead) {
            return $trHead->tr_head;
        }else{
            return "Unknown";
        }
    }

    public function getPayrollHeadById($id)
    {
        $payrollHead = PayrollHead::find($id);
        if ($payrollHead) {
            return $payrollHead->title;
        }else{
            return "Unknown";
        }
    }

    public function getBankNameById($id)
    {
        $bank = Bank::find($id);
        if ($bank) {
            return $bank->bank_name;
        }else{
            return "Unknown";
        }
    }

    public function getAcGroupById($id)
    {
        $ac = AccountCategory::find($id);
        if ($ac) {
            return $ac->ac_name;
        }else{
            return "Unknown";
        }
    }

    public function activeFeeHead()
    {
        $feeHead = FeeHead::select('id', 'fee_head_title')->Active()->orderBy('fee_head_title')->pluck('fee_head_title','id')->toArray();
        return array_prepend($feeHead,'Select Fee Head',0);
    }

    public function activePayrollHead()
    {
        $payrollHead = PayrollHead::select('id', 'title')->Active()->orderBy('title')->pluck('title','id')->toArray();
        return array_prepend($payrollHead,'Select Payroll Head',0);
    }

    public function activePaymentMethod()
    {
        $method = PaymentMethod::Active()->orderBy('id')->pluck('title','title')->toArray();
        return array_prepend($method,'','');
    }

    public function getBalanceFeeByStudentId($id)
    {
        $student = Student::where('id',$id)->first();
        $feeMaster = $student->feemaster()->sum('fee_amount');
        $feeCollection = $student->feeCollect()->get();
        $paidAmount = $feeCollection->sum('paid_amount');
        $discount = $feeCollection->sum('discount');
        $fine = $feeCollection->sum('fine');
        $balanceFee = ($feeMaster - ($paidAmount+$discount))+$fine;
       return $balanceFee;
    }

    public function dueBulkReceive($request)
    {
        $students = Student::where('id',$request->students_id)->get();
        //student filter
        $filtered  = $students->filter(function ($student) use ($request) {
            $feeMaster = $student->feeMaster()->orderBy('fee_due_date','asc')->get();
            $student->fee_amount = $feeMaster->sum('fee_amount');
            $student->paid_amount = $student->feeCollect()->sum('paid_amount');
            $student->discount = $student->feeCollect()->sum('discount');
            $student->fine = $student->feeCollect()->sum('fine');
            $student->balance = ($student->fee_amount + $student->fine) - ($student->discount + $student->paid_amount);
            $totalReceiveAmt = intval($request->receive_amount);

            if($student->balance > 0 && $totalReceiveAmt > 0){
                /*filter due using call back*/
                $receiveAmount = $totalReceiveAmt;
                foreach ($feeMaster as $fm){
                    $fee_amount = $fm->fee_amount;
                    $paid_amount = $fm->feeCollect()->sum('paid_amount');
                    $discount = $fm->feeCollect()->sum('discount');
                    $fine = $fm->feeCollect()->sum('fine');
                    $balance = ($fee_amount + $fine) - ($discount + $paid_amount);

                    if($receiveAmount > 0 && $balance > 0){
                        if($balance > $receiveAmount){
                            $collectionData = [
                                'students_id'       => $request->students_id,
                                'fee_masters_id'    => $fm->id,
                                'date'              => $request->date,
                                'paid_amount'       => $receiveAmount,
                                'payment_mode'      => $request->payment_mode,
                                'note'              => $request->note?'Quick Receive : '.$request->note:'Quick Receive',
                                'created_by'        => auth()->user()->id
                            ];

                            $data = FeeCollection::create($collectionData);
                            $receiveAmount = 0;
                        }else{
                            if($receiveAmount > 0 ){
                                $collectionData = [
                                    'students_id'       => $request->students_id,
                                    'fee_masters_id'    => $fm->id,
                                    'date'              => $request->date,
                                    'paid_amount'       =>$balance,
                                    'payment_mode'      => $request->payment_mode,
                                    'note'              => 'Quick Receive : '. $request->note,
                                    'created_by'        => auth()->user()->id
                                ];

                                $data = FeeCollection::create($collectionData);
                                $receiveAmount  = $receiveAmount  - $balance;
                            }else{

                            }

                        }
                    }
                }

            }

        });

        return back();
    }


    //send fee receive alert
    public function feeReceiveAlert($studentId, $amount)
    {
        $emailIds = [];
        $contactNumbers = [];
        $alert = AlertSetting::select('sms','email','subject','template')->where('event','=','FeeReceive')->first();
        if(!$alert) {

        }else{
            $student = Student::find($studentId);
            $today = Carbon::today()->format('Y-m-d');
            //send alert
            //Dear {{first_name}}, We would like to inform you we are successfully received {{amount}} on {{date}}. Thank you for the Deposit.
            $subject = $alert->subject;
            $message = $alert->template;
            $message = str_replace('{{first_name}}', $student->first_name, $message );
            $message = str_replace('{{amount}}', $amount, $message );
            $message = str_replace('{{date}}', $today, $message );
            $emailIds[] = $student->email;
            $contactNumbers[] = $this->getStudentMobileNumber($student->id);

            /*Now Send SMS On First Mobile Number*/
            if($alert->sms == 1){
                $contactNumbers = $this->contactFilter($contactNumbers);
                $smssuccess = $this->sendSMS($contactNumbers,$message);
            }

            /*Now Send Email With Subject*/
            if($alert->email == 1){
                $emailIds = $this->emailFilter($emailIds);
                $emailSuccess = $this->sendEmail($emailIds, $subject, $message);
            }

        }
    }


    /*Common Helper Function for this class*/
    /*public function emailFilter($emailCollections)
    {
        if(!empty($emailCollections)){
            //remove unwanted space from email address
            $emailCollections=array_map('trim',$emailCollections);
            $emailIds‍‍ = [];
            foreach($emailCollections as $email){
                //chek email id is correct or not if correct add on array other wise not
                $filterMail = filter_var($email,FILTER_VALIDATE_EMAIL);
                if($filterMail){
                    $emailIds[] = $filterMail;
                }
            }

            if(!isset($emailIds)) {
                return back()->with($this->message_warning, "No Any Email Id Found. Please, Select Your Target With Valid Email Group");
            }

            $emailIds = array_unique($emailIds);
            /*array to string separated with comma
            return $emailIds = implode(",",$emailIds);

        }else{
            return back()->with($this->message_warning, "No Any Email Id Found. Please, Select Your Target With Valid Email Group");
        }
    }*/

    /*public function contactFilter($contactNumbers){
        //The Contact Number length and filter array
        $contactNumbers =array_values((array_filter($numbers, function($v){
            return strlen($v) == 10;
        })));
        //Filter Duplicate Number get unique number
        $contactNumbers = array_unique($contactNumbers);
        //array to string comma separated number
        return $contactNumbers = implode(",",$contactNumbers);
    }*/

    public function addressVillage()
    {
        $village = Addressinfo::select('address')->get();
        if($village->count() > 0){
            $fetchAddress = array_prepend(array_unique($village->pluck('address','address')->toArray()),'','');
        }else{
            $fetchAddress = [];
        }

        return $fetchAddress;

    }


    public function getAssetsById($id)
    {
        $assets = Assets::find($id);
        if ($assets) {
            return $assets->title;
        }else{
            return "Unknown";
        }
    }
}