<div class="row">
    <div class="col-sm-12 align-right hidden-print">
        <a href="#" class="" onclick="window.print();">
            <i class="ace-icon fa fa-print bigger-200"></i>
        </a>
    </div>

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
        <div class="center">
            {{--
            <span class="btn btn-app btn-sm btn-light no-hover">
                <span class="line-height-1 bigger-170 blue"> 1,411 </span>
                <br>
                <span class="line-height-1 smaller-90"> Views </span>
            </span>
            <span class="btn btn-app btn-sm btn-yellow no-hover">
                <span class="line-height-1 bigger-170"> 32 </span>
                <br>
                <span class="line-height-1 smaller-90"> Followers </span>
            </span>
            <span class="btn btn-app btn-sm btn-pink no-hover">
                <span class="line-height-1 bigger-170"> 4 </span>
                <br>
                <span class="line-height-1 smaller-90"> Projects </span>
            </span>
            <span class="btn btn-app btn-sm btn-grey no-hover">
                <span class="line-height-1 bigger-170"> 23 </span>
                <br>
                <span class="line-height-1 smaller-90"> Reviews </span>
            </span>
            <span class="btn btn-app btn-sm btn-success no-hover">
                <span class="line-height-1 bigger-170"> 7 </span>
                <br>
                <span class="line-height-1 smaller-90"> Albums </span>
            </span>
            <span class="btn btn-app btn-sm btn-primary no-hover">
                <span class="line-height-1 bigger-170"> 55 </span>
                <br>
                <span class="line-height-1 smaller-90"> Contacts </span>
            </span>--}}
        </div>

        <div class="space-6"></div>
        <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">{{ $data['student']->first_name.' '.
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
<div class="row">
    <div class="space-6"></div>
    <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">Permanent Address</div>
    <div class="space-6"></div>
    <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
            <div class="profile-info-name"> Address : </div>
            <div class="profile-info-value">
                <span class="editable" id="permanent_place">{{ $data['student']->address }}</span>
            </div>
            <div class="profile-info-name"> State :</div>
            <div class="profile-info-value">
                <span class="editable" id="permanent_district">{{ $data['student']->state }}</span>
            </div>
            <div class="profile-info-name"> Country : </div>
            <div class="profile-info-value">
                <span class="editable" id="permanent_zone">{{ $data['student']->country }}</span>
            </div>
        </div>
    </div>

    <div class="space-6"></div>
    <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">Temporary Address</div>
    <div class="space-6"></div>
    <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
            <div class="profile-info-name"> Address : </div>
            <div class="profile-info-value">
                <span class="editable" id="permanent_place">{{ $data['student']->temp_address }}</span>
            </div>
            <div class="profile-info-name"> State :</div>
            <div class="profile-info-value">
                <span class="editable" id="permanent_district">{{ $data['student']->temp_state }}</span>
            </div>
            <div class="profile-info-name"> Country : </div>
            <div class="profile-info-value">
                <span class="editable" id="permanent_zone">{{ $data['student']->temp_country }}</span>
            </div>
        </div>
    </div>

    <div class="space-6"></div>
    <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">Parential Info</div>
    <div class="space-6"></div>
    <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
            <div class="profile-info-name"> Grand Father :  </div>
            <div class="profile-info-value">
                <span class="editable" id="temporary_place">{{ $data['student']->grandfather_first_name.' '.$data['student']->grandfather_middle_name.' '.$data['student']->grandfather_last_name }}</span>
            </div>
        </div>
    </div>
    <div class="space-6"></div>
    <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
            <div class="profile-info-name"> Father Name :  </div>
            <div class="profile-info-value">
                <span class="editable" id="temporary_place">{{ $data['student']->father_first_name.' '.$data['student']->father_middle_name.' '.$data['student']->father_last_name }}</span>
            </div>
            <div class="profile-info-name"> Eligibility :</div>
            <div class="profile-info-value">
                <span class="editable" id="father_eligibility">{{ $data['student']->father_eligibility }}</span>
            </div>
            <div class="profile-info-name"> Occupation :</div>
            <div class="profile-info-value">
                <span class="editable" id="father_occupation">{{ $data['student']->father_occupation }}</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> Office :  </div>
            <div class="profile-info-value">
                <span class="editable" id="father_office">{{ $data['student']->father_office }}</span>
            </div>
            <div class="profile-info-name"> Office Num. :</div>
            <div class="profile-info-value">
                <span class="editable" id="father_office_number">{{ $data['student']->father_office_number }}</span>
            </div>
            <div class="profile-info-name"> Residence : </div>
            <div class="profile-info-value">
                <span class="editable" id="father_residence_number">{{ $data['student']->father_residence_number }}</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> Mobile 1 :  </div>
            <div class="profile-info-value">
                <span class="editable" id="father_mobile_1">{{ $data['student']->father_mobile_1 }}</span>
            </div>
            <div class="profile-info-name"> Mobile 2 :</div>
            <div class="profile-info-value">
                <span class="editable" id="father_mobile_2">{{ $data['student']->father_mobile_2 }}</span>
            </div>
            <div class="profile-info-name"> E-mail : </div>
            <div class="profile-info-value">
                <span class="editable" id="father_email">{{ $data['student']->father_email }}</span>
            </div>
        </div>
    </div>

    <div class="space-6"></div>
    <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
            <div class="profile-info-name"> Mother Name :  </div>
            <div class="profile-info-value">
                <span class="editable" id="temporary_place">{{ $data['student']->mother_first_name.' '.$data['student']->mother_middle_name.' '.$data['student']->mother_last_name }}</span>
            </div>
            <div class="profile-info-name"> Eligibility :</div>
            <div class="profile-info-value">
                <span class="editable" id="mother_eligibility">{{ $data['student']->mother_eligibility }}</span>
            </div>
            <div class="profile-info-name"> Occupation : </div>
            <div class="profile-info-value">
                <span class="editable" id="mother_occupation">{{ $data['student']->mother_occupation }}</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> Office :  </div>
            <div class="profile-info-value">
                <span class="editable" id="mother_office">{{ $data['student']->mother_office }}</span>
            </div>
            <div class="profile-info-name"> Office Num. :</div>
            <div class="profile-info-value">
                <span class="editable" id="mother_office_number">{{ $data['student']->mother_office_number }}</span>
            </div>
            <div class="profile-info-name"> Residence : </div>
            <div class="profile-info-value">
                <span class="editable" id="mother_residence_number">{{ $data['student']->mother_residence_number }}</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> Mobile 1 :  </div>
            <div class="profile-info-value">
                <span class="editable" id="mother_mobile_1">{{ $data['student']->mother_mobile_1 }}</span>
            </div>
            <div class="profile-info-name"> Mobile 2 :</div>
            <div class="profile-info-value">
                <span class="editable" id="mother_mobile_2">{{ $data['student']->mother_mobile_2 }}</span>
            </div>
            <div class="profile-info-name"> E-mail :</div>
            <div class="profile-info-value">
                <span class="editable" id="mother_email">{{ $data['student']->mother_email }}</span>
            </div>
        </div>
    </div>

    <div class="space-6"></div>
    <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">Guardian Info</div>
    <div class="space-6"></div>
    <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
            <div class="profile-info-name"> Guardian :  </div>
            <div class="profile-info-value">
                <span class="editable" id="temporary_place">{{ $data['student']->guardian_first_name.' '.$data['student']->guardian_middle_name.' '.$data['student']->guardian_last_name }}</span>
            </div>
            <div class="profile-info-name"> Eligibility :</div>
            <div class="profile-info-value">
                <span class="editable" id="guardian_eligibility">{{ $data['student']->guardian_eligibility }}</span>
            </div>
            <div class="profile-info-name"> Occupation :</div>
            <div class="profile-info-value">
                <span class="editable" id="guardian_occupation">{{ $data['student']->guardian_occupation }}</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> Office :  </div>
            <div class="profile-info-value">
                <span class="editable" id="guardian_office">{{ $data['student']->guardian_office }}</span>
            </div>
            <div class="profile-info-name"> Office Num. :</div>
            <div class="profile-info-value">
                <span class="editable" id="guardian_office_number">{{ $data['student']->guardian_office_number }}</span>
            </div>
            <div class="profile-info-name"> Residence :</div>
            <div class="profile-info-value">
                <span class="editable" id="guardian_residence_number">{{ $data['student']->guardian_residence_number }}</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> Mobile 1 :  </div>
            <div class="profile-info-value">
                <span class="editable" id="mother_mobile_1">{{ $data['student']->mother_mobile_1 }}</span>
            </div>
            <div class="profile-info-name"> Mobile 2 :</div>
            <div class="profile-info-value">
                <span class="editable" id="mother_mobile_2">{{ $data['student']->mother_mobile_2 }}</span>
            </div>
            <div class="profile-info-name"> E-mail :</div>
            <div class="profile-info-value">
                <span class="editable" id="mother_email">{{ $data['student']->mother_email }}</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> Relation :  </div>
            <div class="profile-info-value">
                <span class="editable" id="guardian_relation">{{ $data['student']->guardian_relation }}</span>
            </div>
            <div class="profile-info-name"> Address :</div>
            <div class="profile-info-value">
                <span class="editable" id="mother_mobile_2">{{ $data['student']->guardian_address }}</span>
            </div>
        </div>
    </div>
</div>

