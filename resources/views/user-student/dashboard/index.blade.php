@extends('user-student.layouts.master')

@section('css')
    <!-- page specific plugin styles -->
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('user-student.layouts.includes.template_setting')
                <div class="page-header">
                    <h1>
                        Dashboard
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Student
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12 ">
                        @include('includes.flash_messages')
                        @include('user-student.dashboard.includes.notice')

                    </div>
                    <div class="col-md-12">
                        <div class="row">
                           {{-- <div class="col-sm-12 align-right hidden-print">
                                <a href="#" class="" onclick="window.print();">
                                    <i class="ace-icon fa fa-print bigger-200"></i>
                                </a>
                            </div>--}}

                            <div class="col-xs-12 col-sm-3 center">
                             <div>
                            <span class="profile-picture">
                               @if($data['student']->student_image != '')
                                    <img id="avatar" class="editable img-responsive" alt="{{ $data['student']->title }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.'studentProfile'.DIRECTORY_SEPARATOR.$data['student']->student_image) }}" width="300px" />
                                @else
                                    <img id="avatar" class="editable img-responsive" alt="{{ $data['student']->title }}" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" />
                                @endif
                            </span>

                                    <div class="space-4"></div>

                                    {{--<div class="width-80 label label-warning label-xlg arrowed-right overflow-hidden">
                                        <div class="inline position-relative ">
                                            <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                                                <span class="white" >{{ $data['student']->first_name.' '.
                                            $data['student']->middle_name.' '.$data['student']->last_name }}</span>
                                            </a>
                                            <ul class="align-left dropdown-menu dropdown-caret dropdown-lighter">
                                                <li class="dropdown-header"> Change Status </li>

                                                <li>
                                                    <a href="#">
                                                        <i class="ace-icon fa fa-circle green"></i>
                                                        &nbsp;
                                                        <span class="green">Available</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#">
                                                        <i class="ace-icon fa fa-circle red"></i>
                                                        &nbsp;
                                                        <span class="red">Busy</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="#">
                                                        <i class="ace-icon fa fa-circle grey"></i>
                                                        &nbsp;
                                                        <span class="grey">Invisible</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="space-6"></div>--}}

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-9">

                                <div class="space-6"></div>
                                <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">Welcome, {{ $data['student']->first_name.' '.
                                    $data['student']->middle_name.' '.$data['student']->last_name }}</div>
                                <div class="space-6"></div>
                                <div class="profile-user-info profile-user-info-striped">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Faculty: </div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="faculty">{{  ViewHelper::getFacultyTitle( $data['student']->faculty ) }}</span>
                                        </div>
                                        <div class="profile-info-name"> Semester :</div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="semester">{{  ViewHelper::getSemesterTitle( $data['student']->semester ) }}</span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Reg. No.: </div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="reg_no">{{ $data['student']->reg_no }}</span>
                                        </div>
                                        <div class="profile-info-name"> Reg. Date :</div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="reg_date">{{ \Carbon\Carbon::parse($data['student']->reg_date)->format('Y-m-d')}}</span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Univ.Reg.: </div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="university_reg">{{ $data['student']->university_reg }}</span>
                                        </div>
                                        <div class="profile-info-name"> DOB : </div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="student_name">{{ \Carbon\Carbon::parse($data['student']->date_of_birth)->format('Y-m-d')}}</span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Gender : </div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="student_name">{{ $data['student']->gender }}</span>
                                        </div>
                                        <div class="profile-info-name"> Blood Group : </div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="student_name">{{ $data['student']->blood_group }}</span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Nationality : </div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="student_name">{{ $data['student']->nationality }}</span>
                                        </div>
                                        <div class="profile-info-name"> MotherTong: </div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="student_name">{{ $data['student']->mother_tongue }}</span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> E-mail : </div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="email">{{ $data['student']->email }}</span>
                                        </div>

                                        <div class="profile-info-name"> Mobile No : </div>
                                        <div class="profile-info-value">
                                            <span class="editable" id="email">{{ $data['student']->mobile_1.','.$data['student']->mobile_2 }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.row -->
                        <div class="hr-double hr-16"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div>{!! $data['feeCompare']->container() !!}</div>
                            </div>
                        </div>
                    </div>
                    </div><!-- /.row -->
                <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    </div>
@endsection

@section('js')

    <!-- page specific plugin scripts -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js" charset="utf-8"></script>
     {!! $data['feeCompare']->script() !!}

@endsection