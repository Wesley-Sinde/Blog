<div class="clearfix hidden-print " >
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('account/report/cash-book')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('account.report.cash-book') }}"><i class="fa fa-dollar" aria-hidden="true"></i>&nbsp;Cash Book</a>
        <a class="{!! request()->is('account/report/fee-collection')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('account.report.fee-collection') }}"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Fee Collection</a>
        <a class="{!! request()->is('account/report/fee-online-payment')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('account.report.fee-online-payment') }}"><i class="fa fa-globe" aria-hidden="true"></i> Online Payment</a>
        <a class="{!! request()->is('account/report/fee-collection-head')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('account.report.fee-collection-head') }}"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Fee Collection Head</a>
        <a class="{!! request()->is('account/report/balance-fee')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('account.report.balance-fee') }}"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Fee Balance Statement</a>
        <a class="{!! request()->is('account/transaction-head/view')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('account.transaction-head.view') }}"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Statement of Ledger</a>
        <a class="{!! request()->is('account/transaction-head/balance-statement')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('account.transaction-head.balance-statement') }}"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Ledger Balance</a>
    </div>
    <hr class="hr-4">
</div>
