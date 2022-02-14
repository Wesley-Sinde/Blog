@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
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
                                    <div class="widget-header widget-header-large">
                                        <h3 class="widget-title grey lighter no-margin-bottom">
                                            <i class="ace-icon fa fa-calculator green"></i> Master Invoice -{{$data['fee_master']->id}}
                                        </h3>

                                        <div class="widget-toolbar no-border invoice-info">
                                            <span class="invoice-info-label">User:</span>
                                            <span class="red">{{isset(auth()->user()->name)?auth()->user()->name:""}}</span>

                                            <br />
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
                                                <table class="table  no-border">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <span>Reg No. : </span>{{ $data['student']->reg_no }}
                                                                <hr class="hr-2 no-border">
                                                                <span>Name : </span><strong>{{ $data['student']->first_name.' '.$data['student']->middle_name.' '.$data['student']->last_name }}</strong>
                                                                <hr class="hr-2 no-border">
                                                                <span>Level: </span>{{ ViewHelper::getFacultyTitle($data['student']->faculty) }}
																<hr class="hr-2 no-border">
																{{ ViewHelper::getSemesterTitle($data['student']->semester) }}
                                                            </td>
                                                            <td class="text-right">
                                                                {!! isset($generalSetting->print_header)?$generalSetting->print_header:'-' !!}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="space"></div>

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
                                                            <th>Di</th>
                                                            <th>Fi</th>
                                                            <th>Paid</th>
                                                            <th>Balance</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @if($data['fee_master'])
                                                            @php($i=1)
                                                                <tr>
                                                                    <td class="center">{{ $i }}</td>
                                                                    <td>
                                                                        {{ ViewHelper::getSemesterById($data['fee_master']->semester) }}
                                                                    </td>
                                                                    <td>
                                                                        {{ ViewHelper::getFeeHeadById($data['fee_master']->fee_head) }}
                                                                    </td>
                                                                    <td>
                                                                        {{ \Carbon\Carbon::parse($data['fee_master']->fee_due_date)->format('Y-m-d') }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $amount = $data['fee_master']->fee_amount }}
                                                                    </td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td>
                                                                        {{ $paid = $data['fee_master']->feeCollect->sum('paid_amount') }}
                                                                    </td>
                                                                    <td>
                                                                        @php($balance =  $amount - $paid)
                                                                        {{ $balance > 0?$balance:'-'  }}
                                                                    </td>
                                                                </tr>
                                                                @if($data['fee_master']->feeCollect )
                                                                    @foreach($data['fee_master']->feeCollect as $feeCollection)
                                                                        <tr>
                                                                            <td colspan="5"></td>
                                                                            <td> {{ \Carbon\Carbon::parse($feeCollection->date)->format('Y-m-d')}}</td>

                                                                            <td>{{ $feeCollection->discount?$feeCollection->discount:'-' }}</td>
                                                                            <td>{{ $feeCollection->fine?$feeCollection->fine:"-" }}</td>
                                                                            <td>{{ $feeCollection->paid_amount?$feeCollection->paid_amount:'-' }}</td>
                                                                            <td> </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                        @endif
                                                        <tr colspan="8"></tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="hr hr8 hr-dotted"></div>

                                            <div class="row text-uppercase">
                                                <div class="col-sm-5 pull-right align-right">
                                                    <strong>Total :</strong>{{$paid}}/-
                                                </div>
                                                <div class="col-sm-7 pull-left">
                                                   <strong> In Word:</strong> {{ ViewHelper::convertNumberToWord($paid) }}only.
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