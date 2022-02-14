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
                    @include('account.includes.buttons')
                    <div class="col-xs-12 ">
                        @include('account.payroll.includes.buttons')
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
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
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.datepicker_script')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $('#filter-btn').click(function () {
                    @include('staff.includes.common.staff_filter_common_script')

            var salary_pay_date_start = $('input[name="salary_pay_date_start"]').val();
            var salary_pay_date_end = $('input[name="salary_pay_date_end"]').val();
            var payroll_heads = $('select[name="payroll_heads"]').val();
            var payment_method = $('select[name="payment_method"]').val();

            if (salary_pay_date_start !== '') {
                if (flag) {
                    url += '&salary_pay_date_start=' + salary_pay_date_start;
                } else {
                    url += '?salary_pay_date_start=' + salary_pay_date_start;
                    flag = true;
                }
            }

            if (salary_pay_date_end !== '') {
                if (flag) {
                    url += '&salary_pay_date_end=' + salary_pay_date_end;
                } else {
                    url += '?salary_pay_date_end=' + salary_pay_date_end;
                    flag = true;
                }
            }

            if (payroll_heads > 0) {
                if (flag) {
                    url += '&payroll_heads=' + payroll_heads;
                } else {
                    url += '?payroll_heads=' + payroll_heads;
                    flag = true;
                }
            }

            if (payment_method !=="") {
                if (flag) {
                    url += '&payment_method=' + payment_method;
                } else {
                    url += '?payment_method=' + payment_method;
                    flag = true;
                }
            }


            location.href = url;
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
@endsection