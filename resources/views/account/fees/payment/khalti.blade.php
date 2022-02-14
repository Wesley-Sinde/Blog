@ability('super-admin', 'fees-payment-khalti-payment')
<hr class="hr-2">
<!-- Place this where you need payment button -->
<button class="payment-button" style="background-color: #773292; color: #fff; border: none; padding: 5px 10px; border-radius: 2px;"
        data-due="{{ $net_balance*100 }}"
        data-product-identity="{{ $data['student']->reg_no }}"
        data-product-name="{{ ViewHelper::getSemesterById($feemaster->semester) }}-{{ ViewHelper::getFeeHeadById($feemaster->fee_head) }}">
    Pay with Khalti
</button>
@endability