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
                       Course
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            List
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

                            @include('user-student.subject.includes.table')
                    </div>
                </div><!-- /.row -->
                </div>
            </div>

            </div><!-- /.page-content -->
    </div><!-- /.main-content -->



@endsection

@section('js')
    @include('includes.scripts.dataTable_scripts')
@endsection