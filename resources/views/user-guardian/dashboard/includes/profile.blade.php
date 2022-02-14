<div class="row">
    {{-- <div class="col-sm-12 align-right hidden-print">
         <a href="#" class="" onclick="window.print();">
             <i class="ace-icon fa fa-print bigger-200"></i>
         </a>
     </div>--}}

    <div class="col-xs-12 col-sm-3 center">
        <div>
                            <span class="profile-picture">
                               @if($data['guardian']->guardian_image != '')
                                    <img id="avatar" class="editable img-responsive" alt="{{ $data['guardian']->title }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.'parents'.DIRECTORY_SEPARATOR.$data['guardian']->guardian_image) }}" width="300px" />
                                @else
                                    <img id="avatar" class="editable img-responsive" alt="{{ $data['guardian']->title }}" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" />
                                @endif
                            </span>

            <div class="space-4"></div>

            {{--<div class="width-80 label label-warning label-xlg arrowed-right overflow-hidden">
                <div class="inline position-relative ">
                    <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                        <span class="white" >{{ $data['guardian']->first_name.' '.
                    $data['guardian']->middle_name.' '.$data['guardian']->last_name }}</span>
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
        {{--<div class="center">
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
            </span>
        </div>--}}

        <div class="space-6"></div>
        <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">Welcome, {{ $data['guardian']->guardian_first_name.' '.
                                    $data['guardian']->guardian_middle_name.' '.$data['guardian']->guardian_last_name }}</div>
        <div class="space-6"></div>
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Guardian :  </div>
                <div class="profile-info-value">
                    <span class="editable" id="temporary_place">{{ $data['guardian']->guardian_first_name.' '.$data['guardian']->guardian_middle_name.' '.$data['guardian']->guardian_last_name }}</span>
                </div>
                <div class="profile-info-name"> Eligibility :</div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_eligibility">{{ $data['guardian']->guardian_eligibility }}</span>
                </div>

            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Occupation :</div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_occupation">{{ $data['guardian']->guardian_occupation }}</span>
                </div>
                <div class="profile-info-name"> Office :  </div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_office">{{ $data['guardian']->guardian_office }}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Office Num. :</div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_office_number">{{ $data['guardian']->guardian_office_number }}</span>
                </div>
                <div class="profile-info-name"> Residence :</div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_residence_number">{{ $data['guardian']->guardian_residence_number }}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Mobile 1 :  </div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_mobile_1">{{ $data['guardian']->guardian_mobile_1 }}</span>
                </div>
                <div class="profile-info-name"> Mobile 2 :</div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_mobile_2">{{ $data['guardian']->guardian_mobile_2 }}</span>
                </div>

            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> E-mail :</div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_email">{{ $data['guardian']->guardian_email }}</span>
                </div>
                <div class="profile-info-name"> Relation :  </div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_relation">{{ $data['guardian']->guardian_relation }}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Address :</div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_mobile_2">{{ $data['guardian']->guardian_address }}</span>
                </div>
            </div>
        </div>
    </div>

</div><!-- /.row -->