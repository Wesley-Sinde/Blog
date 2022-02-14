<div class="clearfix hidden-print " >
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('user-staff/library')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('user-staff.library') }}"><i class="fa fa-history" aria-hidden="true"></i>Library History</a>
        <a class="{!! request()->is('user-staff/library/book-list*')?'btn-success':'btn-primary' !!} btn-sm " href="{{ route('user-staff.library.book-list') }}"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Book Request</a>
    </div>
</div>
<hr class="hr-6">