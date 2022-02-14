@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header">
                    <h1>
                        @include($view_path.'.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Detail
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                    @include($view_path.'.includes.buttons')
                    @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="space-2"></div>

                        <div id="user-profile-2" class="user-profile">
                            <div class="tabbable  ">
                                <ul class="nav nav-tabs  padding-18 hidden-print ">
                                    <li class="active">
                                        <a data-toggle="tab" href="#profile">
                                            <i class="green ace-icon fa fa-user bigger-140"></i>
                                            Profile
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#ledger">
                                            <i class="orange ace-icon fa fa-newspaper-o bigger-140"></i>
                                            Ledger
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#payroll">
                                            <i class="orange ace-icon fa fa-calculator bigger-140"></i>
                                            Payroll
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#library">
                                            <i class="purple ace-icon fa fa-book bigger-140"></i>
                                            Library
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#attendance">
                                            <i class="blue ace-icon fa fa-calendar bigger-140"></i>
                                            Attendance
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#hostel">
                                            <i class="blue ace-icon fa fa-bed bigger-140"></i>
                                            Hostel
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#transport">
                                            <i class="blue ace-icon fa fa-car bigger-140"></i>
                                            Transport
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#documents">
                                            <i class="pink ace-icon fa fa-files-o bigger-140"></i>
                                            Documents
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#notes">
                                            <i class="red ace-icon fa fa-sticky-note-o bigger-140"></i>
                                            Notes
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#login-access">
                                            <i class="red ace-icon fa fa-key bigger-140"></i>
                                            Login Access
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content no-border padding-24">
                                    <div id="profile" class="tab-pane in active">
                                        @include($view_path.'.detail.includes.profile')
                                    </div><!-- /#home -->

                                    <div id="ledger" class="tab-pane">
                                        @include($view_path.'.detail.includes.transaction')
                                    </div><!-- /#home -->

                                    <div id="payroll" class="tab-pane">
                                        @include($view_path.'.detail.includes.payroll')
                                    </div><!-- /#home -->

                                    <div id="library" class="tab-pane">
                                        @include($view_path.'.detail.includes.library')
                                    </div><!-- /#Library -->

                                    <div id="attendance" class="tab-pane">
                                        @include($view_path.'.detail.includes.attendance')
                                    </div><!-- /#attendance -->

                                    <div id="hostel" class="tab-pane">
                                        @include($view_path.'.detail.includes.hostel')
                                    </div><!-- /#Hostel -->


                                    <div id="transport" class="tab-pane">
                                        @include($view_path.'.detail.includes.transport')
                                    </div><!-- /#Transport -->

                                    <div id="documents" class="tab-pane">
                                        @include($view_path.'.detail.includes.documents')
                                    </div><!-- /#Documents -->

                                    <div id="notes" class="tab-pane">
                                        @include($view_path.'.detail.includes.notes')
                                    </div><!-- /#Notes -->

                                    <div id="login-access" class="tab-pane">
                                        @include($view_path.'.detail.includes.login-access')
                                    </div><!-- /#Login Detail -->
                                </div>
                            </div>
                        </div>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection


@section('js')
        <!-- inline scripts related to this page -->
    {{--@include('includes.scripts.dataTable_scripts')--}}
    @include('includes.scripts.datepicker_script')
@endsection