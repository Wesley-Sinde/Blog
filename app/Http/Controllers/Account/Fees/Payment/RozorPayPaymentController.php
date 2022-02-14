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
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Razorpay\Api\Api;
use Session;
use Redirect;

class RozorPayPaymentController extends Controller
{

    protected $message_success = 'message_success';
    protected $message_warning = 'message_warning';
    protected $message_danger = 'message_danger';

    public function payWithRazorpay()
    {
        return view('payWithRazorpay');
    }

    public function payment()
    {
        //Input items of form
        $input = Input::all();
        //get API Configuration
        $api = new Api(config('rozorpay.razor_key'), config('rozorpay.razor_secret'));
        //Fetch payment information by razorpay_payment_id
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));

                $student = Student::where('reg_no',$response->description)->first();
                $student_id = isset($student->id)?$student->id:'0000';
                $date = Carbon::today();
                $amount = $response->amount/100;
                $ref_no = $response->id;
                $ref_text = json_encode($response);

                //Payment Store for Verification
                $data = [
                    'created_by'        => auth()->user()->id,
                    'students_id'       => $student_id,
                    'date'              => $date,
                    'amount'            => $amount,
                    'payment_gateway'   => 'Rozorpay',
                    'ref_no'            =>  $ref_no,
                    'ref_text'          =>  $ref_text
                ];


                $transaction =  OnlinePayment::create($data);

                $message = 'Online payment successfully. Thank you for payment. We Will Verify Your Payment Soon.';

                Session::flash($this->message_success, $message);
                return redirect()->back();

            } catch (\Exception $e) {
                return  $e->getMessage();
                $message = $e->getMessage();

                Session::flash($this->$message_warning, $message);
                return redirect()->back();
            }

            // Do something here for store payment details in database...
        }

       // \Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
    }
}