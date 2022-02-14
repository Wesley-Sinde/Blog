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
                    <div class="col-xs-12 ">
                    @include('certificate.includes.buttons')
                    @include($view_path.'.includes.buttons')
                    @include('includes.flash_messages')
                    <!-- PAGE CONTENT BEGINS -->
                        @include('includes.validation_error_messages')
                        <table id="" class="table table-striped table-bordered table-hover">
                            <tbody>
                            @if (isset($data['student']) && $data['student']->count() > 0)
                                @php($i=1)
                                @foreach($data['student'] as $student)
                                    <tr>
                                        <td colspan="2" class="text-right hidden-print">

                                            <a href="{{ route($base_route.'.print', ['id' => encrypt($student->id)]) }}" class="btn btn-primary btn-minier" target="_blank">
                                                <i class="ace-icon fa fa-print bigger-130"></i> Print Certificate
                                            </a>
                                            <a href="#" onclick="window.print();" class="btn btn-primary btn-minier" target="_blank">
                                                <i class="ace-icon fa fa-print bigger-130"></i> Print View Report
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Faculty/Class</th>
                                        <td> {{  ViewHelper::getFacultyTitle( $student->faculty ) }}</td>
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
                                        <th>Issue Date</th>
                                        <td>{{ \Carbon\Carbon::parse($student->date_of_issue)->format('d-M-Y')}} </td>
                                    </tr>
                                    <tr>
                                        <th>Period</th>
                                        <td>{{$student->period}}</td>
                                    </tr>
                                    <tr>
                                        <th>Character</th>
                                        <td>{{$student->character}}</td>
                                    </tr>
                                    <tr>
                                        <th>REF TEXT</th>
                                        <td>
                                            @if($student->ref_text)
                                                @php($refText = json_decode($student->ref_text))
                                                <table class="table table-striped table-bordered table-hover">
                                                    @foreach($refText as $key => $value)
                                                        <tr>
                                                            <td class="text-uppercase" width="20%" style="font-weight: 600">{{str_replace('_',' ',$key)}}</td>
                                                            <td>{{$value}}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>History</th>
                                        <td>
                                            @php($history = $student->certificateHistory->where('certificate','bonafide')->where('certificate_id',$student->certificate_id))
                                            @if (isset($history) && $history->count() > 0)
                                                @foreach($history as $key => $hist)
                                                    <div class="table-header text-capitalize">
                                                        {{ $hist->history_type }}-{{ $hist->created_at }}
                                                    </div>
                                                    @if($hist->ref_text)
                                                        @php($refText = json_decode($hist->ref_text))
                                                        <table class="table table-striped table-bordered table-hover">
                                                            @foreach($refText as $key => $value)
                                                                <tr>
                                                                    <td class="text-uppercase" style="font-weight: 600">{{str_replace('_',' ',$key)}}</td>
                                                                    <td>{{$value}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">No {{ $panel }} data found. Please Filter {{ $panel }} to show. </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div><!-- /.page-content -->
    </div>
    </div><!-- /.main-content -->
@endsection


@section('js')


@endsection