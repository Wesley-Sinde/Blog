{{--
<form class="w3-container w3-display-middle w3-card-4 w3-padding-16" method="POST" id="payment-form"
      action="{{ route('account.fees.paypalPayment') }}">
    <input class="w3-input w3-border" value="{{ $net_balance }}" id="amount" type="hidden" name="amount"></p>
    <button class="w3-btn w3-blue">Pay with PayPal</button>
    <button class="btn btn-xs btn-primary">
        <i class="fa fa-paypal"></i> Pay with Paypal
    </button>
</form>--}}


<a href="https://www.paypal.com/in/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/in/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;"><img src="https://www.paypalobjects.com/webstatic/mktg/Logo/pp-logo-200px.png" border="0" alt="PayPal Logo"></a>