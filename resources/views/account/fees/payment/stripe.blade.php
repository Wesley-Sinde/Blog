{{--
@php($stripe = json_decode($paymentSetting['Stripe'],true))
@php(print_r($stripe))
@if(isset($stripe['Publishable_Key']))
@endif

<hr class="hr-2">
<form action="{{route('account.fees.stripePayment')}}" method="POST">
    <input type="hidden" name="student_id" value="{{ $data['student']->id }}">
    <input type="hidden" name="fee_masters_id" value="{{ $feemaster->id }}">
    <input type="hidden" name="net_balance" value="{{ $net_balance }}">
    <input type="hidden" name="description" value="{{ ViewHelper::getSemesterById($feemaster->semester) }}-{{ ViewHelper::getFeeHeadById($feemaster->fee_head) }}">
    <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{$stripe['Publishable_Key']}}"
            data-amount="{{$net_balance*100}}"
            data-name="Stripe"
            data-description="{{ ViewHelper::getSemesterById($feemaster->semester) }}-{{ ViewHelper::getFeeHeadById($feemaster->fee_head) }}"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto">
    </script>
</form>
--}}

<hr class="hr-2">
<form action="{{route('account.fees.stripePayment')}}" method="POST">
    <input type="hidden" name="gateway" value="Stripe">
    <input type="hidden" name="student_id" value="{{ $data['student']->id }}">
    <input type="hidden" name="fee_masters_id" value="{{ $feemaster->id }}">
    <input type="hidden" name="net_balance" value="{{ $net_balance }}">
    <input type="hidden" name="description" value="{{ ViewHelper::getSemesterById($feemaster->semester) }}-{{ ViewHelper::getFeeHeadById($feemaster->fee_head) }}">
    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="{{$stripe['Publishable_Key']}}"
        data-amount="{{$net_balance*100}}"
        data-name="Stripe"
        data-description="{{ ViewHelper::getSemesterById($feemaster->semester) }}-{{ ViewHelper::getFeeHeadById($feemaster->fee_head) }}"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto">
    </script>
</form>