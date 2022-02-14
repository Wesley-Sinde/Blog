<div class="widget-box transparent" id="recent-box">
    <div class="widget-header">
        <h4 class="widget-title lighter smaller">
            <i class="ace-icon fa fa-gift blue"></i>Up Coming Birthday
        </h4>

        <div class="widget-toolbar no-border">
            <ul class="nav nav-tabs" id="recent-tab">
                <li class="active">
                    <a data-toggle="tab" href="#student-birthday-tab">Student Birthday <span class="badge badge-warning"> {{ $data['student_birthday']->count() }}</span></a>
                </li>

                <li>
                    <a data-toggle="tab" href="#staff-birthday-tab">Staff Birthday <span class="badge badge-warning"> {{ $data['staff_birthday']->count() }}</span></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="widget-body">
        <div class="widget-main padding-4">
            <div class="tab-content padding-8">
                <div id="student-birthday-tab" class="tab-pane active">
                    @include('dashboard.includes.birthday.student')
                </div>

                <div id="staff-birthday-tab" class="tab-pane">
                    @include('dashboard.includes.birthday.staff')
                </div>

            </div>
        </div><!-- /.widget-main -->
    </div><!-- /.widget-body -->
</div><!-- /.widget-box -->