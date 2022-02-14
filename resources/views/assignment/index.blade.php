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
                    @include('assignment.includes.buttons')
                    <div class="col-xs-12 ">
                        @include('includes.flash_messages')
                        @include($view_path.'.includes.search_form')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            @include($view_path.'.includes.table')
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#filter-btn').click(function () {
                var url = '{{ $data['url'] }}';
                var flag = false;
                var year = $('select[name="years_id"]').val();
                var semesters_id = $('select[name="semesters_id"]').val();
                var subjects_id = $('select[name="subjects_id"]').val();
                var publish_date_start = $('input[name="publish_date_start"]').val();
                var publish_date_end = $('input[name="publish_date_end"]').val();

                if (year !== '' & year >0) {
                    if (flag) {
                        url += '&year=' + year;
                    } else {
                        url += '?year=' + year;
                        flag = true;
                    }
                }

                if (semesters_id !== '' & semesters_id >0) {
                    if (flag) {
                        url += '&semesters_id=' + semesters_id;
                    } else {
                        url += '?semesters_id=' + semesters_id;
                        flag = true;
                    }
                }

                if (subjects_id !== '' & subjects_id >0) {
                    if (flag) {
                        url += '&subjects_id=' + subjects_id;
                    } else {
                        url += '?subjects_id=' + subjects_id;
                        flag = true;
                    }
                }


                if (publish_date_start !== '') {
                    if (flag) {
                        url += '&publish_date_start=' + publish_date_start;
                    } else {
                        url += '?publish_date_start=' + publish_date_start;
                        flag = true;
                    }
                }

                if (publish_date_end !== '') {
                    if (flag) {
                        url += '&publish_date_end=' + publish_date_end;
                    } else {
                        url += '?publish_date_end=' + publish_date_end;
                        flag = true;
                    }
                }

                if(flag == true){
                    location.href = url;
                }else{
                    toastr.info("Please, Select Your Assignment Target", "Info:");
                    return false;
                }

            });
        });

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
                        $('.semesters_id').html('').append('<option value="0">Select Sem./Sec.</option>');
                        $.each(data.semester, function(key,valueObj){
                            $('.semesters_id').append('<option value="'+valueObj.id+'">'+valueObj.semester+'</option>');
                        });
                    }
                }
            });

        }

        function loadSubject($this) {
            var faculty = $('select[name="faculty"]').val();
            var semester = $('select[name="semesters_id"]').val();


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
                    url: '{{ route('assignment.find-subject') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        faculty_id: faculty,
                        semester_id: semester
                    },
                    success: function (response) {
                        var data = $.parseJSON(response);
                        if (data.error) {
                            $('.semester_subject').html('')
                            toastr.warning(data.error, "Warning:");
                        } else {
                            $('.semester_subject').html('').append('<option value="0">Select Subject</option>');
                            $.each(data.subjects, function (key, valueObj) {
                                $('.semester_subject').append('<option value="' + key + '">' + valueObj + '</option>');
                            });
                            toastr.success(data.success, "Success:");
                        }
                    }
                });
            }

        }

    </script>
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.datepicker_script')

@endsection