<div class="clearfix hidden-print ">
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('user')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Detail</a>
        @ability('super-admin,admin', 'user-add')
            <a class="{!! request()->is('user/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Create User</a>
        @endability
    </div>
</div>
<hr class="hr-6">