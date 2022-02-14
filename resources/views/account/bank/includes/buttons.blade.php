<div class="clearfix hidden-print " >
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('account/bank')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('account.bank') }}"><i class="fa fa-bank" aria-hidden="true"></i>&nbsp;Manage Bank</a>
        <a class="{!! request()->is('account/bank/add')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('account.bank.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add New Bank</a>
        <a class="{!! request()->is('account/bank-transaction*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.bank-transaction') }}"><i class="fa fa-list-alt" aria-hidden="true"></i> Transactions Detail</a>
        <a class="{!! request()->is('account/bank-transaction/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.bank-transaction.add') }}"><i class="fa fa-exchange" aria-hidden="true"></i> Bank&nbsp;Transaction</a>
    </div>
</div>
<hr class="hr-4">