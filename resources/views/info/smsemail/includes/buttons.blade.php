<div class="clearfix hidden-print ">
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('info/smsemail')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('info.smsemail') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Detail</a>
        <a class="{!! request()->is('info/smsemail/create')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('info.smsemail.create') }}"><i class="fa fa-group" aria-hidden="true"></i>&nbsp;Group Message</a>
        <a class="{!! request()->is('info/smsemail/student-guardian')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('info.smsemail.student-guardian') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Student & Guardian</a>
        <a class="{!! request()->is('info/smsemail/staff')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('info.smsemail.staff') }}"><i class="fa fa-user-secret" aria-hidden="true"></i>&nbsp;Staff</a>
        <a class="{!! request()->is('info/smsemail/individual')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('info.smsemail.individual') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Individual</a>
        {{--<a class="{!! request()->is('info/smsemail/checkSmsCredit')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('info.smsemail.checkSmsCredit') }}"><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;Check SMS Credit</a>--}}

    </div>
</div>
<hr class="hr-6">