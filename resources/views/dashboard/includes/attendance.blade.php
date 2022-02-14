<div class="widget-box transparent" id="recent-box">
    <div class="widget-header">
        <h4 class="widget-title lighter smaller">
            <i class="ace-icon fa fa-calendar blue"></i>Attendance
        </h4>

        <div class="widget-toolbar no-border">
            <ul class="nav nav-tabs" id="recent-tab">
                <li class="active">
                    <a data-toggle="tab" href="#booklet-tab">Booklet</a>
                </li>

                {{--<li>
                    <a data-toggle="tab" href="#studentAttenaence-tab">Student Attendance</a>
                </li>

                <li>
                    <a data-toggle="tab" href="#staffAttendance-tab">Staff Attendance</a>
                </li>--}}
            </ul>
        </div>
    </div>

    <div class="widget-body">
        <div class="widget-main padding-4">
            <div class="tab-content padding-8">
                <div id="booklet-tab" class="tab-pane active">
                    @include('dashboard.includes.attendance.booklet')
                </div>

               {{-- <div id="studentAttendnce-tab" class="tab-pane">
                    @include('dashboard.includes.account.payroll')
                </div>

                <div id="staffAttendance-tab" class="tab-pane">
                    @include('dashboard.includes.account.transaction')
                </div><!-- /.#member-tab -->--}}
            </div>
        </div><!-- /.widget-main -->
    </div><!-- /.widget-body -->
</div><!-- /.widget-box -->