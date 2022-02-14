@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
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
                    <div class="col-xs-12 ">
                    @include($view_path.'.includes.buttons')
                    @include('includes.flash_messages')
                    @include('includes.validation_error_messages')
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
                                                <i class="orange ace-icon fa fa-files-o bigger-140"></i>
                                                Document
                                            </a>
                                        </li>

                                        <li>
                                            <a data-toggle="tab" href="#notes">
                                                <i class="red ace-icon fa fa-sticky-note-o bigger-140"></i>
                                                Notes
                                            </a>
                                        </li>

                                        @ability('super-admin', 'user-add')
                                        {{--<li>
                                            <a data-toggle="tab" href="#login-access">
                                                <i class="red ace-icon fa fa-key bigger-140"></i>
                                                Login Access
                                            </a>
                                        </li>--}}
                                        @endability

                                    </ul>

                                    <div class="tab-content no-border padding-24">
                                        <div id="profile" class="tab-pane in active">
                                           @include($view_path.'.detail.includes.profile')

                                           @include($view_path.'.detail.includes.transaction')
                                        </div><!-- /#home -->

                                        <div id="documents" class="tab-pane">
                                            @include($view_path.'.detail.includes.documents')
                                        </div><!-- /#Documents -->

                                        <div id="notes" class="tab-pane">
                                            @include($view_path.'.detail.includes.notes')
                                        </div><!-- /#Notes -->

                                        @ability('super-admin', 'user-add')
                                       {{-- <div id="login-access" class="tab-pane">
                                            @include($view_path.'.detail.includes.login-access')
                                        </div><!-- /#Login Detail -->--}}
                                        @endability


                                    </div>
                            </div>

                        </div>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    </div>
@endsection

@section('js')
    <!-- inline scripts related to this page -->
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.datepicker_script')

@endsection