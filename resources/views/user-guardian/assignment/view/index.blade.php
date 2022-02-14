@extends('user-guardian.layouts.master')

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
                        Assignment
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            View
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                    <!-- PAGE CONTENT BEGINS -->
                        @include('user-guardian.includes.buttons')
                        @include('includes.flash_messages')
                        <div class="space-10"></div>
                        <div class="col-md-12">
                            <div class="row">
                                @include('user-guardian.includes.student-detail')
                            </div><!-- /.row -->
                            <div class="space-10"></div>
                            <div class="form-horizontal">
                                <h4 class="header large lighter blue"><i class="fa fa-question" aria-hidden="true"></i>&nbsp;Question</h4>
                                @include($view_path.'.assignment.view.includes.preview-question')
                                <div class="hr hr-18 dotted hr-double"></div>
                                <h4 class="header large lighter blue"><i class="fa fa-reply" aria-hidden="true"></i>&nbsp;Answer</h4>
                                @include($view_path.'.assignment.view.includes.preview-answer')
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    <!-- inline scripts related to this page -->
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')

    @endsection