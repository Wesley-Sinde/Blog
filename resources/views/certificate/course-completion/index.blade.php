@extends('layouts.master')

@section('css')
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
                    <div class="col-xs-12 ">
                    @include('certificate.includes.buttons')
                    @include($view_path.'.includes.buttons')
                    @include('includes.flash_messages')
                    <!-- PAGE CONTENT BEGINS -->
                        @include('includes.validation_error_messages')
                        <div class="form-horizontal ">
                            @include($view_path.'.includes.search_form')
                            <div class="hr hr-18 dotted hr-double"></div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                @include($view_path.'.includes.table')
            </div>
        </div><!-- /.page-content -->
    </div>
    </div><!-- /.main-content -->
@endsection


@section('js')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#filter-btn').click(function () {
                @include('student.includes.common-script.student_filter_common_script')

                var issue_start_date = $('input[name="issue_start_date"]').val();
                var issue_end_date = $('input[name="issue_end_date"]').val();
                var character = $('input[name="character"]').val();
                var period = $('input[name="period"]').val();
                var course = $('input[name="course"]').val();

                if (issue_start_date !== '') {
                    if (flag) {
                        url += '&issue-start-date=' + issue_start_date;
                    } else {
                        url += '?issue-start-date=' + issue_start_date;
                        flag = true;
                    }
                }

                if (issue_end_date !== '') {
                    if (flag) {
                        url += '&issue-end-date=' + issue_end_date;
                    } else {
                        url += '?issue-end-date=' + issue_end_date;
                        flag = true;
                    }
                }


                if (character !== '') {
                    if (flag) {
                        url += '&character=' + character;
                    } else {
                        url += '?character=' + character;
                        flag = true;
                    }
                }

                if (period !== '') {
                    if (flag) {
                        url += '&period=' + period;
                    } else {
                        url += '?period=' + period;
                        flag = true;
                    }
                }

                if (course !== '') {
                    if (flag) {
                        url += '&course=' + course;
                    } else {
                        url += '?course=' + course;
                        flag = true;
                    }
                }

                location.href = url;
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
                        $('.semester_select').html('').append('<option value="0">Select Sem./Sec.</option>');
                        $.each(data.semester, function(key,valueObj){
                            $('.semester_select').append('<option value="'+valueObj.id+'">'+valueObj.semester+'</option>');
                        });
                    }
                }
            });
        }
    </script>

    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')
   @include('includes.scripts.datepicker_script')

@endsection