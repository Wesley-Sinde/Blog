@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    <link href="https://fonts.googleapis.com/css?family=Fugaz+One|Lobster|Merienda|Righteous|Black+Ops+One|Gilda+Display" rel="stylesheet">
    <style>
        .page-content {
            padding: 35px 30px !important;
            border: 30px #438eb9 solid;
        }
        @media print {
            .main-content {
                width: 210mm;
                height: 297mm;
                padding: 15px 15px !important;
                border: 30px #438eb9 solid;
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
                        <div class="space-6"></div>
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
                                                <h2 class="no-margin-top" style="font-family: 'Merienda', cursive; font-size: 20px">
                                                    <strong>{{$generalSetting->institute}}</strong>
                                                </h2>
                                                <h4 class="text-uppercase no-margin-top">Department of Examination</h4>

                                                <div class="space-4"></div>
                                                <h2 class="no-margin text-uppercase" style="font-family: 'Black Ops One', cursive;font-size: 30px">
                                                    <strong><u>{{ ViewHelper::getExamById($data['exam']) }} - {{ ViewHelper::getYearById($data['year']) }}</u></strong>
                                                </h2>
                                                <h2 class="no-margin text-uppercase" style="font-family: 'Black Ops One', cursive;font-size: 40px">
                                                    <strong><u>Exam Schedule</u></strong>
                                                </h2>
                                                <h3 class="no-margin-top" style="font-family: 'Righteous', cursive;">for</h3>
                                                <h3 class="no-margin no-margin-top text-uppercase" style="font-family: 'Black Ops One', cursive;font-size: 22px">
                                                    <strong>
                                                        <u>
                                                            {{  ViewHelper::getFacultyTitle( $data['faculty'] ) }} /
                                                            {{  ViewHelper::getSemesterTitle( $data['semester'] ) }}
                                                        </u>
                                                    </strong>
                                                </h3>
                                                {{--<h3 class="no-margin-top" style="font-family: 'Righteous', cursive;">
                                                    {{  ViewHelper::getFacultyTitle( $data['faculty'] ) }} /
                                                    {{  ViewHelper::getSemesterTitle( $data['semester'] ) }}
                                                </h3>--}}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="space-8"></div>
                                    <div class=row">
                                        <table class="table table-striped table-bordered no-margin-bottom text-uppercase">
                                            <thead>
                                            <tr class="text-center">
                                                <th class="center"></th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Subject</th>
                                                <th>FM(T)</th>
                                                <th>PM(T)</th>
                                                <th>FM(P)</th>
                                                <th>PM(P)</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @if($data['subjects']  && $data['subjects'] ->count() > 0)
                                                @php($i=1)
                                                @foreach($data['subjects']  as $subject)
                                                    <tr>
                                                        <td class="center">{{ $i }}</td>
                                                        <td> {{ \Carbon\Carbon::parse($subject->date)->format('Y-m-d') }}</td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($subject->start_time )->format('g:i A') }}
                                                            To
                                                            {{ \Carbon\Carbon::parse($subject->end_time )->format('g:i A') }}
                                                        </td>
                                                        <td> {{ $subject->title }}  [{{ $subject->code }}] </td>
                                                        <td class="center">{{ $subject->full_mark_theory?$subject->full_mark_theory:'-' }}</td>
                                                        <td class="center">{{ $subject->pass_mark_theory?$subject->pass_mark_theory:'-' }}</td>
                                                        <td class="center">{{ $subject->full_mark_practical?$subject->full_mark_practical:'-' }}</td>
                                                        <td class="center">{{ $subject->pass_mark_practical?$subject->pass_mark_practical:'-' }}</td>
                                                    </tr>
                                                    @php($i++)
                                                @endforeach
                                            @else
                                                <tr colspan="6"></tr>
                                            @endif
                                            </tbody>
                                        </table>
                                        <div class="well well-sm">
                                            Abbreviations | FM:Full Mark, PM: Pass Mark, T:Theory,P:Practical
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
                                        <div class="well well-sm">
                                            Note:This is only for information. If any query contact Examination Department.
                                        </div>
                                    </div>
                                    <div class="hr hr-4 hr-dotted"></div>

                                </div>
                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
    {{--<div style="page-break-after:always;"></div>--}}
@endsection


@section('js')
    <!-- inline scripts related to this page -->
   @include('includes.scripts.print_script')
@endsection