@ability('super-admin', 'fees-payment-pesapal')
    <hr class="hr-2">
    <form action="{{route('account.fees.pesapal-form')}}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="student_id" value="{{ $data['student']->id }}">
        <input type="hidden" name="fee_masters_id" value="{{ $feemaster->id }}">
        <input type="hidden" name="net_balance" value="{{ $net_balance }}">
        <input type="hidden" name="description" value="{{ ViewHelper::getSemesterById($feemaster->semester) }}-{{ ViewHelper::getFeeHeadById($feemaster->fee_head) }}">

        <button type="submit">
            <img alt="Pesaple" src="{{ asset('assets/images/paymenticon/pesapal.png') }}" width="100px" />
        </button>
    </form>
@endability
