<div class="clearfix hidden-print ">
    <div class="easy-link-menu align-right">
        <a class="{!! request()->is('account/fee*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.fees') }}"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Student Fee</a>
        <a class="{!! request()->is('account/payroll*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.payroll.master.add') }}"><i class="fa fa-user-secret" aria-hidden="true"></i>&nbsp;Staff Payroll</a>
        <a class="{!! request()->is('account/transaction-head')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('account.transaction-head') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Ledger</a>
        <a class="{!! request()->is('account/transaction')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('account.transaction') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Transactions</a>
        <a class="{!! request()->is('account/bank*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.bank') }}"><i class="fa fa-bank" aria-hidden="true"></i>&nbsp;Bank</a>
    </div>
    <hr class="hr-6">
</div>
