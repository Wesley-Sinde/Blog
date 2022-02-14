<div class="clearfix hidden-print " >
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('inventory/sem-assets')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('inventory.sem-assets') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Sem Assets List</a>
        <a class="{!! request()->is('inventory/sem-assets/add')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('inventory.sem-assets.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Assets on Sem</a>
    </div>
</div>
<hr class="hr-4">