<div class="clearfix hidden-print ">
    <div class="easy-link-menu align-left">
        <a class="{!! request()->is('student')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('student') }}"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;Detail</a>
        <a class="{!! request()->is('student/registration*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('student.registration') }}"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Registration</a>
        <a class="{!! request()->is('student/import*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('student.import') }}"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;Bulk Registration</a>
        <a class="{!! request()->is('student/transfer*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('student.transfer') }}"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp;Transfer</a>
        <a class="{!! request()->is('student/document*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('student.document') }}"><i class="fa fa-files-o" aria-hidden="true"></i>&nbsp;Documents</a>
        <a class="{!! request()->is('student/note*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('student.note') }}"><i class="fa fa-sticky-note" aria-hidden="true"></i>&nbsp;Notes</a>
        <a class="{!! request()->is('account/fees/balance')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('account.fees.balance') }}"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Balance Fees</a>
        <a class="{!! request()->is('library/student*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('library.student') }}"><i class="fa fa-calculator" aria-hidden="true"></i> Library</a>
        <a class="{!! request()->is('attendance/student*')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('attendance.student') }}"><i class="fa fa-calendar" aria-hidden="true"></i> Attendance</a>
    </div>
    <hr class="hr-6 ">
</div>
