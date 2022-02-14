@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    <link href="https://fonts.googleapis.com/css?family=Fugaz+One|Lobster|Merienda|Righteous|Black+Ops+One|Gilda+Display" rel="stylesheet">
    <style>
        .page-content {
            padding: 20px 22px !important;
            border: 20px #438eb9 solid;
        }
        @media print {
            .main-content {
                width: 210mm;
                height: 297mm;
                adding: 15px 15px 5px 15px !important;
                border: 20px #438eb9 solid;
            }

            .page-content {
                padding: 0;
                border: none;
            }
            /* ... the rest of the rules ... */
        }
    </style>
@endsection

@section('content')
    @if($data['student'] && $data['student']->count() > 0)
        @foreach($data['student'] as $student)
            <div class="main-content" >
                <div class="col-sm-12 align-right hidden-print">
                    <a href="#" class="btn btn-primary" onclick="window.print();">
                        <i class="ace-icon fa fa-print bigger-200"></i> Print
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
                                                        <h2 class="no-margin-top" style="font-family: 'Merienda', cursive; font-size: 24px">
                                                            <strong>{{$generalSetting->institute}}</strong>
                                                        </h2>
                                                        <h4 class="text-uppercase no-margin-top">Department of Examination</h4>

                                                        <div class="space-4"></div>
                                                        <h2 class="no-margin text-uppercase" style="font-family: 'Black Ops One', cursive;font-size: 30px">
                                                            <strong><u>provisional statement</u></strong>
                                                        </h2>
                                                        <h2 class="no-margin text-uppercase" style="font-family: 'Black Ops One', cursive;font-size: 25px">
                                                            <strong><u>of marks</u></strong>
                                                        </h2>
                                                        <h3 class="no-margin-top" style="font-family: 'Righteous', cursive;">for</h3>
                                                        <h3 class="no-margin no-margin-top text-uppercase" style="font-family: 'Black Ops One', cursive;font-size: 25px">
                                                            <strong><u>{{ ViewHelper::getExamById($data['exam']) }} - {{ ViewHelper::getYearById($data['year']) }}</u></strong>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="space-18"></div>
                                            <div class=row">
                                                <div class="profile-user-info profile-user-info-striped">
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Level : </div>
                                                        <div class="profile-info-value">
                                                            <span class="editable" id="faculty">{{  ViewHelper::getFacultyTitle( $data['faculty'] ) }}/{{  ViewHelper::getSemesterTitle( $data['semester'] ) }}</span>
                                                        </div>
                                                        <div class="profile-info-name"> Reg. No.: </div>
                                                        <div class="profile-info-value">
                                                            <span class="editable" id="reg_no"><strong>{{ $student->reg_no }}</strong></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Name : </div>
                                                        <div class="profile-info-value">
                                                            <span class="editable" id="student_name"><strong>{{ $student->first_name.' '.$student->middle_name.' '.$student->last_name }}</strong></span>
                                                        </div>
                                                        <div class="profile-info-name"> Date Of Birth :</div>
                                                        <div class="profile-info-value">
                                                            <span class="editable" id="reg_date">{{ \Carbon\Carbon::parse($student->date_of_birth)->format('Y-m-d')}}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="space-8"></div>
                                            <div class=row">
                                                <table width="100%" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th rowspan="2" class="text-center">SN</th>
                                                            <th rowspan="2" class="text-center">SUBJECT CODE</th>
                                                            <th rowspan="2" class="text-center">SUBJECT TITLE</th>
                                                            <th colspan="2" class="text-center">FULL MARK</th>
                                                            <th colspan="2" class="text-center">PASS MARK</th>
                                                            <th colspan="2" class="text-center">OBTAINED MARK</th>
                                                            <th rowspan="2" class="text-center">TOTAL</th>
                                                            <th rowspan="2" class="text-center">REMARK</th>
                                                        </tr>
                                                        <tr>
                                                            <th>TH</th>
                                                            <th>PR</th>
                                                            <th>TH</th>
                                                            <th>PR</th>
                                                            <th>TH</th>
                                                            <th>PR</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($student->subjects && $student->subjects->count() > 0)
                                                        @php($i=1)
                                                        @foreach($student->subjects as $subject)
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ViewHelper::getSubjectCodeById($subject->subjects_id)}}</td>
                                                                <td>{{ViewHelper::getSubjectById($subject->subjects_id)}}</td>
                                                                <td>{{$subject->full_mark_theory?$subject->full_mark_theory:'-'}}</td>
                                                                <td>{{$subject->full_mark_practical?$subject->full_mark_practical:'-'}}</td>
                                                                <td>{{$subject->pass_mark_theory?$subject->pass_mark_theory:'-'}}</td>
                                                                <td>{{$subject->pass_mark_practical?$subject->pass_mark_practical:'-'}}</td>
                                                                <td>{{$subject->obtain_mark_theory?$subject->obtain_mark_theory.$subject->th_remark:'-'}}</td>
                                                                <td>{{$subject->obtain_mark_practical?$subject->obtain_mark_practical.$subject->pr_remark:'-'}}</td>
                                                                <td>{{$subject->total_obtain_mark?$subject->total_obtain_mark:'-'}}</td>
                                                                <td>{{$subject->remark?$subject->remark:''}}</td>
                                                            </tr>
                                                            @php($i++)
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                    <tfoot style="font-weight: 600">
                                                        <td colspan="3" class="text-right">TOTAL</td>
                                                        <td>{{$student->subjects->sum('full_mark_theory')?$student->subjects->sum('full_mark_theory'):'-'}}</td>
                                                        <td>{{$student->subjects->sum('full_mark_practical')?$student->subjects->sum('full_mark_practical'):'-'}}</td>
                                                        <td>{{$student->subjects->sum('pass_mark_theory')?$student->subjects->sum('pass_mark_theory'):'-'}}</td>
                                                        <td>{{$student->subjects->sum('pass_mark_practical')?$student->subjects->sum('pass_mark_practical'):'-'}}</td>
                                                        <td>{{$student->total_mark_theory?$student->total_mark_theory:'-'}}</td>
                                                        <td>{{$student->total_mark_practical?$student->total_mark_practical:'-'}}</td>
                                                        <td>{{$student->total_obtain?$student->total_obtain:'-'}}</td>
                                                        <td>{{number_format((float)$student->percentage, 2, '.', '').'%'}}
                                                            @php($remark = $student->subjects->pluck('remark')->toArray())
                                                            @php($pr_remark = $student->subjects->pluck('pr_remark')->toArray())
                                                            @if(in_array('*',$remark) || in_array('*',$pr_remark))
                                                                [Fail]
                                                            @else
                                                                [Pass]
                                                            @endif

                                                            @if(in_array('*',$remark) || in_array('*',$pr_remark))

                                                            @else
                                                                <br>
                                                                Rank: {{ ViewHelper::getStudentRankingInExam($data['year'], $data['month'], $data['exam'],$data['faculty'], $data['semester'], $student->id) }}
                                                            @endif
                                                            <br>
                                                            Position on Total:{{$student->Position}}
                                                        </td>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <div class="smaller-80">
                                                <strong>Abbreviations | </strong><strong>TH</strong>:Theory,<strong>PR</strong>:Practical, <strong>*</strong>:Missing, <strong>*N</strong>:Negative,<strong>AB*</strong>:Absent, <strong>REM</strong>:Remark
                                            </div>

                                            <div class="space-32"></div>
                                            <div class="row text-uppercase">
                                                <div class="pull-left text-center" >
                                                        <span>
                                                            <strong style="border-bottom: 2px black solid"  >{{\Carbon\Carbon::now()->format('Y-m-d')}}</strong ><br>
                                                            Print Date
                                                        </span>
                                                </div>
                                                <div class="pull-right text-center">
                                                    <br>
                                                    <span style="border-top: 2px black solid; padding: 0px 50px;">&nbsp;Controller of Examination&nbsp;</span >
                                                </div>
                                            </div>
                                        </div>
                                        <!-- PAGE CONTENT ENDS -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.page-content -->
                        </div>
                    </div>
                </div>
            </div><!-- /.main-content -->
            {{--<div style="page-break-after:always;"></div>--}}
        @endforeach
        </div>
            @endif
@endsection

@section('js')
    <!-- inline scripts related to this page -->
   @include('includes.scripts.print_script')
@endsection