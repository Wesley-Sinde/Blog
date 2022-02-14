@extends('layouts.master')
@section('css')
    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
@endsection
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header">
                    <h1>
                        @include($view_path.'.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Edit  Registration
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        @include($view_path.'.includes.buttons')
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        @include('includes.validation_error_messages')
                        <div class="align-right hidden-print">
                            <a class="btn-primary btn-sm" href="{{ route($base_route.'.view', ['id' => $data['row']->id]) }}"  >
                                <i class="ace-icon fa fa-eye"></i> View Staff Profile
                            </a>
                        </div>

                        {!! Form::model($data['row'], ['route' => [$base_route.'.update', $data['row']->id], 'method' => 'POST', 'class' => 'form-horizontal',
                   'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
                        {!! Form::hidden('id', $data['row']->id) !!}
                       {{-- {!! Form::text('address_id', $data['row']->address_id) !!}
                        {!! Form::text('parents_id', $data['row']->parents_id) !!}
                        {!! Form::text('guardian_id', $data['row']->guardian_id) !!}--}}
                        @include($view_path.'.includes.form')
                        <div class="clearfix form-actions">
                            <div class="col-md-12 align-right">
                                <button class="btn btn-info" type="submit">
                                    <i class="fa fa-save bigger-110"></i>
                Update
                                </button>
                            </div>
                        </div>
                        <div class="hr hr-24"></div>
                        {!! Form::close() !!}
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->


@endsection

@section('js')
    @include('includes.scripts.jquery_validation_scripts')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">

        function loadSemesters($this) {

            $.ajax({
                type: 'POST',
                url: '{{ route('student.find-semester') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    faculty_id: $this.value
                },
                success: function (response) {
                    var data = $.parseJSON(response);
                    if (data.error) {
                        $.notify(data.message, "warning");
                    } else {
                        $('.semester_select').html('').append('<option value="0">Select Sem./Sec.</option>');
                        $.each(data.semester, function(key,valueObj){
                            $('.semester_select').append('<option value="'+valueObj.id+'">'+valueObj.semester+'</option>');
                        });
                    }
                }
            });

        }

        $(document).ready(function () {
            jqueryValidation(
                {
                    "reg_no": {
                        required: true,
                    },
                    "reg_date": {
                        required: true,
                    },
                    "first_name": {
                        required: true,
                    },
                    "last_name": {
                        required: true,
                    },
                    "first_name_devnagrik": {
                        required: true,
                    },
                    "last_name_devnagrik": {
                        required: true,
                    },
                    "date_of_birth": {
                        required: true,
                    },
                    "gender": {
                        required: true,
                    },
                    "nationality": {
                        required: true,
                    },
                    "religion": {
                        required: true,
                    },
                    "permanent_place": {
                        required: true,
                    },
                    "permanent_district": {
                        required: true,
                    },
                    "permanent_zone": {
                        required: true,
                    },
                    "permanent_country": {
                        required: true,
                    },
                    "mobile_1": {
                        required: true,
                    },
                    "grandfather_first_name": {
                        required: true,
                    },
                    "grandfather_last_name": {
                        required: true,
                    },
                    "father_first_name": {
                        required: true,
                    },
                    "father_last_name": {
                        required: true,
                    },
                    "father_occupation": {
                        required: true,
                    },
                    "father_mobile_1": {
                        required: true,
                    },
                    "mother_first_name": {
                        required: true,
                    },
                    "mother_last_name": {
                        required: true,
                    },
                    "mother_occupation": {
                        required: true,
                    },
                    "mother_mobile_1": {
                        required: true,
                    },
                    "guardian_first_name": {
                        required: true,
                    },
                    "guardian_last_name": {
                        required: true,
                    },
                    "guardian_occupation": {
                        required: true,
                    },
                    "guardian_mobile_1": {
                        required: true,
                    },
                    "guardian_relation": {
                        required: true,
                    },
                    "guardian_address": {
                        required: true,
                    },
                },
                {
                    "reg_no": {
                        required: "Fill Reg. No.",
                    },
                    "reg_date": {
                        required: "Fill Reg. Date",
                    },
                    "first_name": {
                        required: "Fill First Name",
                    },
                    "last_name": {
                        required: "Fill  Last Name",
                    },
                    "first_name_devnagrik": {
                        required: "पहिलो नाम भर्नुहोस",
                    },
                    "last_name_devnagrik": {
                        required: "थर भर्नुहोस",
                    },
                    "date_of_birth": {
                        required: "Fill Date of Birth",
                    },
                    "gender": {
                        required: "Choose Gender",
                    },
                    "nationality": {
                        required: "Fill  Nationality",
                    },
                    "religion": {
                        required: "Fill  Religion",
                    },
                    "permanent_place": {
                        required: "Fill  Place",
                    },
                    "permanent_district": {
                        required: "Fill District",
                    },
                    "permanent_zone": {
                        required: "Fill  Zone",
                    },

                    "permanent_country": {
                        required: "Fill  Country",
                    },
                    "mobile_1": {
                        required: "Fill  Mobile 1",
                    },
                    "grandfather_first_name": {
                        required: "Fill Grand Father First Name",
                    },
                    "grandfather_last_name": {
                        required: "Fill Grand Father Last Name",
                    },
                    "father_first_name": {
                        required: "Fill Father First Name",
                    },
                    "father_last_name": {
                        required: "Fill Father Last Name",
                    },
                    "father_occupation": {
                        required: "Fill Father Occupation",
                    },
                    "father_mobile_1": {
                        required: "Fill Father Mobile 1",
                    },
                    "mother_first_name": {
                        required: "Fill Mother First Name",
                    },
                    "mother_last_name": {
                        required: "Fill Mother Last Name",
                    },
                    "mother_occupation": {
                        required: "Fill Mother Occupation",
                    },
                    "mother_mobile_1": {
                        required: "Fill Mother Mobile 1",
                    },
                    "guardian_first_name": {
                        required: "Fill Guardian First Name",
                    },
                    "guardian_last_name": {
                        required: "Fill Guardian Last Name",
                    },
                    "guardian_occupation": {
                        required: "Fill Guardian Occupation",
                    },
                    "guardian_mobile_1": {
                        required: "Fill Guardian Mobile 1",
                    },
                    "guardian_relation": {
                        required: "Fill Guardian Relation",
                    },
                    "guardian_address": {
                        required: "Fill Guardian Address",
                    },
                }
            );
        });

        $(function() {
            $('#faculty').change(function(){
                $('#row_dim').hide();

            });
        });

        $(function() {
            $('#faculty').hide();
            $('#type').change(function(){
                if($('#type').val() == 'parcel') {
                    $('#row_dim').show();
                } else {
                    $('#row_dim').hide();
                }
            });
        });

        /*Change Field Value on Capital Letter When Keyup*/
        $(function() {
            $('.upper').keyup(function() {
                this.value = this.value.toUpperCase();
            });
        });
        /*end capital function*/


        /*copy permanent address on temporary address*/
        function CopyAddress(f) {
            if(f.permanent_address_copier.checked == true) {
                f.temporary_place.value = f.permanent_place.value;
                f.temporary_district.value = f.permanent_district.value;
                f.temporary_zone.value = f.permanent_zone.value;
                f.temporary_country.value = f.permanent_country.value;
            }
        }

        /*copy Father Detail on Guardian Detail*//*guardian_is*/
        function FatherAsGuardian(f) {
            if(f.guardian_is.value == 'father_as_guardian') {
                f.guardian_first_name.value = f.father_first_name.value;
                f.guardian_middle_name.value = f.father_middle_name.value;
                f.guardian_last_name.value = f.father_last_name.value;
                f.guardian_eligibility.value = f.father_eligibility.value;
                f.guardian_occupation.value = f.father_occupation.value;
                f.guardian_office.value = f.father_office.value;
                f.guardian_office_number.value = f.father_office_number.value;
                f.guardian_residence_number.value = f.father_residence_number.value;
                f.guardian_mobile_1.value = f.father_mobile_1.value;
                f.guardian_mobile_2.value = f.father_mobile_2.value;
                f.guardian_relation.value = "FATHER";
                f.mother_as_guardian.checked == false;
                f.other_guardian.checked == false;
            }
        }

        /*copy Mother Detail on Guardian Detail*/
        function MotherAsGuardian(f) {
            if(f.guardian_is.value == 'mother_as_guardian') {
                f.guardian_first_name.value = f.mother_first_name.value;
                f.guardian_middle_name.value = f.mother_middle_name.value;
                f.guardian_last_name.value = f.mother_last_name.value;
                f.guardian_eligibility.value = f.mother_eligibility.value;
                f.guardian_occupation.value = f.mother_occupation.value;
                f.guardian_office.value = f.mother_office.value;
                f.guardian_office_number.value = f.mother_office_number.value;
                f.guardian_residence_number.value = f.mother_residence_number.value;
                f.guardian_mobile_1.value = f.mother_mobile_1.value;
                f.guardian_mobile_2.value = f.mother_mobile_2.value;
                f.guardian_relation.value = "MOTHER";
                f.father_as_guardian.checked == false;
                f.other_guardian.checked == false;
            }
        }

        /*Blank Guardian Detail to Enter New*/
        function OtherGuardian(f) {
            if(f.guardian_is.value == 'other_guardian') {
                f.guardian_first_name.value = "";
                f.guardian_middle_name.value = "";
                f.guardian_last_name.value = "";
                f.guardian_eligibility.value = "";
                f.guardian_occupation.value = "";
                f.guardian_office.value = "";
                f.guardian_office_number.value = "";
                f.guardian_residence_number.value = "";
                f.guardian_mobile_1.value = "";
                f.guardian_mobile_2.value = "";
                f.guardian_relation.value = "";
                f.father_as_guardian.checked == false;
                f.mother_as_guardian.checked == false;
            }
        }

    </script>
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.datepicker_script')

@endsection


