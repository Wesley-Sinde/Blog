@extends('layouts.master')

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
                            top menu &amp; navigation
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="alert alert-info visible-sm visible-xs">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                            </button>
                            Please note that
                            <span class="blue bolder">top menu style</span>
                            is visible only in devices larger than
                            <span class="blue bolder">991px</span>
                            which you can change using CSS builder tool.
                        </div>

                        <div class="well well-sm visible-sm visible-xs">
                            Top menu can become any of the 3 mobile view menu styles:
                            <em>default</em>
                            ,
                            <em>collapsible</em>
                            or
                            <em>minimized</em>.
                        </div>

                        <div class="hidden-sm hidden-xs">
                            <button type="button" class="sidebar-collapse btn btn-white btn-primary" data-target="#sidebar">
                                <i class="ace-icon fa fa-angle-double-up" data-icon1="ace-icon fa fa-angle-double-up" data-icon2="ace-icon fa fa-angle-double-down"></i>
                                Collapse/Expand Menu
                            </button>
                        </div>

                        <div class="center">
                            Student Page
                        </div>

                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection