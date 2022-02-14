<div class="row">

    <div class="col-xs-12 col-sm-3 center">
        <div>
            <span class="profile-picture">
                @if($data['student']->student_image != '')
                    <img id="avatar-small" class="editable img-responsive" alt="{{ $data['student']->title }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.'studentProfile'.DIRECTORY_SEPARATOR.$data['student']->student_image) }}" />
                @else
                    <img id="avatar-small" class="editable img-responsive" alt="{{ $data['student']->title }}" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" />
                @endif

            </span>

            <div class="space-4"></div>

        </div>
    </div>
    <div class="col-xs-12 col-sm-9">
        <div class="space-6"></div>
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Reg. No.: </div>
                <div class="profile-info-value">
                    <span class="editable" id="reg_no"><a href="{{ route('student.view', ['id' => $data['student']->id]) }}">{{ $data['student']->reg_no }}</a></span>
                </div>
                <div class="profile-info-name"> Uni. Reg.No. : </div>
                <div class="profile-info-value">
                    <span class="editable" id="student_name">{{ $data['student']->univ_reg }}</span>
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
                <div class="profile-info-name"> Name : </div>
                <div class="profile-info-value">
                    <span class="editable" id="student_name">
                        <a href="{{ route('student.view', ['id' => $data['student']->id]) }}"> {{ $data['student']->first_name.' '.$data['student']->middle_name.' '. $data['student']->last_name }}</a>
                    </span>
                </div>
                <div class="profile-info-name"> Father Name : </div>
                <div class="profile-info-value">
                    <span class="editable" id="student_name">
                        {{ $data['student']->father_first_name.' '.$data['student']->father_middle_name.' '.$data['student']->father_last_name }}
                    </span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Mobile No. : </div>
                <div class="profile-info-value">
                    <span class="editable" id="student_name">{{ $data['student']->mobile_1  }}</span>
                </div>

                <div class="profile-info-name"> E-mail : </div>
                <div class="profile-info-value">
                    <span class="editable" id="email">{{ $data['student']->email }}</span>
                </div>
            </div>


        </div>
    </div>
</div><!-- /.row -->
<hr class="hr-2">
