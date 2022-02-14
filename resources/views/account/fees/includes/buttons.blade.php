<div class="clearfix hidden-print ">
    <div class="easy-link-menu">
        <a class="{!! request()->is('account/fees')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('account.fees') }}"><i class="fa fa-history" aria-hidden="true"></i>&nbsp;Receive History</a>
        <a class="{!! request()->is('account/fees/master')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('account.fees.master') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Master Detail</a>
        <a class="{!! request()->is('account/fees/master/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.fees.master.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Fees</a>
        <a class="{!! request()->is('account/fees/quick-receive')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.fees.quick-receive') }}"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Quick Receive</a>
        <a class="{!! request()->is('account/fees/collection')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.fees.collection') }}"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Collect Fees</a>
        <a class="{!! request()->is('account/fees/balance')?'btn-success':'btn-warning' !!} btn-sm" href="{{ route('account.fees.balance') }}"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;Balance Fees</a>
        <a class="{!! request()->is('account/fees/online-payment')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.fees.online-payment') }}"><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;Online Payment</a>
        <a class="{!! request()->is('account/fees/head')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.fees.head') }}"><i class="fa fa-header" aria-hidden="true"></i>&nbsp;Fees Head</a>
    </div>
</div>
<hr class="hr-6">