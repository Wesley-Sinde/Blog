<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Account\Fees\Payment;
use App\Models\OnlinePayment;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Paystack;

class PayStackPaymentController extends Controller
{

    protected $message_success = 'message_success';
    protected $message_warning = 'message_warning';
    protected $message_danger = 'message_danger';

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        //dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
        if($paymentDetails['data']['status'] != 'success'){
            //session()->flash($this->message_warning, 'Sorry, payment failed');
            Session::flash($this->message_warning, 'Sorry, payment failed');
        }else{
            $created_by = $paymentDetails['data']['metadata']['user_id'];
            $student_id = $paymentDetails['data']['metadata'][0]['id'];
            $date = Carbon::today();
            $amount = $paymentDetails['data']['amount']/100;
            $ref_no = $paymentDetails['data']['reference'];
            $ref_text = json_encode($paymentDetails);

            //Payment Store for Verification
            $data = [
                'created_by'        => $created_by,
                'students_id'       => $student_id,
                'date'              => $date,
                'amount'            => $amount,
                'payment_gateway'   => 'PayStack',
                'ref_no'            => $ref_no,
                'ref_text'          =>  $ref_text
            ];


            $transaction =  OnlinePayment::create($data);

            $message = 'Online payment successfully. Thank you for payment. We Will Verify Your Payment Soon.';

            Session::flash($this->message_success, $message);
        }

        //redirect here
        return redirect($paymentDetails['data']['metadata'][0]['currentURL']);
    }
}