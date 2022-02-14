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
                        @include('examination.mark-sheet.includes.breadcrumb-primary')
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
                        @include('examination.mark-sheet.includes.form')
                    </div>

                    <div class="col-md-12 col-xs-12">
                        @include('examination.mark-sheet.includes.table')
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
            $('.print-marksheets').click(function () {
                /*console.log('ok');
                return false;*/
                $grading = $('#typeGrading').is(':checked');
                $percentage = $('#typePercentage').is(':checked');
                $ledger = $('#typeLedger').is(':checked');
                //return false;
                if($grading || $percentage || $ledger){
                    $chkIds = document.getElementsByName('chkIds[]');
                    var $chkCount = 0;
                    $length = $chkIds.length;

                    for(var $i = 0; $i < $length; $i++){
                        if($chkIds[$i].type == 'checkbox' && $chkIds[$i].checked){
                            $chkCount++;
                        }
                    }

                    if($chkCount <= 0){
                        toastr.info("Please, Select At Least One Record.","Info:");
                        return false;
                    }

                    $('#print-student-marksheet').submit();

                }else{
                    toastr.info("Please, Select Result Your Target Result Type - Grading or Percentage.","Info:");
                    return false;
                }

            });

        });

        function loadSemesters($this) {
            var year = $('select[name="years_id"]').val();
            var month = $('select[name="months_id"]').val();
            var exam = $('select[name="exams_id"]').val();
            var faculty = $('select[name="faculty"]').val();

            if (year == 0) {
                toastr.info("Please, Select Year", "Info:");
                return false;
            }

            if (month == 0) {
                toastr.info("Please, Select Month", "Info:");
                return false;
            }

            if (exam == 0) {
                toastr.info("Please, Select Exam Type", "Info:");
                return false;
            }

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
                        toastr.success(data.success, "Success:");
                    }
                }
            });

        }

        function loadStudent($this) {
            var url = '{{ $data['url'] }}';
            var flag = false;
            var year = $('select[name="years_id"]').val();
            var month = $('select[name="months_id"]').val();
            var exam = $('select[name="exams_id"]').val();
            var faculty = $('select[name="faculty"]').val();
            var semester = $('select[name="semester_select"]').val();

            if (year !== 0) {
                url += '?year=' + year;
                flag = true;
            }else{
                toastr.info('Please Select Year','Info:');
                return false;
            }

            if (month !== 0) {
                if (flag) {
                    url += '&month=' + month;
                } else {
                    url += '?month=' + month;
                    flag = true;
                }
            }else{
                toastr.info('Please Select Schedule Exam','Info:');
                return false;
            }


            if (exam !== 0) {
                if (flag) {
                    url += '&exam=' + exam;
                } else {
                    url += '?exam=' + exam;
                    flag = true;
                }
            }else{
                toastr.info('Please Select Schedule Exam','Info:');
                return false;
            }

            if (faculty !== 0) {
                if (flag) {
                    url += '&faculty=' + faculty;
                } else {
                    url += '?faculty=' + faculty;
                    flag = true;
                }
            }else{
                toastr.info('Please Select Faculty/Class','Info:');
                return false;
            }

            if (semester !== 0) {
                if (flag) {
                    url += '&semester=' + semester;
                } else {
                    url += '?semester=' + semester;
                    flag = true;
                }
            }else{
                toastr.info('Please Select Sem./Sec.','Info:');
                return false;
            }


            if(flag == true){
                location.href = url;
            }else{
                toastr.info("Please, Select Your Target Schedule", "Info:");
                return false;
            }

        }

    </script>
    @include('includes.scripts.jquery_validation_scripts')
    @include('includes.scripts.dataTable_scripts')
@endsection