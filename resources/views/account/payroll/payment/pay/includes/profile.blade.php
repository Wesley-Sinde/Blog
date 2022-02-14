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
                    <img id="avatar-small" class="editable img-responsive" alt="{{ $data['staff']->title }}" src="{{ asset('images'.DIRECTORY_SEPARATOR.'staff'.DIRECTORY_SEPARATOR.$data['staff']->staff_image) }}"/>
                @else
                    <img id="avatar" class="editable img-responsive" alt="{{ $data['staff']->title }}" src="{{ asset('assets/images/avatars/profile-pic.jpg') }}" />
                @endif

            </span>

            <div class="space-4"></div>

        </div>
    </div>
    <div class="col-xs-12 col-sm-9">
        <div class="label label-info label-xlg arrowed-in arrowed-right arrowed">{{ $data['staff']->first_name.' '.
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
                <div class="profile-info-name">Designation : </div>
                <div class="profile-info-value">
                    <span class="editable" id="designation">{{ ViewHelper::getDesignationId($data['staff']->designation) }}</span>
                </div>

                <div class="profile-info-name"> Qualification: </div>
                <div class="profile-info-value">
                    <span class="editable" id="qualification">{{ $data['staff']->qualification }}</span>
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
                    <span class="editable" id="date_of_birth">{{ \Carbon\Carbon::parse($data['staff']->date_of_birth)->format('Y-m-d')}}</span>
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

        </div>
    </div>
</div><!-- /.row -->