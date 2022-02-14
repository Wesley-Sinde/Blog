<div class="clearfix hidden-print " >
    <div class="align-right">
        <a class="{!! request()->is('inventory/assets*')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('inventory.assets') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Assets</a>
        <a class="{!! request()->is('inventory/sem-assets*')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('inventory.sem-assets') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Sem Assets</a>
    </div>
</div>
<hr class="hr-4">