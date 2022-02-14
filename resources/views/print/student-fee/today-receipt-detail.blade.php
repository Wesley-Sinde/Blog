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
                                    <div class="widget-body">
                                        <div class="widget-main padding-24">
                                            <div class="col-sm-12 align-right hidden-print">
                                                <a href="#" class="btn-primary btn-lg" onclick="window.print();">
                                                    <i class="ace-icon fa fa-print"></i> Print
                                                </a>
                                            </div>
                                            @include('print.includes.institution-detail')
                                            <div class="row align-center">
                                                <span class="receipt-copy">DETAIL - RECEIPT</span>
                                            </div>
                                            @include('print.student-fee.includes.studentinfo')
                                            <div>
                                                <table width="100%" class="table-bordered">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th class="center"></th>
                                                        <th></th>
                                                        <th class="center">Head</th>
                                                        <th class="center">Due Date</th>
                                                        <th class="center">Amount</th>
                                                        <th class="center">Date</th>
                                                        <th class="center">Paid</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($data['fee_collection'] && $data['fee_collection']->count() > 0)
                                                        @php($i=1)
                                                        @foreach($data['fee_collection'] as $feeCollection)
                                                            <tr>
                                                                <td class="center">{{ $i }}</td>
                                                                <td>
                                                                    {{ ViewHelper::getSemesterById($feeCollection->feeMasters->semester) }}
                                                                </td>
                                                                <td>
                                                                    {{ ViewHelper::getFeeHeadById($feeCollection->feeMasters->fee_head) }}
                                                                </td>
                                                                <td class="center">
                                                                    {{ \Carbon\Carbon::parse($feeCollection->feeMasters->fee_due_date)->format('Y-m-d') }}
                                                                </td>
                                                                <td class="text-right">
                                                                    {{ $feeCollection->feeMasters->fee_amount }}
                                                                </td>

                                                                <td class="center"> {{ \Carbon\Carbon::parse($feeCollection->date)->format('Y-m-d') }}</td>

                                                                <td class="text-right">
                                                                    {{ $feeCollection->paid_amount }}
                                                                </td>
                                                            </tr>
                                                            @php($i++)
                                                        @endforeach
                                                        @php($paid = $data['fee_collection']->sum('paid_amount'))
                                                    @endif
                                                    <tr colspan="8"></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="hr hr8 hr-dotted"></div>
                                            <div class="row text-uppercase">
                                                <div class="col-sm-5 pull-right align-right">
                                                    <strong>Total :</strong>{{isset($paid)?$paid:0}}/-
                                                </div>
                                                <div class="col-sm-7 pull-left">
                                                    <strong> In Word:</strong> {{ ViewHelper::convertNumberToWord(isset($paid)?$paid:0) }}only.
                                                </div>
                                            </div>
                                            <hr class="hr">
                                            @if($data['total_due'] > 0)
                                            <div class="row text-uppercase">
                                                <div class="col-sm-5 pull-right align-right">
                                                    <strong>Total Balance :</strong>{{$data['total_due']}}/-
                                                </div>
                                                <div class="col-sm-7 pull-left">
                                                    <strong>Balance In Word:</strong> {{ ViewHelper::convertNumberToWord($data['total_due']) }}only.
                                                </div>
                                            </div>
                                            @endif
                                            <div class="hr hr-4 hr-dotted"></div>
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