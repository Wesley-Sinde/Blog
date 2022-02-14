<div class="row">

    <div class="col-xs-12 col-sm-3 center">
        <div>
            <span class="profile-picture">
                @if($student->student_image != '')
                    <img id="avatar" alt="StudentPic" src="{{ asset('images'.DIRECTORY_SEPARATOR.'studentProfile'.DIRECTORY_SEPARATOR.$student->student_image) }}" width="150px" />
                @else
                    <img id="avatar" alt="StudentPic" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" width="150px" />
                @endif

            </span>

            <div class="space-4"></div>

        </div>
    </div>
    <div class="col-xs-12 col-sm-9">
        <div class="space-6"></div>
        <div class="label label-info label-xlg arrowed-in arrowed-right arrowed"></div>
        <div class="space-6"></div>
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Name: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">
                        <a href="{{ route('student.view', ['id' => $student->id]) }}">{{ $student->first_name.' '.
                    $student->middle_name.' '.$student->last_name }}</a>
                    </span>
                    <input type="hidden" name="studentDue" value="{{ $student->balance }}" >

                </div>

                <div class="profile-info-name"> Reg. No.: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no">
                        <a href="{{ route('student.view', ['id' => $student->id]) }}" target="_blank">{{ ViewHelper::getStudentById($student->id) }}</a>
                    </span>

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
                <div class="profile-info-name"> Faculty/Class: </div>
                <div class="profile-info-value">
                    <span class="editable" id="faculty">{{  ViewHelper::getFacultyTitle( $student->faculty ) }}</span>
                </div>
                <div class="profile-info-name"> Sem./Sec. :</div>
                <div class="profile-info-value">
                    <span class="editable" id="semester">{{  ViewHelper::getSemesterTitle( $student->semester ) }}</span>
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
                <div class="profile-info-name"> E-mail : </div>
                <div class="profile-info-value">
                    <span class="editable" id="email">{{ $student->email }}</span>
                </div>
                <div class="profile-info-name"> Nationality : </div>
                <div class="profile-info-value">
                    <span class="editable" id="student_name">{{ $student->nationality }}</span>
                </div>


            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Balance Fee : </div>
                <div class="profile-info-value text-uppercase">
                    <span class="editable" id="balance_fee">{{ $student->balance }}</span>
                    [{{ ViewHelper::convertNumberToWord($student->balance) }}]
                </div>
            </div>
        </div>
        <div class="col-xs-12 clearfix">
            <hr class="hr-2">
                <span class="editable">
                    @include('certificate.issue.includes.certificate-link')

                </span>
            <hr class="hr-2">

        </div>
    </div>
</div><!-- /.row -->