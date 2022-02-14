@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    <link href="https://fonts.googleapis.com/css?family=Lobster|Righteous" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fugaz+One|Lobster|Merienda|Righteous" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content " >
        <div class="col-sm-12 align-right hidden-print">
            <a href="#" class="" onclick="window.print();">
                <i class="ace-icon fa fa-print bigger-200"></i>
            </a>
        </div>
        <div class="main-content-inner">
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="widget-box transparent">
                                    <div class="row">
                                        <div class="col-md-2 col-print-2 align-left">
                                            @if(isset($generalSetting->logo))
                                                <img src="{{ asset('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.'general'.DIRECTORY_SEPARATOR.$generalSetting->logo) }}" width="150px">
                                            @endif
                                        </div>
                                        <div class="col-md-10 col-print-10 align-right">
                                            <div class="text-center">
                                                <h2 class="no-margin-top" style="font-family: 'Merienda', cursive; font-size: 30px">
                                                    <strong>{{$generalSetting->institute}}</strong>
                                                </h2>
                                                <h3 class="text-uppercase no-margin-top">Department of Examination</h3>
                                                <h5 class="no-margin-top">
                                                    {{$generalSetting->address}}, {{$generalSetting->phone}}
                                                </h5>

                                                <h2 class="no-margin text-uppercase" style="font-family: 'Righteous', cursive;">
                                                    <strong>Exam Mark Ledger Report</strong>
                                                </h2>
                                                <h3 class="no-margin-top">for</h3>
                                                <h3 class="no-margin no-margin-top" style="font-family: 'Righteous', cursive;">
                                                    <strong> {{ ViewHelper::getExamById($data['exam']) }} - {{ ViewHelper::getYearById($data['year']) }}</strong>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    @if($data['student'] && $data['student']->count() > 0)
                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>S.N.</th>
                                                        <th>Faculty/Class</th>
                                                        <th>Sem./Sec.</th>
                                                        <th>Reg.Number</th>
                                                        <th>Student Name</th>
                                                        @foreach($data['student'][0]->subjects as $subject)
                                                            @if($subject->full_mark_theory > 0 && $subject->full_mark_practical >0)
                                                                <th colspan="2" class="text-center">
                                                                    {{ViewHelper::getSubjectById($subject->subjects_id)}}
                                                                    <br>
                                                                    TH | PR
                                                                </th>
                                                            @else
                                                                <th>
                                                                    {{ViewHelper::getSubjectById($subject->subjects_id)}}
                                                                    <br>
                                                                    TH
                                                                </th>
                                                            @endif
                                                        @endforeach
                                                        <th>Total Marks</th>
                                                        <th>Obtain Marks</th>
                                                        <th>%</th>
                                                        <th>Grade</th>
                                                        <th>GPA</th>
                                                        <th>Result</th>
                                                        <th>RankOnPass</th>
                                                        <th>PositionOnTotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php($i=1)
                                                    @foreach($data['student'] as $key => $student)
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{  ViewHelper::getFacultyTitle( $data['faculty'] ) }}</td>
                                                            <td>{{  ViewHelper::getSemesterTitle( $data['semester'] ) }}</td>
                                                            <td>{{ $student->reg_no }}</td>
                                                            <td>{{ $student->first_name.' '.$student->middle_name.' '.$student->last_name }}</td>
                                                            @foreach($student->subjects as $subject)
                                                                @if($subject->full_mark_theory > 0)
                                                                    @if($subject->th_remark == '*')
                                                                        <td style="background:black;color:white">{{$subject->obtain_mark_theory?$subject->obtain_mark_theory.$subject->th_remark:'-'}}</td>
                                                                    @else
                                                                        <td>{{$subject->obtain_mark_theory?$subject->obtain_mark_theory:'-'}}</td>
                                                                    @endif
                                                                @endif

                                                                @if($subject->full_mark_practical >0)
                                                                    @if($subject->pr_remark == '*')
                                                                        <td style="background:black;color:white">{{$subject->obtain_mark_practical?$subject->obtain_mark_practical.$subject->pr_remark:'-'}}</td>
                                                                    @else
                                                                        <td>{{$subject->obtain_mark_practical?$subject->obtain_mark_practical:'-'}}</td>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            <td>{{$student->subjects->sum('full_mark_theory') + $student->subjects->sum('full_mark_practical')}}</td>
                                                            <td>{{$student->total_obtain?$student->total_obtain:'-'}}</td>
                                                            <td>{{number_format((float)$student->percentage, 2, '.', '')}}</td>
                                                            <td>{{$student->final_grade}}</td>
                                                            <td>{{$student->grade_point}}</td>
                                                            <td>
                                                                @php($remark = $student->subjects->pluck('remark')->toArray())
                                                                @php($pr_remark = $student->subjects->pluck('pr_remark')->toArray())
                                                                @if(in_array('*',$remark) || in_array('*',$pr_remark))
                                                                    * Fail
                                                                @else
                                                                    Pass
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if(in_array('*',$remark) || in_array('*',$pr_remark))
                                                                    *
                                                                @else
                                                                    {{ ViewHelper::getStudentRankingInExam($data['year'], $data['month'], $data['exam'],$data['faculty'], $data['semester'], $student->id) }}
                                                                @endif

                                                            </td>
                                                            <td>
                                                                {{$student->Position}}
                                                            </td>
                                                        </tr>
                                                        @php($i++)
                                                    @endforeach
                                                </tbody>
                                        </table>
                                    @endif
                                    <div class="hr hr-8"></div>
                                </div>
                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div>
            </div>
        </div>
    </div><!-- /.main-content -->
@endsection

@section('js')
    <!-- inline scripts related to this page -->
   @include('includes.scripts.print_script')
@endsection