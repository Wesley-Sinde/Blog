@extends('layouts.master')

@section('css')
    @include('print.includes.print-layout')
@endsection


@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header hidden-print">
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
                    @include('account.report.includes.buttons')
                    @include('includes.flash_messages')
                    <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            @include($view_path.'.includes.search_form')
                            {{--<div class="hr hr-18 dotted hr-double"></div>--}}
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="col-sm-12 align-right hidden-print">
                    <a href="#" class="btn-primary btn-lg" onclick="window.print();">
                        <i class="ace-icon fa fa-print"></i> Print
                    </a>
                </div>
                <div class="space-32 hidden-print"></div>
                @include('print.includes.institution-detail')
                @if(isset($data))
                    @include($view_path.'.includes.table')
                @endif
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection


@section('js')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">

        $(document).ready(function () {
            $('#filter-btn').click(function () {
               /* var url = '{{ $data['url'] }}';
                var flag = false;*/
                @include('student.includes.common-script.student_filter_common_script')
                //var report_type = $('select[name="report_type"]').val();
                var payment_mode = $('select[name="payment_mode"]').val();
                var start_date = $('input[name="start_date"]').val();
                var end_date = $('input[name="end_date"]').val();
                var fee_heads = $('select[name="fee_heads"]').val();

                /*if (report_type !== '') {
                    url += '?report_type=' + report_type;
                    flag = true;
                }
                */
                if (payment_mode !== '') {
                    url += '?payment_mode=' + payment_mode;
                    flag = true;
                }

                if (start_date !== '') {

                    if (flag) {

                        url += '&start_date=' + start_date;

                    } else {

                        url += '?start_date=' + start_date;
                        flag = true;

                    }
                }

                if (end_date !== '') {

                    if (flag) {

                        url += '&end_date=' + end_date;

                    } else {

                        url += '?end_date=' + end_date;
                        flag = true;

                    }
                }

                if (fee_heads > 0) {
                    if (flag) {
                        url += '&fee_heads=' + fee_heads;
                    } else {
                        url += '?fee_heads=' + fee_heads;
                        flag = true;
                    }
                }

                location.href = url;
            });


        });

    </script>
    @include('includes.scripts.datepicker_script')
@endsection