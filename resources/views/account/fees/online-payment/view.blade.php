@extends('layouts.master')

@section('css')
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header">
                    <h1>
                        @include($view_path.'.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            View
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('account.includes.buttons')
                    <div class="col-xs-12 ">
                    @include('account.fees.includes.buttons')
                    @include('includes.flash_messages')
                    <!-- PAGE CONTENT BEGINS -->
                        @include('includes.validation_error_messages')
                        <table id="dynamic-table-1" class="table table-striped table-bordered table-hover" style="width:100%;table-layout:fixed; ">
                            <tbody>
                                @if (isset($data['student']) && $data['student']->count() > 0)
                                    @php($i=1)
                                    @foreach($data['student'] as $student)
                                        <tr>
                                            <td colspan="2" class="text-right hidden-print">
                                                @if($student->payment_status == 0)
                                                    <span class="label label-danger">Not Verify</span>
                                                    {{--<div class="btn btn-primary btn-minier action-buttons">
                                                        <a class="white" href="{{ route('account.fees.online-payment.verify', ['id' => encrypt($student->payment_id)]) }}">
                                                            <i class="ace-icon fa fa-check bigger-130"></i>&nbsp;Verify
                                                        </a>
                                                    </div>--}}
                                                    <button type="button" class="btn btn-xs btn-primary open-AddFeeDialog" data-toggle="modal"
                                                            data-target="#feeCollectionModal"
                                                            data-students-id="{{ encrypt($student->id) }}"
                                                            data-id="{{ encrypt($student->payment_id) }}"
                                                            data-date="{{ \Carbon\Carbon::parse($student->date)->format('Y-m-d') }}"
                                                            data-amount="{{ $student->amount }}"
                                                            data-gateway="{{ $student->payment_gateway }}">
                                                            <i class="ace-icon fa fa-check bigger-130"></i>&nbsp;Verify
                                                    </button>
                                                @else
                                                    <span class="label label-success">Verified</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th width="20%">Faculty/Class</th>
                                            <td width="80%"> {{  ViewHelper::getFacultyTitle( $student->faculty ) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Sem./Sec.</th>
                                            <td> {{  ViewHelper::getSemesterTitle( $student->semester ) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Reg.Num</th>
                                            <td><a href="{{ route('student.view', ['id' => $student->id]) }}" target="_blank">{{ $student->reg_no }}</a></td>
                                        </tr>
                                        <tr>
                                            <th>Student Name</th>
                                            <td><a href="{{ route('student.view', ['id' => $student->id]) }}" target="_blank"> {{ $student->first_name.' '.$student->middle_name.' '. $student->last_name }}</a></td>
                                        </tr>
                                        <tr>
                                            <th>Payment Date</th>
                                            <td>{{ \Carbon\Carbon::parse($student->date)->format('Y-m-d')}} </td>
                                        </tr>

                                        <tr>
                                            <th>Amount</th>
                                            <td>{{ $student->amount }} </td>
                                        </tr>

                                        <tr>
                                            <th>Gateway</th>
                                            <td>{{ $student->payment_gateway }} </td>
                                        </tr>
                                        <tr>
                                            <th>Paid BY</th>
                                            <td> {{ ViewHelper::getUserNameId($student->paid_by) }} </td>
                                        </tr>

                                        <tr>
                                            <th>REF TEXT</th>
                                            <td style="overflow: scroll; text-overflow: ellipsis">
                                                {{$student->ref_no}}
                                                <hr>
                                                @if($student->ref_text)
                                                    <span >
                                                        {{$student->ref_text}}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Note</th>
                                            <td>{{ $student->note}} </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2">No {{ $panel }} data found. </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        @include($view_path.'.includes.add_model')
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div><!-- /.page-content -->
    </div>
    </div><!-- /.main-content -->
@endsection


@section('js')
    @include('includes.scripts.datepicker_script')
    @include('includes.scripts.inputMask_script')
    @include($view_path.'.includes.modal_values_script')
@endsection