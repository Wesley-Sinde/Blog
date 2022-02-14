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
                                    @include('print.student-fee.includes.print-header')

                                    <div class="widget-body">
                                        <div class="widget-main padding-24">

                                            @include('print.includes.institution-detail')
                                            <hr class="hr hr-2">
                                            <div class="row align-center">
                                                <span class="receipt-copy">DETAIL - RECEIPT</span>
                                            </div>
                                            <hr class="hr hr-2">
                                            @include('print.student-fee.includes.studentinfo')
                                            <div>
                                                <table class="table table-striped table-bordered no-margin-bottom">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th class="center"></th>
                                                        <th></th>
                                                        <th>Head</th>
                                                        <th>Due Date</th>
                                                        <th>Amount</th>
                                                        <th>Date</th>
                                                        <th>Fine</th>
                                                        <th>Dis.</th>
                                                        <th>Paid</th>
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
                                                                <td>
                                                                    {{ \Carbon\Carbon::parse($feeCollection->feeMasters->fee_due_date)->format('Y-m-d') }}
                                                                </td>
                                                                <td class="text-right">
                                                                    {{ $feeCollection->feeMasters->fee_amount }}
                                                                </td>

                                                                <td> {{ \Carbon\Carbon::parse($feeCollection->date)->format('Y-m-d') }}</td>

                                                                <td class="text-right"> {{ $feeCollection->fine }} </td>
                                                                <td class="text-right"> {{ $feeCollection->discount }} </td>
                                                                <td class="text-right"> {{ $feeCollection->paid_amount }} </td>
                                                            </tr>
                                                            @php($i++)
                                                        @endforeach
                                                        @php($paid = $data['fee_collection']->sum('paid_amount'))
                                                    @endif
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
                                            <div class="row text-uppercase">
                                                <div class="col-sm-5 pull-right align-right">
                                                    <strong>Total Balance :</strong>{{$data['total_due']}}/-
                                                </div>
                                                <div class="col-sm-7 pull-left">
                                                    <strong>Balance In Word:</strong> {{ ViewHelper::convertNumberToWord($data['total_due']) }}only.
                                                </div>
                                            </div>
                                            <div class="hr hr-4 hr-dotted"></div>
                                            @if(isset($generalSetting->print_footer))
                                                <div class="well well-sm">
                                                    {!! $generalSetting->print_footer !!}
                                                </div>
                                            @endif
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