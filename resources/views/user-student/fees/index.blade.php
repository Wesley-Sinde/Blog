@extends('user-student.layouts.master')

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
                        Fees
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Detail
                        </small>
                    </h1>

                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            <div class="hr hr-4 hr-dotted"></div>
                            <div class="row text-uppercase">
                                <div class="col-sm-5 pull-right align-right">
                                    <label class="label label-info label-lg white">Total Balance : {{ number_format($data['student']->balance, 2) }}/-</label>
                                </div>
                                <div class="col-sm-7 pull-left">
                                    <strong>Balance In Word:</strong> {{ ViewHelper::convertNumberToWord($data['student']->balance) }}only.
                                </div>
                            </div>
                            <div class="hr hr-8 hr-dotted"></div>

                            <div class="tabbable">
                                <ul class="nav nav-tabs  padding-18 hidden-print ">
                                    <li class="active">
                                        <a data-toggle="tab" href="#fees">
                                            <i class="green ace-icon fa fa-calculator bigger-140"></i>
                                            Fees
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#pay-online">
                                            <i class="blue ace-icon fa fa-calculator bigger-140"></i>
                                            Online Payment
                                        </a>
                                    </li>

                                </ul>

                                <div class="tab-content no-border padding-24">
                                    <div id="fees" class="tab-pane in active">
                                        @include($view_path.'.fees.includes.table')
                                    </div><!-- /#home -->

                                    <div id="pay-online" class="tab-pane">
                                         @if($data['student']->balance > 0)
                                            @include($view_path.'.fees.includes.pay-online')
                                            @include($view_path.'.fees.includes.online-payment-table')
                                         @else
                                            <div class="col-sm-5 pull-right align-right">
                                                <label class="label label-info label-lg white"></label>
                                            </div>
                                         @endif
                                    </div><!-- /#onlinepayment -->
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
    <!-- inline scripts related to this page -->
    @include('includes.scripts.dataTable_scripts')
@endsection