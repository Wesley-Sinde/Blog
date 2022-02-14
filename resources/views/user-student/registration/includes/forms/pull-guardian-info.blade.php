{{--
<span class="profile-picture">
    @if($guardianInfo->guardian_image != '')
        <img id="avatar" class="editable img-responsive" alt="{{ $guardianInfo->title }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.'parents'.DIRECTORY_SEPARATOR.$guardianInfo->guardian_image) }}" width="300px" />
    @else
        <img id="avatar" class="editable img-responsive" alt="{{ $guardianInfo->title }}" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" />
    @endif
                            </span>
<div class="profile-user-info profile-user-info-striped">
    <div class="profile-info-row">
        <div class="profile-info-name"> Guardian Name :  </div>
        <div class="profile-info-value">
            <span class="editable" id="temporary_place">{{ $guardianInfo->guardian_first_name.' '.$guardianInfo->guardian_middle_name.' '.$guardianInfo->guardian_last_name }}</span>
        </div>
        <div class="profile-info-name"> Eligibility :</div>
        <div class="profile-info-value">
            <span class="editable" id="guardian_eligibility">{{ $guardianInfo->guardian_eligibility }}</span>
        </div>

    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> Occupation :</div>
        <div class="profile-info-value">
            <span class="editable" id="guardian_occupation">{{ $guardianInfo->guardian_occupation }}</span>
        </div>
        <div class="profile-info-name"> Office :  </div>
        <div class="profile-info-value">
            <span class="editable" id="guardian_office">{{ $guardianInfo->guardian_office }}</span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> Office Num. :</div>
        <div class="profile-info-value">
            <span class="editable" id="guardian_office_number">{{ $guardianInfo->guardian_office_number }}</span>
        </div>
        <div class="profile-info-name"> Residence :</div>
        <div class="profile-info-value">
            <span class="editable" id="guardian_residence_number">{{ $guardianInfo->guardian_residence_number }}</span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> Mobile 1 :  </div>
        <div class="profile-info-value">
            <span class="editable" id="guardian_mobile_1">{{ $guardianInfo->guardian_mobile_1 }}</span>
        </div>
        <div class="profile-info-name"> Mobile 2 :</div>
        <div class="profile-info-value">
            <span class="editable" id="guardian_mobile_2">{{ $guardianInfo->guardian_mobile_2 }}</span>
        </div>

    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> E-mail :</div>
        <div class="profile-info-value">
            <span class="editable" id="guardian_email">{{ $guardianInfo->guardian_email }}</span>
        </div>
        <div class="profile-info-name"> Relation :  </div>
        <div class="profile-info-value">
            <span class="editable" id="guardian_relation">{{ $guardianInfo->guardian_relation }}</span>
        </div>
    </div>
    <div class="profile-info-row">
        <div class="profile-info-name"> Address :</div>
        <div class="profile-info-value">
            <span class="editable" id="guardian_mobile_2">{{ $guardianInfo->guardian_address }}</span>
        </div>
    </div>
</div>
--}}

<div class="row">
    <div class="col-xs-12 col-sm-3 col-md-3 center">
        <div>
            <span class="profile-picture">
               @if($guardianInfo->guardian_image != '')
                    <img id="avatar" class="editable img-responsive" alt="{{ $guardianInfo->title }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.'parents'.DIRECTORY_SEPARATOR.$guardianInfo->guardian_image) }}" width="200px" />
                @else
                    <img id="avatar" class="editable img-responsive" alt="{{ $guardianInfo->title }}" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" />
                @endif
            </span>
            <div class="space-4"></div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-9 col-md-9">
        <div class="space-6"></div>
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Guardian :  </div>
                <div class="profile-info-value">
                    <span class="editable" id="temporary_place">{{ $guardianInfo->guardian_first_name.' '.$guardianInfo->guardian_middle_name.' '.$guardianInfo->guardian_last_name }}</span>
                </div>
                <div class="profile-info-name"> Eligibility :</div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_eligibility">{{ $guardianInfo->guardian_eligibility }}</span>
                </div>

            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Occupation :</div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_occupation">{{ $guardianInfo->guardian_occupation }}</span>
                </div>
                <div class="profile-info-name"> Office :  </div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_office">{{ $guardianInfo->guardian_office }}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Office Num. :</div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_office_number">{{ $guardianInfo->guardian_office_number }}</span>
                </div>
                <div class="profile-info-name"> Residence :</div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_residence_number">{{ $guardianInfo->guardian_residence_number }}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Mobile 1 :  </div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_mobile_1">{{ $guardianInfo->guardian_mobile_1 }}</span>
                </div>
                <div class="profile-info-name"> Mobile 2 :</div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_mobile_2">{{ $guardianInfo->guardian_mobile_2 }}</span>
                </div>

            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> E-mail :</div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_email">{{ $guardianInfo->guardian_email }}</span>
                </div>
                <div class="profile-info-name"> Relation :  </div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_relation">{{ $guardianInfo->guardian_relation }}</span>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name"> Address :</div>
                <div class="profile-info-value">
                    <span class="editable" id="guardian_mobile_2">{{ $guardianInfo->guardian_address }}</span>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.row -->
