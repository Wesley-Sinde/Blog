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
                        Assignment
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                             Detail
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-md-12 col-xs-12">
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
                                @include($view_path.'.assignment.includes.table')
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->



@endsection

@section('js')
    <!-- page specific plugin scripts -->
    @include('includes.scripts.dataTable_scripts')
@endsection