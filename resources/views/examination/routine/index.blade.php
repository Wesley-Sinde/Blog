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
                        @include('examination.routine.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Print
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                    {{--@include('examination.admit-card.includes.buttons')--}}
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            {!! Form::open(['route' => 'print-out.exam.routine', 'id' => 'bulk_action_form']) !!}
                                @include('examination.routine.includes.form')
                            {!! Form::close() !!}
                            <div class="hr hr-18 dotted hr-double"></div>
                        </div>
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
        $(document).ready(function () {

            $('#print-btn').click(function () {
                var year = $('select[name="years_id"]').val();
                var month = $('select[name="months_id"]').val();
                var exam = $('select[name="exams_id"]').val();
                var faculty = $('select[name="target_faculty"]').val();
                var semester = $('select[name="semester_select"]').val();

                if (year == 0) {
                    toastr.info('Please Select Year','Info:');
                    return false;
                }

                if (month == 0) {
                    toastr.info('Please Select Month','Info:');
                    return false;
                }


                if (exam == 0) {
                    toastr.info('Please Select Schedule Exam','Info:');
                    return false;
                }

                if (faculty == 0) {
                    toastr.info('Please Select Faculty/Class','Info:');
                    return false;
                }

                if (semester == 0) {
                    toastr.info('Please Select Sem./Sec.','Info:');
                    return false;
                }

                //location.href = url;
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
    {{--@include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')--}}
    @include('includes.scripts.dataTable_scripts')
    {{--@include('includes.scripts.datepicker_script')--}}

    @endsection