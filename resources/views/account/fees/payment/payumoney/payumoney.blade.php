<form action="{{route('account.fees.payumoney-form')}}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="student_id" value="{{ $data['student']->id }}">
    <input type="hidden" name="reg_no" value="{{ $data['student']->reg_no }}">
    <input type="hidden" name="net_balance" value="{{ $data['student']->balance }}">
    <input type="hidden" name="description" value="{{\GuzzleHttp\json_encode([$data['student']->toArray(),'user_id'=>auth()->user()->id])}}">

    <button type="submit">
        <img alt="PayUMoney Payment Request Form" src="{{ asset('assets/images/paymenticon/payumoney.png') }}" width="100px" />
    </button>
</form>
