@extends('user-student.layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    <link href="https://fonts.googleapis.com/css?family=Lobster|Righteous" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fugaz+One|Lobster|Merienda|Righteous" rel="stylesheet">
@endsection

@section('content')
    @if($data['student'] && $data['student']->count() > 0)
        @foreach($data['student'] as $student)
            <div class="main-content " {{--style="page-break-after:always;"--}}>
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
                                                <div class="col-md-8 col-print-8 align-left">
                                                    <div class="text-center">
                                                        <h2 class="no-margin-top" style="font-family: 'Merienda', cursive; font-size: 20px">
                                                            <strong>{{$generalSetting->institute}}</strong>
                                                        </h2>
                                                        <h3 class="text-uppercase no-margin-top">Department of Examination</h3>
                                                        <h5 class="no-margin-top">
                                                            {{$generalSetting->address}}, {{$generalSetting->phone}}
                                                        </h5>

                                                        <h2 class="no-margin text-uppercase" style="font-family: 'Righteous', cursive;">
                                                            <strong>admit card</strong>
                                                        </h2>
                                                        <h3 class="no-margin-top">for</h3>
                                                        <h3 class="no-margin no-margin-top" style="font-family: 'Righteous', cursive;">
                                                            <strong> {{ ViewHelper::getExamById($data['exam']) }} - {{ ViewHelper::getYearById($data['year']) }}</strong>
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-print-2 align-right">
                                                    @if($student->student_image != '')
                                                        <img class="img-thumbnail"  alt="{{ $student->title }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.'studentProfile'.DIRECTORY_SEPARATOR.$student->student_image) }}" width="120px" />
                                                    @endif
                                                </div>
                                            </div>

                                            <div class=row">
                                                <div class="hr hr-4"></div>
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

                                            <div class="hr hr-8"></div>
                                            <div class="row text-uppercase">
                                                <div class="col-sm-5 pull-right align-right">
                                                    <strong>Signature</strong>
                                                </div>
                                                <div class="col-sm-7 pull-left">
                                                    {{--<strong>Signature</strong>--}}
                                                </div>
                                            </div>
                                            <div class="hr hr-4"></div>
                                            <div class="well well-sm">
                                                Note:Student will give his/her exam with our examinations rule & regulation.
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
    @endif
@endsection

@section('js')
    <!-- inline scripts related to this page -->
   @include('includes.scripts.print_script')
@endsection