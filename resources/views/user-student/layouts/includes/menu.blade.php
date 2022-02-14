<div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse ace-save-state hidden-print">
    <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
    </script>

    <ul class="nav nav-list">
        {{-- Dashboard --}}
        @permission('student-dashboard')
        <li class="{!! request()->is('user-student')?'active':'' !!}">
            <a href="{{ route('user-student') }}" >
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>
        @endpermission

        {{-- Profile --}}
        @permission('student-profile')
        <li class="{!! request()->is('user-student/profile*')?'active':'' !!}">
            <a href="{{ route('user-student.profile') }}" >
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text"> Profile </span>
            </a>
        </li>
        @endpermission

        {{-- Account --}}
        @permission('student-fees')
        <li class="{!! request()->is('user-student/fees*')?'active open':'' !!}  hover">
            <a href="{{ route('user-student.fees') }}" >
                <i class="menu-icon fa fa-calculator" aria-hidden="true"></i>
                <span class="menu-text">Fees</span>
            </a>
        </li>
        @endpermission

        {{-- Library --}}
        @permission('student-library')
        <li class="{!! request()->is('user-student/library*')?'active':'' !!} hover">
            <a href="{{ route('user-student.library') }}" >
                <i class="menu-icon fa fa-book" aria-hidden="true"></i>
                <span class="menu-text">Library</span>
            </a>
            <b class="arrow"></b>
        </li>
        @endpermission

        {{-- Attendance --}}
        @permission('student-attendance')
        <li class="{!! request()->is('user-student/attendance*')?'active':'' !!} hover">
            <a href="{{ route('user-student.attendance') }}">
                <i class="menu-icon fa fa-calendar" aria-hidden="true"></i>
                <span class="menu-text"> Attendance</span>
            </a>
            <b class="arrow"></b>
        </li>
        @endpermission

        {{-- Hostel --}}
        @permission('student-hostel')
        <li class="{!! request()->is('user-student/hostel*')?'active':'' !!} hover">
            <a href="{{ route('user-student.hostel') }}">
                <i class="menu-icon  fa fa-bed" aria-hidden="true"></i>
                <span class="menu-text"> Hostels </span>
            </a>
            <b class="arrow"></b>
        </li>
        @endpermission

        {{-- Transport --}}
        @permission('student-transport')
        <li class="{!! request()->is('user-student/transport*')?'active':'' !!} hover">
            <a href="{{ route('user-student.transport') }}">
                <i class="menu-icon  fa fa-bus" aria-hidden="true"></i>
                <span class="menu-text"> Transport </span>
            </a>
            <b class="arrow"></b>
        </li>
        @endpermission

        {{-- Subject --}}
        @permission('student-course')
        <li class="{!! request()->is('user-student/subject*')?'active':'' !!} hover">
            <a href="{{ route('user-student.subject') }}">
                <i class="menu-icon  fa fa-list-alt" aria-hidden="true"></i>
                <span class="menu-text"> Course </span>
            </a>
            <b class="arrow"></b>
        </li>
        @endpermission

        {{-- Notice --}}
        @permission('student-notice')
        <li class="{!! request()->is('user-student/notice*')?'active':'' !!} hover">
            <a href="{{ route('user-student.notice') }}">
                <i class="menu-icon  fa fa-bullhorn" aria-hidden="true"></i>
                <span class="menu-text"> Notice </span>
            </a>
            <b class="arrow"></b>
        </li>
        @endpermission

        {{-- Examination --}}
        @permission('student-exam')
        <li class="{!! request()->is('user-student/exams*')?'active':'' !!} hover">
            <a href="{{ route('user-student.exams') }}">
                <i class="menu-icon fa fa-line-chart"  aria-hidden="true"></i>
                <span class="menu-text"> Exam</span>
            </a>
            <b class="arrow"></b>
        </li>
        @endpermission

        {{-- Assignment --}}
        @permission('student-assignment')
        <li class="{!! request()->is('user-student/assignment*')?'active':'' !!} hover">
            <a href="{{ route('user-student.assignment') }}">
                <i class="menu-icon  fa fa-tasks" aria-hidden="true"></i>
                <span class="menu-text"> Assignment </span>
            </a>
            <b class="arrow"></b>
        </li>
        @endpermission

        {{-- Download --}}
        @permission('student-download')
        <li class="{!! request()->is('user-student/download*')?'active':'' !!} hover">
            <a href="{{ route('user-student.download') }}">
                <i class="menu-icon  fa fa-download" aria-hidden="true"></i>
                <span class="menu-text"> Download </span>
            </a>
            <b class="arrow"></b>
        </li>
        @endpermission

        {{-- Examination --}}
        @permission('student-meeting')
        <li class="{!! request()->is('user-student/meeting*')?'active':'' !!} hover">
            <a href="{{ route('user-student.meeting') }}">
                <i class="menu-icon fa fa-video-camera"  aria-hidden="true"></i>
                <span class="menu-text"> Meeting</span>

                <b class="arrow fa fa-angle-down"></b>
            </a>
        </li>
        @endpermission

    </ul><!-- /.nav-list -->
</div>
