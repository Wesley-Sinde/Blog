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
                            Alert
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                <div class="row">
                    @include('attendance.includes.buttons')
                    <div class="col-xs-12 ">
                    @include($view_path.'.includes.buttons')
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->

                         {!! Form::open(['route' => $base_route.'.alert-send', 'method' => 'POST', 'class' => 'form-horizontal',
                                                  'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
                        <h4 class="header large lighter blue"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search Student</h4>
                        <div class="form-horizontal">
                            <div class="form-group">
                                {!! Form::label('Date', 'Date', ['class' => 'col-sm-1 control-label']) !!}
                                <div class=" col-sm-2">
                                    <div class="input-group ">
                                        {!! Form::text('date', null, ["placeholder" => "YYYY-MM-DD", "class" => "input-sm form-control border-form input-mask-date date-picker", "data-date-format" => "yyyy-mm-dd","required", "onChange"=>"loadStudent(this);"]) !!}
                                        @include('includes.form_fields_validation_message', ['name' => 'date'])
                                    </div>
                                </div>

                                <label class="col-sm-2 control-label">Faculty/Class</label>
                                <div class="col-sm-4">
                                    {!! Form::select('faculty', $data['faculties'], null, ['class' => 'form-control chosen-select', 'onChange' => 'loadSemesters(this);']) !!}

                                </div>

                                <label class="col-sm-1 control-label">Sem./Sec.</label>
                                <div class="col-sm-2">
                                    <select name="semester_select" class="form-control semester_select" onChange ="loadSubject(this)">
                                        <option> Select Sem./Sec. </option>
                                    </select>
                                </div>
                            </div>
                            <div class="hr hr-18 dotted hr-double"></div>
                        </div>
                        <!-- Option Values -->
                       {{-- <div class="form-group">

                            <label class="pos-rel">
                                {!! Form::radio('send_alert', 1, false, ['class' => 'ace', "required"]) !!}
                                <span class="lbl"></span> <span class="label label-info" >Send Attendance Alert to All </span>
                            </label>

                            <label class="pos-rel">
                                {!! Form::radio('send_alert', 2, false, ['class' => 'ace', "required"]) !!}
                                <span class="lbl"></span> <span class="label label-danger" >Send Absent Notification </span>
                            </label>

                            <label class="pos-rel">
                                {!! Form::radio('send_alert', 0, true, ['class' => 'ace', "required"]) !!}
                                <span class="lbl"></span> <span class="label label-warning" >Alert Not Required</span>
                            </label>
                        </div>--}}

                            <div class="clearfix form-actions">
                                <div class="col-md-12 align-right">
                                    <button class="btn" type="reset">
                                        <i class="fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>
                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn btn-info" type="submit" id="submit-attendance">
                                        <i class="fa fa-send bigger-110"></i>
                                        Send Subject Attendance Alert
                                    </button>
                                </div>
                            </div>

                            <div class="hr hr-24"></div>

                            {!! Form::close() !!}
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
   @include('includes.scripts.datepicker_script')

    <script>

        function loadSemesters($this) {
            var faculty = $('select[name="faculty"]').val();

            if (faculty == 0) {
                toastr.info("Please, Select Faculty/Class", "Info:");
                return false;
            }

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
                        toastr.warning(data.error, "Warning");
                    } else {
                        $('.semester_select').html('').append('<option value="0">Select Sem./Sec.</option>');
                        $.each(data.semester, function(key,valueObj){
                            $('.semester_select').append('<option value="'+valueObj.id+'">'+valueObj.semester+'</option>');
                        });
                       // toastr.success(data.success, "Success:");
                    }
                }
            });

        }

        /*Submit Now*/
        $('#submit-attendance').click(function () {
            var date = $('input[name="date"]').val();
            var faculty = $('select[name="faculty"]').val();
            var semester = $('select[name="semester_select"]').val();

            if (date == "") {
                toastr.info("Please, Select Date", "Info:");
                return false;
            }

            if (faculty == 0) {
                toastr.info("Please, Select Faculty/Class", "Info:");
                return false;
            }

            if (semester == 0) {
                toastr.info("Please, Select Sem./Sec.", "Info:");
                return false;
            }

            location.href = url;

        });
        /*End Submit Now*/
    </script>

@endsection