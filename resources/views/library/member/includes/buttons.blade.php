<div class="clearfix hidden-print " >
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('library/member')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('library.member') }}"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Member Detail</a>
        <a class="{!! request()->is('library/member/add')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('library.member.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Member</a>
    </div>
</div>
<hr class="hr-4">