@ability('super-admin,admin', 'user-add, role-add')
    <div class="clearfix hidden-print ">
        <div class="easy-link-menu align-right">
            <a class="{!! request()->is('user*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user') }}"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;User</a>
            <a class="{!! request()->is('role*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('role') }}"><i class="fa fa-certificate" aria-hidden="true"></i> Role Accessibility</a>
        </div>
    </div>
    <hr class="hr-6">
@endability