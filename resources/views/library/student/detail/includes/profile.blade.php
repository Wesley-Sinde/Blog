<div class="row">

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

        </div>
    </div>
    <div class="col-xs-12 col-sm-9">
        <div class="space-6"></div>
        <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">{{ $data['student']->first_name.' '.
                    $data['student']->middle_name.' '.$data['student']->last_name }}</div>
        <div class="space-6"></div>
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Reg. No.: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">
                        <a href="{{ route('student.view', ['id' => $data['student']->member_id]) }}">{{ ViewHelper::getStudentById($data['student']->member_id) }}</a>
                    </span>

                </div>
                <div class="profile-info-name"> Member Id : </div>
                <div class="profile-info-value">
                     <span class="editable" id="student_name">
                        {{ $data['circulation']->code_prefix.$data['student']->member_id }}
                    </span>
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

                <div class="profile-info-name"> E-mail : </div>
                <div class="profile-info-value">
                    <span class="editable" id="email">{{ $data['student']->email }}</span>
                </div>
            </div>


        </div>
    </div>
</div><!-- /.row -->