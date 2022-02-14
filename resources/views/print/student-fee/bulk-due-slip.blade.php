@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    @include('print.student-fee.includes.receipt-css')
@endsection

@section('content')
    @if($data['student'] && $data['student']->count() > 0 )
        @foreach($data['student'] as $student)
            <div class="main-content">
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
                                                        <span class="receipt-copy">DUE - SLIP</span>
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
                                                                <th>Description</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        Due Amount On {{ \Carbon\Carbon::parse(now())->format('Y-m-d')}}
                                                                    </td>

                                                                    <td>
                                                                        {{ number_format($student->balance, 2) }}/-
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" class="text-uppercase">
                                                                        Balance In Word:<strong> {{ ViewHelper::convertNumberToWord($student->balance) }}only.</strong>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
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
        @endforeach
    @endif
@endsection


@section('js')
    <!-- inline scripts related to this page -->
   @include('includes.scripts.print_script')
@endsection