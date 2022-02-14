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
                    <input type="hidden" name="studentDue" id="receive_amount_temp" value="{{ $student->balance }}" >

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
                <div class="profile-info-name"> Nationality : </div>
                <div class="profile-info-value">
                    <span class="editable" id="student_name">{{ $student->nationality }}</span>
                </div>

                <div class="profile-info-name"> E-mail : </div>
                <div class="profile-info-value">
                    <span class="editable" id="email">{{ $student->email }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Balance Fee : </div>
                <div class="profile-info-value text-uppercase">
                    <span class="editable">{{ $student->balance }}</span>
                    [{{ ViewHelper::convertNumberToWord($student->balance) }}]
                </div>
            </div>
        </div>
        <div class="col-xs-12 clearfix">
                <span class="editable" id="ledger_link">
                    <a href="{{ route('account.fees.due.view', ['id' => $student->id]) }}" target="_blank" class="label label-primary label-lg white">
                        <i class="ace-icon fa fa-calculator  align-top bigger-125 icon-on-right"></i>
                        Pay Selected Due
                    </a>

                    <a href="{{ route('account.fees.collection.view', ['id' => $student->id]) }}" target="_blank" class="label label-primary label-lg white">
                        <i class="ace-icon fa fa-eye  align-top bigger-125 icon-on-right"></i>
                        ViewLedger
                    </a>

                    <a class="label label-primary label-lg white inline" href="{{ route('print-out.fees.student-ledger', ['id' => $student->id]) }}" target="_blank">
                        Print Ledger
                        <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
                    </a>

                    <a class="label label-warning label-lg white inline" href="{{ route('print-out.fees.student-due-detail', ['id' => $student->id]) }}" target="_blank">
                        Due Detail : {{ number_format($student->balance, 2) }}/-
                        <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
                    </a>

                    <a class="label label-warning label-lg white inline" href="{{ route('print-out.fees.student-due', ['id' => $student->id]) }}" target="_blank">
                        Total Balance
                        <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
                    </a>

                    <a class="label label-success label-lg white inline" href="{{ route('print-out.fees.today-receipt-detail', ['id' => $student->id]) }}" target="_blank">
                        Today Receipt Detail
                        <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
                    </a>

                    <a class="label label-success label-lg white inline" href="{{ route('print-out.fees.today-receipt', ['id' => $student->id]) }}" target="_blank">
                        Receipt
                        <i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
                    </a>
                </span>

        </div>
    </div>
</div><!-- /.row -->