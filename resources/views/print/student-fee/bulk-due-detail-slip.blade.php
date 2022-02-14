@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    @include('print.student-fee.includes.receipt-css')
@endsection

@section('content')
    @if($data['student'] && $data['student']->count() > 0 )
        @foreach($data['student'] as $student)
            <div class="main-content" >
                <div class="main-content-inner">
                    <div class="page-content">
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
                                                        @include('print.student-fee.includes.institution-detail')
                                                        <hr class="hr hr-2">
                                                        <div class="row align-center">
                                                            <span class="receipt-copy">DUE DETAIL - SLIP</span>
                                                        </div>
                                                        <hr class="hr hr-2">
                                                        <table class="tab-content">
                                                            <tr>
                                                                <td class="text-right">Name</td>
                                                                <td> : </td>
                                                                <th>{{ $student->first_name.' '.$student->middle_name.' '.$student->last_name }}</th>

                                                                <td class="text-right">Reg No.</td>
                                                                <td> : </td>
                                                                <th>{{ $student->reg_no }}</th>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="6">
                                                                    <hr class="hr hr-2">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right">Faculty/Class</td>
                                                                <td> : </td>
                                                                <th>{{ ViewHelper::getFacultyTitle($student->faculty) }}</th>
                                                                <td class="text-right">Sem./Sec.</td>
                                                                <td> : </td>
                                                                <th>{{ ViewHelper::getSemesterTitle($student->semester) }}</th>
                                                            </tr>
                                                        </table>

                                                        <div>
                                                            <table class="table table-striped table-bordered no-margin-bottom">
                                                                <thead>
                                                                    <tr class="text-center">
                                                                        <th class="center"></th>
                                                                        <th></th>
                                                                        <th>Head</th>
                                                                        <th>Due Date</th>
                                                                        <th>Amount</th>
                                                                        <th>Di</th>
                                                                        <th>Fi</th>
                                                                        <th>Paid</th>
                                                                        <th>Due</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    @php($i=1)
                                                                        @foreach($student->master as $feeMaster)
                                                                            @if(isset($feeMaster->due) && $feeMaster->due >0)
                                                                                <tr>
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
                                                                                    <td>
                                                                                        {{ $feeMaster->fee_amount?$feeMaster->fee_amount:'-' }}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ $feeMaster->discount?$feeMaster->discount:'-' }}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ $feeMaster->fine?$feeMaster->fine:'-' }}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ $feeMaster->paid_amount?$feeMaster->paid_amount:'-' }}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ $feeMaster->due?$feeMaster->due:'-'  }}
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                            @php($i++)
                                                                        @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="hr hr8 hr-dotted"></div>


                                                        <div class="row text-uppercase">
                                                            <div class="col-sm-5 pull-right align-right">
                                                                Total Balance :<strong>{{$student->balance}}/-</strong>
                                                            </div>
                                                            <div class="col-sm-7 pull-left">
                                                                Balance In Word:<strong> {{ ViewHelper::convertNumberToWord($student->balance) }}only.</strong>
                                                            </div>
                                                        </div>
                                                        <div class="hr hr8 hr-dotted"></div>


                                                        <div class="space-6"></div>
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
            <div style="page-break-after:always;"></div>
        @endforeach
    @endif
@endsection


@section('js')
    <!-- inline scripts related to this page -->
   @include('includes.scripts.print_script')
@endsection