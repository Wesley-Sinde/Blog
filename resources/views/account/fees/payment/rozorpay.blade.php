<form action="{{route('account.fees.pay-with-razorpay.success')}}" method="GET" >
    <!-- Note that the amount is in paise = 50 INR -->
    <!--amount need to be in paisa-->
    <script src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="{{ env('RAZORPAY_KEY') }}"
            data-amount="{{isset($data['student']->balance) ? $data['student']->balance*100 : 0}}"
            data-note="{{\GuzzleHttp\json_encode(['reg_no'=>$data['student']->reg_no,'user_id'=>auth()->user()->id])}}"
            data-buttontext="Pay With RoZerPay"
            data-name="{{isset($data['student']->first_name) ? $data['student']->first_name : ''}}{{isset($data['student']->middle_name) ? ' '.$data['student']->middle_name : ''}}{{isset($data['student']->last_name) ? ' '.$data['student']->last_name : ''}}"
            data-description="{{isset($data['student']->reg_no)?$data['student']->reg_no:'0000'}}"
            data-notes="{{isset($data['student']->reg_no)?$data['student']->reg_no:'0000'}}"
            data-image="{{ asset('assets/images/paymenticon/rozorpay.png') }}"
            data-prefill.name="{{isset($data['student']->first_name) ? $data['student']->first_name : ''}}{{isset($data['student']->middle_name) ? ' '.$data['student']->middle_name : ''}}{{isset($data['student']->last_name) ? ' '.$data['student']->last_name : ''}}"
            data-prefill.email="{{isset($data['student']->email) ? $data['student']->email : ''}}"
            data-theme.color="#ff7529">
    </script>
    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
</form>