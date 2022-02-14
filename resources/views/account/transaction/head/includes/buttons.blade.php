<div class="clearfix hidden-print ">
    <div class="">
        <a class="{!! request()->is('account/transaction')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('account.transaction') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Transaction Detail</a>
        <a class="{!! request()->is('account/transaction/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.transaction.add') }}"><i class="fa fa-plus" aria-hidden="true"></i> New Transaction</a>
        <a class="{!! request()->is('account/transaction-head')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.transaction-head') }}"><i class="fa fa-group" aria-hidden="true"></i>&nbsp;Ledgers</a>
    </div>
</div>
<hr class="hr-6">