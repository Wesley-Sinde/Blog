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
use App\Http\Controllers\CollegeBaseController;
use App\Models\FeeCollection;
use App\Models\OnlinePayment;
use App\Traits\AccountingScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Session;

class InstamojoPaymentController extends CollegeBaseController
{

    protected $base_route = 'fees.instamojoPayment';
    protected $view_path = 'account.fees.payment.instamojo';
    protected $panel = 'Online Payment Instamojo';

    use AccountingScope;

    public function index(Request $request)
    {
        $data['data'] = $request->all();
        return view(parent::loadDataToView($this->view_path.'.form'), compact('data'));
    }

    public function pay(Request $request){

        //if feee head detect or due amount only make single or bulk payment
        $instamojo = $this->instamojoSetting();

        /*$api = new \Instamojo\Instamojo(
            $instamojo['API_KEY'],
            $instamojo['AUTH_TOKEN'],
            'https://test.instamojo.com/api/1.1/'
        );*/

        $api = new \Instamojo\Instamojo(
            $instamojo['API_KEY'],
            $instamojo['AUTH_TOKEN'],
            'https://www.instamojo.com/api/1.1/'
        );

        try {
            $response = $api->paymentRequestCreate(array(
                "purpose" => 'Balance Fee Online Payment -'.$request->student_id,
                "amount" => $request->amount,
                "buyer_name" => "$request->name",
                "send_email" => true,
                "email" => "$request->email",
                "phone" => "$request->mobile_number",
                "redirect_url" => route('account.fees.instamojoPayment.success')
            ));

            header('Location: ' . $response['longurl']);
            exit();
        }catch (Exception $e) {
            //print('Error: ' . $e->getMessage());
            $request->session()->flash($this->message_danger, $e->getMessage());
            return back();
        }
    }

    public function success(Request $request){
        try {

            $instamojo = $this->instamojoSetting();

            $api = new \Instamojo\Instamojo(
                $instamojo['API_KEY'],
                $instamojo['AUTH_TOKEN'],
                'https://instamojo.com/api/1.1/'
            );

            $response = $api->paymentRequestStatus(request('payment_request_id'));

            if( !isset($response['payments'][0]['status']) ) {
                $request->session()->flash($this->message_warning, 'Payment failed');
                return back();
            } else if($response['payments'][0]['status'] != 'Credit') {
                $request->session()->flash($this->message_warning, 'Payment failed');
                return back();
            }
        }catch (\Exception $e) {
            $request->session()->flash($this->message_warning, 'Payment failed');
            return back();
        }

        //$detail = json_encode(collect($response['payments']));
        $studentId = explode('-',$response['purpose']);
        $detail = collect(array_collapse($response['payments']));
        $amount = $response['amount'];
        $date = Carbon::now()->format('Y-m-d');

        $student_id = isset($studentId[1])?$studentId[1]:'0000';
        $ref_no = $detail['payment_id'];
        $ref_text = json_encode($response);

        //Payment Store for Verification
        $data = [
            'created_by'        => auth()->user()->id,
            'students_id'       => $student_id,
            'date'              => $date,
            'amount'            => $amount,
            'payment_gateway'   => 'Instamojo',
            'ref_no'            =>  $ref_no,
            'ref_text'          =>  $ref_text
        ];


        $transaction =  OnlinePayment::create($data);

        $message = 'Online payment successfully. Thank you for payment. We Will Verify Your Payment Soon.';

        Session::flash($this->message_success, $message);
        return redirect()->back();

        /*$request->request->add(['students_id' => $studentId[1]]);
        $request->request->add(['date' => $date]);
        $request->request->add(['receive_amount' => $amount]);
        $request->request->add(['payment_mode' => 'Instamojo']);
        $request->request->add(['note' => 'Instamojo, Ref:,PaymentId:'.$detail['payment_id']]);

        $feecollect =  $this->dueBulkReceive($request);

        if ($feecollect) {
            $request->session()->flash($this->message_success, 'Successfully Charge : ' . $amount);
        } else {
            $request->session()->flash($this->message_warning, 'Not Collect Yet');
        }*/

    }


    public function instamojoSetting()
    {
        $paymentSetting = parent::getPaymentSetting();
        return $instamojo = json_decode($paymentSetting['Instamojo'],true);
    }
}