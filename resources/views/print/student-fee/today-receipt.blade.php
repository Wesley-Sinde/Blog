@extends('layouts.master')

@section('css')
    @include('print.includes.print-layout')
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="widget-box transparent">
                                    <div class="col-sm-12 align-right hidden-print">
                                        <a href="#" class="btn-primary btn-lg" onclick="window.print();">
                                            <i class="ace-icon fa fa-print"></i> Print
                                        </a>
                                    </div>
                                    @include('print.includes.institution-detail')
                                    <div class="row">
                                        <table>
                                            <tr>
                                                <td width="10%" rowspan="4">
                                                    @if($data['student']->reg_no != '')
                                                        @php($amount =isset($data['student']->paid_amount)?$data['student']->paid_amount:0)
                                                        @php($name = $data['student']->first_name.' '.$data['student']->middle_name.' '.$data['student']->last_name)
                                                        @php($regNo = $data['student']->reg_no)
                                                        @php($date = \Carbon\Carbon::parse(now())->format('Y-m-d'))
                                                        {!! QrCode::size(200)->generate('Name:'.$name.', Reg.No:'.$regNo.', Date'.$date.', Amount:'.$amount); !!}
                                                    @else
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="row align-center">
                                                        <span class="receipt-copy"> RECEIPT</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @include('print.student-fee.includes.studentinfo')
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="100%" class="table-bordered">
                                                        <thead>
                                                        <tr class="text-center">
                                                            <th class="center">Description</th>
                                                            <th class="center">Amount</th>
                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                        @if(isset($data['student']->paid_amount) && $data['student']->paid_amount >0)
                                                            <tr>
                                                                <td>
                                                                    Amount Received On {{ \Carbon\Carbon::parse(now())->format('Y-m-d')}}
                                                                </td>

                                                                <td class="text-right">
                                                                    {{ number_format($data['student']->paid_amount, 2) }}/-
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-uppercase" colspan="2">
                                                                    Amount In Word:<strong> {{ ViewHelper::convertNumberToWord(isset($data['student']->paid_amount)?$data['student']->paid_amount:0) }}only.</strong>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        @include('print.student-fee.includes.print-footer')
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="space-10"></div>
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