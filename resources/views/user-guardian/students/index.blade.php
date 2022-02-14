@extends('user-guardian.layouts.master')

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
                        Guardian
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Students List
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12 ">
                        @include('includes.flash_messages')
                    </div>

                    <div class="col-md-12">
                        @if($data['students'] && $data['students']->count() > 0)
                            @foreach($data['students'] as $student)
                                <div class="row">
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="space-6"></div>
                                        <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">{{ $student->first_name.' '.
                                            $student->middle_name.' '.$student->last_name }}</div>
                                        <div class="space-6"></div>
                                        <div class="profile-user-info profile-user-info-striped">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Faculty: </div>
                                                <div class="profile-info-value">
                                                    <span class="editable" id="faculty">{{  ViewHelper::getFacultyTitle( $student->faculty ) }}</span>
                                                </div>
                                                <div class="profile-info-name"> Semester :</div>
                                                <div class="profile-info-value">
                                                    <span class="editable" id="semester">{{  ViewHelper::getSemesterTitle( $student->semester ) }}</span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Reg. No.: </div>
                                                <div class="profile-info-value">
                                                    <span class="editable" id="reg_no">{{ $student->reg_no }}</span>
                                                </div>
                                                <div class="profile-info-name"> Reg. Date :</div>
                                                <div class="profile-info-value">
                                                    <span class="editable" id="reg_date">{{ \Carbon\Carbon::parse($student->reg_date)->format('Y-m-d')}}</span>
                                                </div>
                                            </div>


                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Univ.Reg.: </div>
                                                <div class="profile-info-value">
                                                    <span class="editable" id="university_reg">{{ $student->university_reg }}</span>
                                                </div>
                                                <div class="profile-info-name"> DOB : </div>
                                                <div class="profile-info-value">
                                                    <span class="editable" id="student_name">{{ \Carbon\Carbon::parse($student->date_of_birth)->format('Y-m-d')}}</span>
                                                </div>
                                            </div>



                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Gender : </div>
                                                <div class="profile-info-value">
                                                    <span class="editable" id="student_name">{{ $student->gender }}</span>
                                                </div>
                                                <div class="profile-info-name"> Blood Group : </div>
                                                <div class="profile-info-value">
                                                    <span class="editable" id="student_name">{{ $student->blood_group }}</span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Nationality : </div>
                                                <div class="profile-info-value">
                                                    <span class="editable" id="student_name">{{ $student->nationality }}</span>
                                                </div>
                                                <div class="profile-info-name"> MotherTong: </div>
                                                <div class="profile-info-value">
                                                    <span class="editable" id="student_name">{{ $student->mother_tongue }}</span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> E-mail : </div>
                                                <div class="profile-info-value">
                                                    <span class="editable" id="email">{{ $student->email }}</span>
                                                </div>

                                                <div class="profile-info-name"> Mobile No : </div>
                                                <div class="profile-info-value">
                                                    <span class="editable" id="email">{{ $student->mobile_1.','.$student->mobile_2 }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 center">
                                        <div>
                                            <span class="profile-picture">
                                               @if($student->student_image != '')
                                                    <img id="avatar" class="editable img-responsive" alt="{{ $student->title }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.'studentProfile'.DIRECTORY_SEPARATOR.$student->student_image) }}" width="300px" />
                                                @else
                                                    <img id="avatar" class="editable img-responsive" alt="{{ $student->title }}" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" />
                                                @endif
                                            </span>

                                            <div class="space-4"></div>
                                        </div>
                                    </div>
                                </div><!-- /.row -->
                                <hr class="hr-2">
                                <div class="clearfix hidden-print ">
                                    <div class="easy-link-menu align-left">
                                        @permission('guardian-student-profile')
                                        <a class="{!! request()->is('user-guardian/students/profile')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user-guardian.students.profile',['id'=>Crypt::encryptString($student->id)]) }}"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Profile</a>
                                        @endpermission
                                        @permission('guardian-student-fees')
                                        <a class="{!! request()->is('user-guardian/students/fees')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user-guardian.students.fees',['id'=>Crypt::encryptString($student->id)]) }}"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Fee Detail</a>
                                        @endpermission
                                        @permission('guardian-student-library')
                                        <a class="{!! request()->is('user-guardian/students/library')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user-guardian.students.library',['id'=>Crypt::encryptString($student->id)]) }}"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Library</a>
                                        @endpermission
                                        @permission('guardian-student-attendance')
                                        <a class="{!! request()->is('user-guardian/students/attendance')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user-guardian.students.attendance',['id'=>Crypt::encryptString($student->id)]) }}"><i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;Attendance</a>
                                        @endpermission
                                        @permission('guardian-student-exam')
                                        <a class="{!! request()->is('user-guardian/students/exams')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user-guardian.students.exams',['id'=>Crypt::encryptString($student->id)]) }}"><i class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;Exam & Score</a>
                                        @endpermission
                                        @permission('guardian-student-hostel')
                                        <a class="{!! request()->is('user-guardian/students/hostel')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user-guardian.students.hostel',['id'=>Crypt::encryptString($student->id)]) }}"><i class="fa fa-bed" aria-hidden="true"></i>&nbsp;Hostel</a>
                                        @endpermission
                                        @permission('guardian-student-transport')
                                        <a class="{!! request()->is('user-guardian/students/transport')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user-guardian.students.transport',['id'=>Crypt::encryptString($student->id)]) }}"><i class="fa fa-car" aria-hidden="true"></i>&nbsp;Transport</a>
                                        @endpermission
                                        @permission('guardian-student-course')
                                        <a class="{!! request()->is('user-guardian/students/subject')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user-guardian.students.subject',['id'=>Crypt::encryptString($student->id)]) }}"><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp;Course</a>
                                        @endpermission
                                        @permission('guardian-student-download')
                                        <a class="{!! request()->is('user-guardian/students/download')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user-guardian.students.download',['id'=>Crypt::encryptString($student->id)]) }}"><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp;Downloads</a>
                                        @endpermission
                                        @permission('guardian-student-assignment')
                                        <a class="{!! request()->is('user-guardian/students/assignment')?'btn-success':'btn-primary' !!} btn-sm" href="{{ route('user-guardian.students.assignment',['id'=>Crypt::encryptString($student->id)]) }}"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp;Asignment</a>
                                        @endpermission
                                    </div>
                                </div>
                               <hr class="hr-32">
                            @endforeach
                        @endif
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


@endsection