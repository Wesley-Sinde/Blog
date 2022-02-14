<div class="clearfix hidden-print " >
    <div class="easy-link-menu align-right">
        <a class="{!! request()->is('library/book*')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('library.book') }}"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Book Detail</a>
        <a class="{!! request()->is('library/issue-history*')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('library.issue-history') }}"><i class="fa fa-history" aria-hidden="true"></i>&nbsp;Issue History</a>
        <a class="{!! request()->is('library/member*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('library.member') }}"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Membership</a>
        <a class="{!! request()->is('library/student*')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('library.student') }}"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Students Member</a>
        <a class="{!! request()->is('library/staff*')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('library.staff') }}"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Staffs Member</a>
        <a class="{!! request()->is('library/return-over')?'btn-success':'btn-warning' !!} btn-sm " href="{{ route('library.return-over') }}"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;  Return Period Over&nbsp;</a>
    </div>
</div>
