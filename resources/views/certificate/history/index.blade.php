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
                        @include($view_path.'.history.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            History
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                     @include($view_path.'.includes.buttons')
                        <hr class="hr-6">
                        @include('includes.flash_messages')
                        <div class="form-horizontal">
                        @include($view_path.'.history.includes.form')
                        <!-- PAGE CONTENT BEGINS -->
                            @include($view_path.'.history.includes.table')
                        </div>
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
                @include('student.includes.common-script.student_filter_common_script')

                var history_type = $('select[name="history_type"]').val();
                var start_date = $('input[name="start_date"]').val();
                var end_date = $('input[name="end_date"]').val();

                if (start_date !== '') {
                    if (flag) {
                        url += '&start-date=' + start_date;
                    } else {
                        url += '?start-date=' + start_date;
                        flag = true;
                    }
                }

                if (end_date !== '') {
                    if (flag) {
                        url += '&end-date=' + end_date;
                    } else {
                        url += '?end-date=' + end_date;
                        flag = true;
                    }
                }

                if (history_type !== '') {
                    if (flag) {
                        url += '&history_type=' + history_type;
                    } else {
                        url += '?history_type=' + history_type;
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


    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.datepicker_script')

@endsection