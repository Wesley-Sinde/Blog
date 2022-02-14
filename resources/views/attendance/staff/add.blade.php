@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
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
                            Add
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                <div class="row">
                    @include('attendance.includes.buttons')
                    <div class="col-xs-12 ">
                    @include($view_path.'.includes.buttons')
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->

                         {!! Form::open(['route' => $base_route.'.store', 'method' => 'POST', 'class' => 'form-horizontal',
                                                  'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
                            @include($view_path.'.includes.form')

                            @include($view_path.'.includes.staff')

                            <div class="form-group">

                                <label class="pos-rel">
                                    {!! Form::radio('send_alert', 1, false, ['class' => 'ace', "required"]) !!}
                                    <span class="lbl"></span> <span class="label label-info" >Send Attendance Alert to All </span>
                                </label>

                                <label class="pos-rel">
                                    {!! Form::radio('send_alert', 2, false, ['class' => 'ace', "required"]) !!}
                                    <span class="lbl"></span> <span class="label label-danger" >Send Absent Notification </span>
                                </label>

                                <label class="pos-rel">
                                    {!! Form::radio('send_alert', 3, false, ['class' => 'ace', "required"]) !!}
                                    <span class="lbl"></span> <span class="label label-danger" >Send Absent Alert to Heads</span>
                                </label>

                                <label class="pos-rel">
                                    {!! Form::radio('send_alert', 0, true, ['class' => 'ace', "required"]) !!}
                                    <span class="lbl"></span> <span class="label label-warning" >Alert Not Required</span>
                                </label>

                            </div>
                                <label class="pos-rel">
                                    <span class="lbl"></span> <span class="label label-success" >
                                            If you want to Send Absent Alert to Heads, manage Heads Number on STAFF_ABSENT_NOTIFICATION_HEAD_NUMBERS Variable in .env
                                        </span>
                                </label>
                            <div class="clearfix form-actions">
                                <div class="col-md-12 align-right">
                                    <button class="btn" type="reset">
                                        <i class="fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>
                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn btn-info" type="submit" id="submit-attendance">
                                        <i class="fa fa-save bigger-110"></i>
                                        Save Attendance
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
        $(document).ready(function () {
            $( "input[name=mark-all]" ).on( "change", function($this){
                status = $( "input[name=mark-all]:checked").val();
                if(status == 1){
                    $(this).closest('table').find("input:radio.status-1")
                        .each(function(){
                            $(".status-1").prop("checked", true);
                        });
                }else if(status == 2){
                    $(this).closest('table').find("input:radio.status-1")
                        .each(function(){
                            $(".status-2").prop("checked", true);
                        });
                }else if(status == 3){
                    $(this).closest('table').find("input:radio.status-1")
                        .each(function(){
                            $(".status-3").prop("checked", true);
                        });
                }else if(status == 4){
                    $(this).closest('table').find("input:radio.status-1")
                        .each(function(){
                            $(".status-4").prop("checked", true);
                        });
                }else if(status == 5){
                    $(this).closest('table').find("input:radio.status-1")
                        .each(function(){
                            $(".status-5").prop("checked", true);
                        });
                }else{

                }
            });

        });

        function loadStaff($this) {
            var date = $('input[name="date"]').val();
            var designation = $('select[name="designation"]').val();

            if (date == "") {
                toastr.info("Please, Select Date", "Info:");
                return false;
            }

            /*if (designation == 0) {
                toastr.info("Please, Select Designation", "Info:");
                return false;
            }*/

            $.ajax({
                type: 'POST',
                url: '{{ route('attendance.staff-html') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    date: date,
                    designation_id: designation
                },
                success: function (response) {
                    var data = $.parseJSON(response);
                    if(data.error){
                        toastr.warning(data.error, "Warning:");
                    }else{
                        if(data.exist){
                            $('#staff_wrapper').empty();
                            $('#staff_wrapper').append(data.exist);
                            $('#staffsTable tr:last').after(data.staffs);
                        }else{
                            toastr.success(data.message, "Success:");
                            $('#staff_wrapper').empty();
                            $('#staff_wrapper').append(data.staffs);
                        }
                    }
                }
            });
        }

        /*Schedule Now*/
        $('#submit-attendance').click(function () {
            var date = $('input[name="date"]').val();
            var designation = $('select[name="designation"]').val();

            if (date == "") {
                toastr.info("Please, Select Date", "Info:");
                return false;
            }

            /*if (designation == 0) {
                toastr.info("Please, Select Designation", "Info:");
            }*/

            location.href = url;

        });
        /*End Schedule Now*/
    </script>

@endsection