<div class="clearfix hidden-print ">
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('role')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('role') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Detail</a>
        <a class="{!! request()->is('role/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('role.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create Role</a>

    </div>
</div>
<hr class="hr-6">