@extends('user-guardian.layouts.master')

@section('css')

@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header">
                    <h1>
                        Attendance
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Detail
                        </small>
                    </h1>

                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                        @include('includes.flash_messages')
                        @include('user-guardian.includes.buttons')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="space-10"></div>
                        <div class="col-md-12">
                            <div class="row">
                                @include('user-guardian.includes.student-detail')
                            </div><!-- /.row -->
                        <div class="space-10"></div>
                        <div class="form-horizontal">
                           {{-- @include($view_path.'.attendance.includes.table')--}}
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
                                        @include($view_path.'.attendance.includes.regular-attendance')
                                    </div><!-- /#home -->

                                    <div id="subject-attendance" class="tab-pane">
                                        @include($view_path.'.attendance.includes.subject-attendance')
                                    </div><!-- /#attendance -->
                                </div>
                            </div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->


            </div>
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection

@section('js')
    @include('includes.scripts.dataTable_scripts')
    @endsection