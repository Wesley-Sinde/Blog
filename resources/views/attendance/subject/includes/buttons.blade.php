<div class="clearfix hidden-print ">
    <div class=" ">
        <a class="{!! request()->is('attendance/subject')?'btn-success':'btn-primary' !!}  btn-sm"  href="{{ route('attendance.subject') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Attendance Detail</a>
        <a class="{!! request()->is('attendance/subject/add')?'btn-success':'btn-primary' !!}  btn-sm" href="{{ route('attendance.subject.add') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add / Edit {{ $panel }}</a>
        <a class="{!! request()->is('attendance/subject/alert')?'btn-success':'btn-primary' !!}  btn-sm" href="{{ route('attendance.subject.alert') }}"><i class="fa fa-bell" aria-hidden="true"></i>&nbsp; {{ $panel }} Alert</a>
    </div>
</div>
<hr class="hr-6">