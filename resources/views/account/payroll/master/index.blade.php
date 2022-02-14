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
                @include($view_path.'.includes.payroll_table')
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.datepicker_script')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#filter-btn').click(function () {
                @include('staff.includes.common.staff_filter_common_script')

                var payroll_due_date_start = $('input[name="payroll_due_date_start"]').val();
                var payroll_due_date_end = $('input[name="payroll_due_date_end"]').val();
                var payroll_heads = $('select[name="payroll_heads"]').val();
                var amount_start = $('input[name="amount_start"]').val();
                var amount_end = $('input[name="amount_end"]').val();

                if (payroll_due_date_start !== '') {
                    if (flag) {
                        url += '&payroll_due_date_start=' + payroll_due_date_start;
                    } else {
                        url += '?payroll_due_date_start=' + payroll_due_date_start;
                        flag = true;
                    }
                }

                if (payroll_due_date_end !== '') {
                    if (flag) {
                        url += '&payroll_due_date_end=' + payroll_due_date_end;
                    } else {
                        url += '?payroll_due_date_end=' + payroll_due_date_end;
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

                if (amount_start !== '') {
                    if (flag) {
                        url += '&amount_start=' + amount_start;
                    } else {
                        url += '?amount_start=' + amount_start;
                        flag = true;
                    }
                }

                if (amount_end !== '') {
                    if (flag) {
                        url += '&amount_end=' + amount_end;
                    } else {
                        url += '?amount_end=' + amount_end;
                        flag = true;
                    }
                }

                location.href = url;
            });

            $('#load-fee-html').click(function () {

                $.ajax({
                    type: 'POST',
                    url: '{{ route('account.fees.master.fee-html') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        var data = $.parseJSON(response);

                        if (data.error) {
                            //$.notify(data.message, "warning");
                        } else {

                            $('#fee_wrapper').append(data.html);
                            $(document).find('option[value="0"]').attr("value", "");
                            //$(document).find('option[value="0"]').attr("disabled", "disabled");
                            //$.notify(data.message, "success");
                        }
                    }
                });

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
@endsection