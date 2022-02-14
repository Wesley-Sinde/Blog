<form method="POST" action="{{route('account.fees.pay-stack-form')}}" accept-charset="UTF-8" class="form-horizontal" role="form">
    <input type="hidden" name="first_name" id="first_name" value="{{isset($data['student']->first_name) ? $data['student']->first_name : ''}}"   class="input-sm form-control border-form" required />
    <input type="hidden" name="last_name" id="last_name" value="{{isset($data['student']->last_name) ? $data['student']->last_name : ''}}"   class="input-sm form-control border-form" />
    <input type="hidden" type="email" name="email" value="{{isset($data['student']->email) ? $data['student']->email : ''}}"  class="input-sm form-control border-form" required />
    <input type="hidden" name="phone" value="{{isset($data['student']->mobile_1) ? $data['student']->mobile_1 : ''}}"  class="input-sm form-control border-form" required />
    <input type="hidden" name="amount" value="{{isset($data['student']->balance) ? $data['student']->balance*100 : 0}}"> {{-- required in kobo --}}
    <input type="hidden" name="metadata" value="{{\GuzzleHttp\json_encode([$data['student']->toArray(),'user_id'=>auth()->user()->id])}}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
    <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
    {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

    <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}

    <button type="submit">
        <img alt="PayUMoney Payment Request Form" src="{{ asset('assets/images/paymenticon/paystack.png') }}" width="200px" />
    </button>
</form>