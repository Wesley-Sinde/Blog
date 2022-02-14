@ability('super-admin', 'fees-payment-payumoney-payment')
    <hr class="hr-2">
    <form action="{{route('account.fees.payumoney-form')}}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="student_id" value="{{ $data['student']->id }}">
        <input type="hidden" name="fee_masters_id" value="{{ $feemaster->id }}">
        <input type="hidden" name="net_balance" value="{{ $net_balance }}">
        <input type="hidden" name="description" value="{{ ViewHelper::getSemesterById($feemaster->semester) }}-{{ ViewHelper::getFeeHeadById($feemaster->fee_head) }}">

        <button type="submit">
            <img alt="PayUMoney Payment Request Form" src="{{ asset('assets/images/paymenticon/payumoney.png') }}" width="100px" />
        </button>
    </form>
@endability
