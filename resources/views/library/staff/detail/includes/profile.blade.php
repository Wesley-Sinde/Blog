<div class="row">

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
        <div class="space-6"></div>
        <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">{{ $data['staff']->first_name.' '.
                    $data['staff']->middle_name.' '.$data['staff']->last_name }}</div>
        <div class="space-6"></div>
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Reg. No.: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no"><a href="{{ route('staff.view', ['id' => $data['staff']->staffId]) }}">{{ ViewHelper::getStaffById($data['staff']->member_id) }}</a></span>
                </div>
                <div class="profile-info-name"> Member Id : </div>
                <div class="profile-info-value">
                    <span class="editable" id="student_name">
                        {{ $data['circulation']->code_prefix.$data['staff']->member_id }}
                    </span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Name : </div>
                <div class="profile-info-value">
                    <span class="editable" id="student_name">
                        <a href="{{ route('staff.view', ['id' => $data['staff']->staffId]) }}">
                            {{ $data['staff']->first_name.' '. $data['staff']->middle_name.' '.$data['staff']->last_name }}
                        </a>
                    </span>
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

                <div class="profile-info-name"> E-mail : </div>
                <div class="profile-info-value">
                    <span class="editable" id="email">{{ $data['staff']->email }}</span>
                </div>
            </div>

            <div class="profile-info-row">

                <div class="profile-info-name"> Mobile No : </div>
                <div class="profile-info-value">
                    <span class="editable" id="email">{{ $data['staff']->mobile_1.','.$data['staff']->mobile_2 }}</span>
                </div>

                <div class="profile-info-name"> Home Tel. : </div>
                <div class="profile-info-value">
                    <span class="editable" id="email">{{ $data['staff']->home_phone }}</span>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.row -->