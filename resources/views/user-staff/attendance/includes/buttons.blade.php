<div class="clearfix hidden-print ">
    <div class=" align-right">
        <a class="{!! request()->is('user-staff/attendance*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user-staff.attendance') }}"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> View My Attendance</a>
        {{--<a class="{!! request()->is('user-staff/student-attendance*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user-staff.student-attendance.add') }}"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Manage&nbsp;Student Attendance</a>--}}
        <a class="{!! request()->is('attendance/student*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('attendance.student') }}"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp;Student Regular Attendance</a>
        <a class="{!! request()->is('attendance/subject*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('attendance.subject') }}"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp;Student Subject Wise Attendance</a>
    </div>
</div>
<hr class="hr-6">