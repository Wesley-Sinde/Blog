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
                                                <span class="receipt-copy text-uppercase">Statement of Student Fee Ledger</span>
                                            </div>
                                            @include('print.student-fee.includes.studentinfo')
                                            <div>
                                                <table width="100%" class="table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="center"></th>
                                                            <th></th>
                                                            <th class="center">Head</th>
                                                            <th class="center">Due On</th>
                                                            <th class="center">Amount</th>
                                                            <th class="center">Date</th>
                                                            <th class="center">Di</th>
                                                            <th class="center">Fi</th>
                                                            <th class="center">Paid</th>
                                                            <th class="center">Balance</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                    {{--{{$data['student']->feeMaster}}--}}
                                                        @if($data['student']->feeMaster && $data['student']->feeMaster->count() > 0)
                                                            @php($i=1)
                                                            @foreach($data['student']->feeMaster as $feeMaster)
                                                                <tr >
                                                                    <td class="center">{{ $i }}</td>
                                                                    <td>
                                                                        {{ ViewHelper::getSemesterById($feeMaster->semester) }}
                                                                    </td>
                                                                    <td>
                                                                        {{ ViewHelper::getFeeHeadById($feeMaster->fee_head) }}
                                                                    </td>
                                                                    <td>
                                                                        {{ \Carbon\Carbon::parse($feeMaster->fee_due_date)->format('Y-m-d') }}
                                                                    </td>
                                                                    <td class="text-right">
                                                                        {{ $amount = $feeMaster->fee_amount?$feeMaster->fee_amount:'' }}
                                                                    </td>
                                                                    <td></td>
                                                                    <td class="text-right">
                                                                        @php($fmDiscount = $feeMaster->feeCollect()->sum('discount'))
                                                                        {{($fmDiscount >0)?$fmDiscount:''}}
                                                                    </td>
                                                                    <td class="text-right">
                                                                        @php($fmFine = $feeMaster->feeCollect()->sum('fine'))
                                                                        {{($fmFine >0)?$fmFine:''}}
                                                                    </td>
                                                                    <td class="text-right">
                                                                        @php($paid = $feeMaster->feeCollect->sum('paid_amount'))
                                                                        {{ $paid?$paid:'' }}
                                                                    </td>
                                                                    <td class="text-right">
                                                                        @php($balance = ($feeMaster->fee_amount + $fmFine) - ($paid + $fmDiscount))
                                                                        {{ $balance?$balance:'PAID' }}
                                                                    </td>
                                                                </tr>
                                                                @if($feeMaster->feeCollect )
                                                                    @foreach($feeMaster->feeCollect as $feeCollection)
                                                                        <tr>
                                                                            <td colspan="5"></td>
                                                                            <td class="center"> {{ \Carbon\Carbon::parse($feeCollection->date)->format('Y-m-d')}}</td>
                                                                            <td class="text-right"> {{ $feeCollection->discount?$feeCollection->discount:'' }}</td>
                                                                            <td class="text-right"> {{ $feeCollection->fine?$feeCollection->fine:"" }}</td>
                                                                            <td class="text-right"> {{ $feeCollection->paid_amount?$feeCollection->paid_amount:'' }}</td>
                                                                            <td> </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                                @php($i++)
                                                            @endforeach
                                                            <tr style="font-weight: bold; background: orangered;color: white;">
                                                                <td colspan="4" class="text-right">Total</td>
                                                                <td class="text-right">{{ $data['student']->fee_amount?$data['student']->fee_amount:'' }}</td>
                                                                <td></td>
                                                                <td>{{ $data['student']->discount?$data['student']->discount:'' }}</td>
                                                                <td>{{ $data['student']->fine?$data['student']->fine:'' }}</td>
                                                                <td>{{ $data['student']->paid_amount?$data['student']->paid_amount:'' }}</td>
                                                                <td>
                                                                    {{ $data['student']->balance?$data['student']->balance:'' }}
                                                                </td>

                                                            </tr>
                                                        @else
                                                            <tr colspan="8"></tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="hr hr8 hr-dotted"></div>

                                            <div class="row text-uppercase">
                                                <div class="col-sm-5 pull-right align-right">
                                                    Total :<strong>{{$data['student']->paid_amount}}/-</strong>
                                                </div>
                                                <div class="col-sm-7 pull-left">
                                                   In Word:<strong> {{ ViewHelper::convertNumberToWord($data['student']->paid_amount) }}only.</strong>
                                                </div>
                                            </div>
                                            <div class="hr hr8 hr-double"></div>
                                            <div class="row text-uppercase">
                                                <div class="col-sm-5 pull-right align-right">
                                                   Total Balance :<strong>{{$data['student']->balance }}/-</strong>
                                                </div>
                                                <div class="col-sm-7 pull-left">
                                                    Balance In Word:<strong> {{ ViewHelper::convertNumberToWord($data['student']->balance ) }}only.</strong>
                                                </div>
                                            </div>
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