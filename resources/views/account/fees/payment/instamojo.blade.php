<hr class="hr-2">
{{--name,mobile_number,email,amount--}}
{{--
<button class="payment-button" style="background-color: #773292; color: #fff; border: none; padding: 5px 10px; border-radius: 2px;"
        data-due="{{ $net_balance*100 }}"
        data-product-identity="{{ $data['student']->reg_no }}"
        data-product-name="{{ ViewHelper::getSemesterById($feemaster->semester) }}-{{ ViewHelper::getFeeHeadById($feemaster->fee_head) }}">
    Pay with Instamojo
</button>--}}

<form method="POST" action="{{route('account.fees.instamojoPayment.index')}}">
    {{ csrf_field() }}
    <input type="hidden" name="gateway" value="Instamojo">
    <input type="hidden" name="student_id" value="{{ $data['student']->id }}">
    <input type="hidden" name="student_name" value="{{ $data['student']->first_name.' '.$data['student']->middle_name.' '.$data['student']->last_name.' ['.$data['student']->reg_no.']' }}">
    <input type="hidden" name="mobile" value="{{ $data['student']->mobile_1 }}">
    <input type="hidden" name="email" value="{{ $data['student']->email }}">
    <input type="hidden" name="balance" value="{{ $data['student']->balance }}">
    {{--<input type="hidden" name="description" value="Bulk Online Payment -{{$data['student']->id}}">--}}
    <button  type="submit">
        <img src="{{ asset('assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'paymenticon'.DIRECTORY_SEPARATOR.'Instamojo.png')}}" alt="Pay With Instamojo" width="200" >
    </button>
</form>

{{--
<a href="{{route('account.fees.instamojoPayment.index')}}" class="payment-button" data-due="{{ $net_balance*100 }}" >
    <img src="{{ asset('assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'paymenticon'.DIRECTORY_SEPARATOR.'Instamojo.png')}}" alt="Pay With Instamojo" width="200" >
</a>--}}
