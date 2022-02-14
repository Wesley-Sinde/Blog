<div class="clearfix hidden-print ">
    <div class="">
        <a class="{!! request()->is('account/transaction')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('account.transaction') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Detail</a>
        <a class="{!! request()->is('account/transaction/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.transaction.add') }}"><i class="fa fa-plus" aria-hidden="true"></i> Transaction</a>
        <a class="{!! request()->is('account/transaction/multi-add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.transaction.multi-add') }}"><i class="fa fa-plus" aria-hidden="true"></i> Multi Transaction</a>
        <a class="{!! request()->is('account/transfer')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.transfer') }}"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp;Acc To Acc</a>
        <a class="{!! request()->is('account/transaction-head')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.transaction-head') }}"><i class="fa fa-newspaper-o" aria-hidden="true"></i>&nbsp;Ledgers</a>
        <a class="{!! request()->is('account/transaction/account-group')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.transaction.account-group') }}"><i class="fa fa-tree" aria-hidden="true"></i>&nbsp;Acc Group</a>
    </div>
</div>
<hr class="hr-6">