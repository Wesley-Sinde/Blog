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
                            Detail
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('attendance.includes.buttons')
                    <div class="col-xs-12 ">
                        @include($view_path.'.includes.buttons')
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            @include($view_path.'.includes.search_form')
                            <div class="hr hr-18 dotted hr-double"></div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                @include($view_path.'.includes.table')
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection


@section('js')

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

        function loadSubject($this) {
            $('#student_wrapper').empty();
            var faculty = $('select[name="faculty"]').val();
            var semester = $('select[name="semester_select"]').val();

            if (faculty == 0) {
                toastr.info("Please, Select Faculty/Class", "Info:");
                return false;
            }

            if (semester == 0) {
                toastr.info("Please, Select Sem./Sec.", "Info:");
                return false;
            }

            if (!semester)
                toastr.warning("Please, Choose Semester.", "Warning");
            else {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('attendance.subject.find-subject') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        faculty_id: faculty,
                        semester_id: semester
                    },
                    success: function (response) {
                        var data = $.parseJSON(response);
                        /*if (data.error) {
                            $('.sem_subject').html('');
                            toastr.warning(data.error, "Warning:");
                        } else {
                            $('.sem_subject').html('').append('<option value="0">Select Subject</option>');
                            $.each(data.subjects, function (key, valueObj) {
                                $('.sem_subject').append('<option value="' + valueObj.id + '">' + valueObj.title + '- ['+ valueObj.code+ ']' + '</option>');
                            });
                            //toastr.success(data.success, "Success:");
                        }*/

                        if (data.error) {
                            $('.sem_subject').html('');
                            toastr.warning(data.error, "Warning:");
                        } else {
                            $('.sem_subject').html('').append('<option value="0">Select Subject</option>');
                            $.each(data.subjects, function (key, valueObj) {
                                $('.sem_subject').append('<option value="' + key + '">' + valueObj + '</option>');
                            });
                            toastr.success(data.success, "Success:");
                        }
                    }
                });
            }

        }

        $(document).ready(function () {
            $('#filter-btn').click(function () {
                        @include('student.includes.common-script.student_filter_common_script')

                var year = $('select[name="year"]').val();
                var month = $('select[name="month"]').val();
                var sem_subject = $('select[name="sem_subject"]').val();
                var attendance_type = $('select[name="attendance_type"]').val();

                if (year !== '' &  year > 0) {

                    if (flag) {
                        url += '&year=' + year;
                    } else {
                        url += '?year=' + year;
                        flag = true;
                    }
                }

                if (month !== '' &  month > 0) {

                    if (flag) {
                        url += '&month=' + month;
                    } else {
                        url += '?month=' + month;
                        flag = true;
                    }
                }


                if (sem_subject !== '' & sem_subject >0) {

                    if (flag) {

                        url += '&sem_subject=' + sem_subject;

                    } else {

                        url += '?sem_subject=' + sem_subject;
                        flag = true;

                    }
                }

                if (attendance_type !== '' & attendance_type >0) {

                    if (flag) {

                        url += '&attendance_type=' + attendance_type;

                    } else {

                        url += '?attendance_type=' + attendance_type;
                        flag = true;

                    }
                }

                location.href = url;
            });
        });

    </script>
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.datepicker_script')

@endsection