@extends('user-staff.layouts.master')

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
                        Dashboard
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Staff
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                       {{-- @include($view_path.'.includes.buttons')--}}
                        @include('includes.flash_messages')
                        @include('user-staff.dashboard.includes.notice')
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
                                        @include($view_path.'.dashboard.includes.profile')
                                    </div><!-- /#home -->

                                    <div id="documents" class="tab-pane">
                                        @include($view_path.'.dashboard.includes.documents')
                                    </div><!-- /#Documents -->

                                    <div id="notes" class="tab-pane">
                                        @include($view_path.'.dashboard.includes.notes')
                                    </div><!-- /#Notes -->

                                    <div id="login-access" class="tab-pane">
                                        @include($view_path.'.dashboard.includes.login-access')
                                    </div><!-- /#Login Detail -->
                                </div>
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




@endsection