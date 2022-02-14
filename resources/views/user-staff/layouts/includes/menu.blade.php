
<div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse ace-save-state hidden-print">
    <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
    </script>

    <ul class="nav nav-list">
        {{-- Dashboard --}}
        <li class="{!! request()->is('user-staff')?'active':'' !!}">
            <a href="{{ route('user-staff') }}" >
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>

        {{-- Account --}}
        <li class="{!! request()->is('user-staff/payroll*')?'active open':'' !!}  hover">
            <a href="{{ route('user-staff.payroll') }}" >
                <i class="menu-icon fa fa-calculator" aria-hidden="true"></i>
                <span class="menu-text">Payroll</span>
            </a>
        </li>

        {{-- Library --}}
        <li class="{!! request()->is('user-staff/library*')?'active':'' !!} hover">
            <a href="{{ route('user-staff.library') }}" >
                <i class="menu-icon fa fa-book" aria-hidden="true"></i>
                <span class="menu-text">Library</span>
            </a>
            <b class="arrow"></b>
        </li>

        {{-- Hostel --}}
        <li class="{!! request()->is('user-staff/hostel*')?'active':'' !!} hover">
            <a href="{{ route('user-staff.hostel') }}">
                <i class="menu-icon  fa fa-bed" aria-hidden="true"></i>
                <span class="menu-text"> Hostels </span>
            </a>
            <b class="arrow"></b>
        </li>

        {{-- Transport --}}
        <li class="{!! request()->is('user-staff/transport*')?'active':'' !!} hover">
            <a href="{{ route('user-staff.transport') }}">
                <i class="menu-icon  fa fa-bus" aria-hidden="true"></i>
                <span class="menu-text"> Transport </span>
            </a>
            <b class="arrow"></b>
        </li>

        <li class="{!! request()->is('user-staff/subject*')?'active':'' !!} hover">
            <a href="{{ route('user-staff.subject') }}">
                <i class="menu-icon  fa fa-list-alt" aria-hidden="true"></i>
                <span class="menu-text"> Course </span>
            </a>
            <b class="arrow"></b>
        </li>

        {{-- Notice --}}
        <li class="{!! request()->is('user-staff/notice*')?'active':'' !!} hover">
            <a href="{{ route('user-staff.notice') }}">
                <i class="menu-icon  fa fa-bullhorn" aria-hidden="true"></i>
                <span class="menu-text"> Notice </span>
            </a>
            <b class="arrow"></b>
        </li>

        {{--<li class="{!! request()->is('user-staff/download*')?'active':'' !!} hover">
            <a href="{{ route('user-staff.download') }}">
                <i class="menu-icon  fa fa-download" aria-hidden="true"></i>
                <span class="menu-text"> Download </span>
            </a>
            <b class="arrow"></b>
        </li>--}}

        {{-- Attendance --}}
        @ability('super-admin','attendance')
        <li class="{!! request()->is('attendance*')?'active':'' !!} hover">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-calendar" aria-hidden="true"></i>
                <span class="menu-text"> Attendance</span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="{!! request()->is('user-staff/attendance*')?'active':'' !!} hover">
                    <a href="{{ route('user-staff.attendance') }}">
                        <i class="menu-icon fa fa-calendar" aria-hidden="true"></i>
                        <span class="menu-text"> My Attendance</span>
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="hover">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Student Attendance
                        <b class="arrow fa fa-angle-r"></b>
                    </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="{!! request()->is('attendance/student*')?'active':'' !!} hover">
                            <a href="{{ route('attendance.student') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Regular Attendance
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="{!! request()->is('attendance/subject*')?'active':'' !!} hover">
                            <a href="{{ route('attendance.subject') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Subject Wise Attendance
                            </a>

                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        @endability


        {{-- Examination --}}
        @ability('super-admin','examination')
        <li class="{!! request()->is('exam*')?'active':'' !!} hover">
            <a href="{{ route('exam.mark-ledger') }}">
                <i class="menu-icon fa fa-line-chart"  aria-hidden="true"></i>
                <span class="menu-text"> Exam</span>

                <b class="arrow fa fa-angle-down"></b>
            </a>
        </li>
        @endability

        @ability('super-admin','assignment')
        @if( isset($generalSetting) && $generalSetting->assignment ==1)
            <li class="{!! request()->is('assignment')?'active':'' !!} hover">
                <a href="{{ route('assignment') }}">
                    <i class="menu-icon fa fa-tasks"></i>
                    Assignment
                </a>
                <b class="arrow"></b>
            </li>
        @endif
        @endability

        @ability('super-admin','download')
        @if( isset($generalSetting) && $generalSetting->upload_download ==1)
            <li class="{!! request()->is('download*')?'active':'' !!} hover">
                <a href="{{ route('download') }}">
                    <i class="menu-icon fa fa-download"></i>
                    Download
                    <b class="arrow fa fa-angle-r"></b>
                </a>
            </li>
        @endif
        @endability

        @ability('super-admin','meeting')
        @if( isset($generalSetting) && $generalSetting->meeting ==1)
            <li class="{!! request()->is('meeting*')?'active':'' !!} hover">
                <a href="{{ route('meeting') }}">
                    <i class="menu-icon fa fa-video-camera"></i>
                    Meeting
                    <b class="arrow fa fa-angle-r"></b>
                </a>
            </li>
        @endif
        @endability


    </ul><!-- /.nav-list -->
</div>
