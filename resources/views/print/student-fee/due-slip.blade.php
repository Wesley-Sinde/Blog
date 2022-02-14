@extends('layouts.master')

@section('css')
    @include('print.includes.print-layout')
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="space-6"></div>
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="widget-box transparent">
                                    <div class="col-sm-12 align-right hidden-print">
                                        <a href="#" class="btn-primary btn-lg" onclick="window.print();">
                                            <i class="ace-icon fa fa-print"></i> Print
                                        </a>
                                    </div>
                                    @include('print.includes.institution-detail')
                                    <div class="row align-center">
                                        <span class="receipt-copy">DUE - SLIP</span>
                                    </div>
                                    @include('print.student-fee.includes.studentinfo')
                                    <div>
                                        <table width="100%" class="table-bordered">
                                            <thead>
                                                <tr class="text-center">
                                                    <th class="center">Description</th>
                                                    <th class="center">Amount</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                 @if(isset($data['student']->balance) && $data['student']->balance >0)
                                                    <tr>
                                                        <td>
                                                            Due Amount on {{ \Carbon\Carbon::parse(now())->format('Y-m-d')}}
                                                        </td>

                                                        <td class="text-right">
                                                            {{ number_format($data['student']->balance, 2) }}/-
                                                        </td>
                                                    </tr>
                                                 @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="hr hr8 hr-dotted"></div>


                                    <div class="row text-uppercase">
                                        <div class="col-sm-12 pull-left">
                                            Balance In Word:<strong> {{ ViewHelper::convertNumberToWord($data['student']->balance) }}only.</strong>
                                        </div>
                                    </div>
                                    <div class="hr hr-4 hr-dotted"></div>
                                    @include('print.student-fee.includes.print-footer')

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