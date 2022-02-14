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
                    @include('assignment.includes.buttons')
                    <div class="col-xs-12 ">
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            <h4 class="header large lighter blue"><i class="fa fa-question" aria-hidden="true"></i>&nbsp;Question</h4>
                            @include($view_path.'.answer.includes.preview-question')
                            <div class="hr hr-18 dotted hr-double"></div>
                            <h4 class="header large lighter blue"><i class="fa fa-reply" aria-hidden="true"></i>&nbsp;Answer</h4>
                            @include($view_path.'.answer.includes.preview-answer')
                            <h4 class="header large lighter blue"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Student Detail</h4>
                            @include($view_path.'.answer.includes.student-detail')
                        </div>
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