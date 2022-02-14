<div class="row">
    <div class="col-sm-12 align-right hidden-print">
        <a href="#" class="" onclick="window.print();">
            <i class="ace-icon fa fa-print bigger-200"></i>
        </a>
    </div>

    <div class="col-xs-12 col-sm-3 center">
        <div>
            <span class="profile-picture">
                @if($data['staff']->staff_image != '')
                    <img id="avatar" class="editable img-responsive" alt="{{ $data['staff']->title }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.'staff'.DIRECTORY_SEPARATOR.$data['staff']->staff_image) }}" width="300px" />
                @else
                    <img id="avatar" class="editable img-responsive" alt="{{ $data['staff']->title }}" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" />
                @endif

            </span>

            <div class="space-4"></div>

        </div>
    </div>
    <div class="col-xs-12 col-sm-9">
        <div class="label label-info label-xlg arrowed-right">Welcome, {{ $data['staff']->first_name.' '.
                    $data['staff']->middle_name.' '.$data['staff']->last_name }}</div>
        <div class="space-6"></div>
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Reg. No.: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">{{ $data['staff']->reg_no }}</span>
                </div>
                <div class="profile-info-name"> Join Date :</div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_date">{{ \Carbon\Carbon::parse($data['staff']->join_date)->format('Y-m-d')}}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Name : </div>
                <div class="profile-info-value">
                    <span class="editable" id="student_name">{{ $data['staff']->first_name.' '.
                    $data['staff']->middle_name.' '.$data['staff']->last_name }}</span>
                </div>
                <div class="profile-info-name"> DOB : </div>
                <div class="profile-info-value">
                    <span class="editable" id="student_name">{{ \Carbon\Carbon::parse($data['staff']->date_of_birth)->format('Y-m-d')}}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Gender : </div>
                <div class="profile-info-value">
                    <span class="editable" id="student_name">{{ $data['staff']->gender }}</span>
                </div>
                <div class="profile-info-name"> Blood Group : </div>
                <div class="profile-info-value">
                    <span class="editable" id="student_name">{{ $data['staff']->blood_group }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Nationality : </div>
                <div class="profile-info-value">
                    <span class="editable" id="student_name">{{ $data['staff']->nationality }}</span>
                </div>
                <div class="profile-info-name"> MotherTong: </div>
                <div class="profile-info-value">
                    <span class="editable" id="student_name">{{ $data['staff']->mother_tongue }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> E-mail : </div>
                <div class="profile-info-value">
                    <span class="editable" id="email">{{ $data['staff']->email }}</span>
                </div>

                <div class="profile-info-name"> Mobile No : </div>
                <div class="profile-info-value">
                    <span class="editable" id="email">{{ $data['staff']->mobile_1.','.$data['staff']->mobile_2 }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Home Tel. : </div>
                <div class="profile-info-value">
                    <span class="editable" id="email">{{ $data['staff']->home_phone }}</span>
                </div>

                <div class="profile-info-name"> Qualification: </div>
                <div class="profile-info-value">
                    <span class="editable" id="email">{{ $data['staff']->qualification }}</span>
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
                <span class="editable" id="permanent_place">{{ $data['staff']->address }}</span>
            </div>
            <div class="profile-info-name"> State :</div>
            <div class="profile-info-value">
                <span class="editable" id="permanent_district">{{ $data['staff']->state }}</span>
            </div>
            <div class="profile-info-name"> Country : </div>
            <div class="profile-info-value">
                <span class="editable" id="permanent_zone">{{ $data['staff']->country }}</span>
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
                <span class="editable" id="permanent_place">{{ $data['staff']->temp_address }}</span>
            </div>
            <div class="profile-info-name"> State :</div>
            <div class="profile-info-value">
                <span class="editable" id="permanent_district">{{ $data['staff']->temp_state }}</span>
            </div>
            <div class="profile-info-name"> Country : </div>
            <div class="profile-info-value">
                <span class="editable" id="permanent_zone">{{ $data['staff']->temp_country }}</span>
            </div>
        </div>
    </div>

    <div class="space-6"></div>
    <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">Parential Info</div>
    <div class="space-6"></div>
    <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
            <div class="profile-info-name">Father Name :  </div>
            <div class="profile-info-value">
                <span class="editable" id="temporary_place">{{ $data['staff']->father_name }}</span>
            </div>

            <div class="profile-info-name"> Mother Name :  </div>
            <div class="profile-info-value">
                <span class="editable" id="temporary_place">{{ $data['staff']->mother_name }}</span>
            </div>
        </div>
    </div>
    <div class="space-6"></div>


    <div class="space-6"></div>
    <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">Qualification Detail</div>
    <div class="space-6"></div>
    <div class="profile-user-info profile-user-info-striped">
        <div class="profile-info-row">
            <div class="profile-info-name"> Qualification :  </div>
            <div class="profile-info-value">
                <span class="editable" id="temporary_place">{{ $data['staff']->qualification }}</span>
            </div>
            <div class="profile-info-name"> Experience :</div>
            <div class="profile-info-value">
                <span class="editable" id="guardian_eligibility">{{ $data['staff']->experience }}</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> Experience Information :  </div>
            <div class="profile-info-value">
                <span class="editable" id="guardian_office">{{ $data['staff']->experience_info }}</span>
            </div>
        </div>
        <div class="profile-info-row">
            <div class="profile-info-name"> Other Informaiton :  </div>
            <div class="profile-info-value">
                <span class="editable" id="mother_mobile_1">{{ $data['staff']->other_info }}</span>
            </div>
        </div>
    </div>
</div>

