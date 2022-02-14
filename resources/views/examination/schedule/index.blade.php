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
                    @include('examination.includes.buttons')
                    @include('includes.flash_messages')
                    <div class="col-md-12 col-xs-12">
                        @include($view_path.'.includes.buttons')
                        <div class="form-horizontal">
                            @include($view_path.'.includes.search_form')
                            <div class="hr hr-18 dotted hr-double"></div>
                        </div>
                    </div>

                    <div class="col-md-12 col-xs-12">
                        @include($view_path.'.includes.table')
                    </div>
                </div><!-- /.row -->

            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->



@endsection

@section('js')
    <!-- page specific plugin scripts -->

    <script>
        $(document).ready(function () {
            $('#filter-btn').click(function () {
                var url = '{{ $data['url'] }}';
                var flag = false;
                var year = $('select[name="years_id"]').val();
                var month = $('select[name="months_id"]').val();
                var exam = $('select[name="exams_id"]').val();
                var faculty = $('select[name="faculty"]').val();
                var semester = $('select[name="semester_select"]').val();

                if (year !== '' & year >0) {
                    if (flag) {
                        url += '&year=' + year;
                    } else {
                        url += '?year=' + year;
                        flag = true;
                    }
                }

                if (month !== '' & month >0) {
                    if (flag) {
                        url += '&month=' + month;
                    } else {
                        url += '?month=' + month;
                        flag = true;
                    }
                }

                if (exam !== '' & exam >0) {
                    if (flag) {
                        url += '&exam=' + exam;
                    } else {
                        url += '?exam=' + exam;
                        flag = true;
                    }
                }

                if (faculty !== '' & faculty >0) {
                    if (flag) {
                        url += '&faculty=' + faculty;
                    } else {
                        url += '?faculty=' + faculty;
                        flag = true;
                    }
                }

                if (semester !== '' & semester >0) {
                    if (flag) {
                        url += '&semester=' + semester;
                    } else {
                        url += '?semester=' + semester;
                        flag = true;
                    }
                }

                if(flag == true){
                    location.href = url;
                }else{
                    toastr.info("Please, Select Your Target Schedule", "Info:");
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
                        $('.semester_select').html('').append('<option value="0">Select Sem./Sec.</option>');
                        $.each(data.semester, function(key,valueObj){
                            $('.semester_select').append('<option value="'+valueObj.id+'">'+valueObj.semester+'</option>');
                        });
                    }
                }
            });

        }

    </script>
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.dataTable_scripts')
@endsection