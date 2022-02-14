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
                                    @include('print.student-fee.includes.print-header')

                                    <div class="widget-body">
                                        <div class="widget-main padding-24">
                                            @include('print.includes.institution-detail')
                                            <div class="row">
                                                <table>
                                                    <tr>
                                                        <td width="10%" rowspan="4">
                                                            @if($data['student']->reg_no != '')
                                                                @php($amount =isset($data['student']->paid_amount)?$data['student']->paid_amount:0)
                                                                @php($name = $data['student']->first_name.' '.$data['student']->middle_name.' '.$data['student']->last_name)
                                                                @php($regNo = $data['student']->reg_no)
                                                                @php($date = \Carbon\Carbon::parse($data['student']->paid_date)->format('Y-m-d'))
                                                                {!! QrCode::size(200)->generate('Name:'.$name.', Reg.No:'.$regNo.', Date:'.$date.', Amount:'.$amount); !!}
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
                                                                            Amount Received On {{ \Carbon\Carbon::parse($data['student']->paid_date)->format('Y-m-d')}}
                                                                        </td>

                                                                        <td>
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
                            </div>
                        </div>
                        {{--<div class="space-10"></div>
                        <hr class="hr-dotted hr-32">
                        <div class="space-20"></div>
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="widget-box transparent">
                                    @include('print.student-fee.includes.print-header')

                                    <div class="widget-body">
                                        <div class="widget-main padding-24">
                                            @include('print.student-fee.includes.institution-detail')
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
                                                            <hr class="hr hr-2">
                                                            <div class="row align-center">
                                                                <span class="receipt-copy"> RECEIPT</span>
                                                            </div>
                                                            <hr class="hr hr-2">
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            @include('print.student-fee.includes.studentinfo')
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
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
                            </div>
                        </div>--}}
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