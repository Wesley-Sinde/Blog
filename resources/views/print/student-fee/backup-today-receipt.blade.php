@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    @include('print.student-fee.includes.receipt-css')
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="widget-box transparent">
                                    @include('print.student-fee.includes.print-header')
                                    <div class="widget-body">
                                        <div class="widget-main padding-24">
                                            <div class="print-info">
                                                <table class="">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            @include('print.student-fee.includes.studentinfo')
                                                        </td>
                                                        <td class="text-right">
                                                            {!! isset($generalSetting->print_header)?$generalSetting->print_header:'-' !!}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="space"></div>
                                            <div class="row align-center">
                                                <span class="receipt-copy"> RECEIPT </span>
                                            </div>
                                            <div class="space"></div>

                                            <div>
                                                <table class="table table-striped table-bordered no-margin-bottom">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th>Description</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @if(isset($data['student']->paid_amount) && $data['student']->paid_amount >0)
                                                        <tr>
                                                            <td>
                                                                Amount Received On {{ \Carbon\Carbon::parse(now())->format('Y-m-d')}}
                                                            </td>

                                                            <td>
                                                                {{ number_format($data['student']->paid_amount, 2) }}/-
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="hr hr-4 "></div>
                                            <div class="row text-uppercase">
                                                <div class="col-sm-5 pull-right align-right">
                                                    Total :<strong>{{isset($data['student']->paid_amount)?$data['student']->paid_amount:0}}/-</strong>
                                                </div>
                                                <div class="col-sm-7 pull-left">
                                                    In Word:<strong> {{ ViewHelper::convertNumberToWord(isset($data['student']->paid_amount)?$data['student']->paid_amount:0) }}only.</strong>
                                                </div>
                                            </div>
                                            @if($data['total_due'] > 0)
                                                <hr class="hr">
                                                <div class="row text-uppercase">
                                                    <div class="col-sm-5 pull-right align-right">
                                                        Total Balance :<strong>{{$data['total_due']}}/-</strong>
                                                    </div>
                                                    <div class="col-sm-7 pull-left">
                                                        Balance In Word:<strong>{{ ViewHelper::convertNumberToWord($data['total_due']) }}only.</strong>
                                                    </div>
                                                </div>
                                                <div class="hr hr-2"></div>
                                            @endif
                                            @include('print.student-fee.includes.print-footer')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="space-10"></div>
                        <hr class="hr-dotted hr-32">
                        <div class="space-20"></div>
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="widget-box transparent">
                                    <div class="widget-header widget-header-large">
                                        <h3 class="widget-title grey lighter no-margin-bottom">
                                            <i class="ace-icon fa fa-calculator green"></i> Collection Invoice -{{ \Carbon\Carbon::parse(now())->format('Y-m-d')}}
                                        </h3>

                                        <div class="widget-toolbar no-border invoice-info">
                                            <span class="invoice-info-label">User:</span>
                                            <span class="red">{{isset(auth()->user()->name)?auth()->user()->name:""}}</span>

                                            <br/>
                                            <span class="invoice-info-label">Date:</span>
                                            <span class="blue">{{ \Carbon\Carbon::parse(now())->format('Y-m-d')}}</span>
                                        </div>

                                        <div class="widget-toolbar hidden-480">
                                            <a href="#" onclick="window.print()">
                                                <i class="ace-icon fa fa-print bigger-180"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main padding-24">
                                            <div class="print-info">
                                                <table class="">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            @include('print.student-fee.includes.studentinfo')
                                                        </td>
                                                        <td class="text-right">
                                                            {!! isset($generalSetting->print_header)?$generalSetting->print_header:'-' !!}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="space"></div>
                                            <div class="row align-center">
                                                <span class="receipt-copy"> RECEIPT </span>
                                            </div>
                                            <div class="space"></div>

                                            <div>
                                                <table class="table table-striped table-bordered no-margin-bottom">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th>Description</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @if(isset($data['student']->paid_amount) && $data['student']->paid_amount >0)
                                                        <tr>
                                                            <td>
                                                                Amount Received On {{ \Carbon\Carbon::parse(now())->format('Y-m-d')}}
                                                            </td>

                                                            <td>
                                                                {{ number_format($data['student']->paid_amount, 2) }}/-
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="hr hr-4 "></div>
                                            <div class="row text-uppercase">
                                                <div class="col-sm-5 pull-right align-right">
                                                    Total :<strong>{{isset($data['student']->paid_amount)?$data['student']->paid_amount:0}}/-</strong>
                                                </div>
                                                <div class="col-sm-7 pull-left">
                                                    In Word:<strong> {{ ViewHelper::convertNumberToWord(isset($data['student']->paid_amount)?$data['student']->paid_amount:0) }}only.</strong>
                                                </div>
                                            </div>
                                            @if($data['total_due'] > 0)
                                                <hr class="hr">
                                                <div class="row text-uppercase">
                                                    <div class="col-sm-5 pull-right align-right">
                                                        Total Balance :<strong>{{$data['total_due']}}/-</strong>
                                                    </div>
                                                    <div class="col-sm-7 pull-left">
                                                        Balance In Word:<strong>{{ ViewHelper::convertNumberToWord($data['total_due']) }}only.</strong>
                                                    </div>
                                                </div>
                                                <div class="hr hr-2"></div>
                                            @endif
                                            @include('print.student-fee.includes.print-footer')
                                        </div>
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
   @include('includes.scripts.print_script')
@endsection