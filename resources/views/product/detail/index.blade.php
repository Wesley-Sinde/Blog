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
                        {{--<div class="row">
                            <div class="col-xs-12 col-sm-12 col-print-12">
                                <div class="center">
                                    <span class="btn btn-app btn-sm btn-light no-hover">
                                        <span class="line-height-1 bigger-170 blue"> {{$data['service']->product->count()}} </span>
                                        <br>
                                        <span class="line-height-1 smaller-90"> Product </span>
                                    </span>
                                    <span class="btn btn-app btn-sm btn-yellow no-hover">
                                        <span class="line-height-1 bigger-170"> {{$data['service']->history->count()}} </span>
                                        <br>
                                        <span class="line-height-1 smaller-90"> History </span>
                                    </span>
                                    <span class="btn btn-app btn-sm btn-pink no-hover">
                                        <span class="line-height-1 bigger-170"> DONE </span>
                                        <br>
                                        <span class="line-height-1 smaller-90"> Projects </span>
                                    </span>
                                                            <span class="btn btn-app btn-sm btn-grey no-hover">
                                        <span class="line-height-1 bigger-170"> 23 </span>
                                        <br>
                                        <span class="line-height-1 smaller-90"> Reviews </span>
                                    </span>
                                                            <span class="btn btn-app btn-sm btn-success no-hover">
                                    <span class="line-height-1 bigger-170"> 7 </span>
                                        <br>
                                        <span class="line-height-1 smaller-90"> Albums </span>
                                    </span>
                                    <span class="btn btn-app btn-sm btn-primary no-hover">
                                        <span class="line-height-1 bigger-170"> 55 </span>
                                        <br>
                                        <span class="line-height-1 smaller-90"> Contacts </span>
                                    </span>
                                </div>
                            </div>
                        </div>--}}

                        <div class="space-2"></div>

                        <div id="user-profile-2" class="user-profile">
                            <div class="tabbable">
                                <ul class="nav nav-tabs  padding-18 hidden-print ">
                                    <li class="active">
                                        <a data-toggle="tab" href="#detail">
                                            <i class="green ace-icon fa fa-cart-plus bigger-140"></i>
                                            Product Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#history">
                                            <i class="red2 ace-icon fa fa-history bigger-140"></i>
                                            History
                                        </a>
                                    </li>

                                </ul>

                                <div class="tab-content no-border padding-24">
                                    <div id="detail" class="tab-pane  in active">
                                       @include($view_path.'.detail.includes.detail')
                                    </div><!-- /#home -->
                                    <div id="history" class="tab-pane">
                                        @include($view_path.'.detail.includes.stock_history')
                                    </div><!-- /#home -->
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
@endsection