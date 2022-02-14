<div class="tabbable">
    <ul class="nav nav-tabs  padding-18 hidden-print ">
        <li class="active">
            <a data-toggle="tab" href="#regular-attendance">
                <i class="green ace-icon fa fa-calendar bigger-140"></i>
                Regular Attendance
            </a>
        </li>

        <li>
            <a data-toggle="tab" href="#subject-attendance">
                <i class="blue ace-icon fa fa-calendar bigger-140"></i>
                Subject Wise Attendance
            </a>
        </li>

    </ul>

    <div class="tab-content no-border padding-24">
        <div id="regular-attendance" class="tab-pane in active">
            @include($view_path.'.detail.includes.attendance.regular-attendance')
        </div><!-- /#home -->

        <div id="subject-attendance" class="tab-pane">
            @include($view_path.'.detail.includes.attendance.subject-attendance')
        </div><!-- /#attendance -->
    </div>
</div>