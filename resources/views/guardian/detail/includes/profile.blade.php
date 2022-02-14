<div class="row">
    <div class="col-sm-12 align-right hidden-print">
        <a href="{{ route($base_route.'.edit', ['id' => $data['guardian']->id]) }}" class="btn-primary btn-sm" >
            <i class="ace-icon fa fa-pencil"></i> Edit
        </a>
        &nbsp;|&nbsp;
        <a href="#" class="btn-primary btn-sm" onclick="window.print();">
            <i class="ace-icon fa fa-print"></i> Print
        </a>
    </div>

    <div class="col-xs-12 col-sm-3 col-print-3">
        <div>
            <span class="profile-picture">
               @if($data['guardian']->guardian_image != '')
                    <img id="avatar" class="editable img-responsive" alt="{{ $data['guardian']->title }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.'parents'.DIRECTORY_SEPARATOR.$data['guardian']->guardian_image) }}" width="250px" />
                @else
                    <img id="avatar" class="editable img-responsive" alt="{{ $data['guardian']->title }}" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" />
                @endif
            </span>

            @if($data['guardian']->guardian_signature != '')
                <span class="profile-picture align-center">
                        <img class="editable img-responsive" alt="{{ $data['guardian']->title }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.$folder_name.DIRECTORY_SEPARATOR.$data['guardian']->guardian_signature) }}" width="150px" />
                </span>
            @else

            @endif

            <div class="space-4"></div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-9 col-print-9">
        <div class="space-3"></div>
        <div class="space-6"></div>
        <div class="label label-info label-xlg arrowed-in arrowed-right arrowed"> {{ $data['guardian']->guardian_first_name.' '.
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