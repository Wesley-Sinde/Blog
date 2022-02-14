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
                    <div class="col-xs-12 hidden-print">
                        @include('includes.flash_messages')

                        @include('account.transaction.includes.buttons')
                        {{--<div class="hr hr-18 dotted hr-double hidden-print"></div>--}}
                        @include($view_path.'.detail.includes.form')
                    </div>
                    <div class="col-sm-12 align-right hidden-print">
                        <a href="#" class="btn-primary btn-lg" onclick="window.print();">
                            <i class="ace-icon fa fa-print"></i> Print
                        </a>
                    </div>
                    <div class="space-32 hidden-print"></div>
                    <div class="col-xs-12">
                    @include('print.includes.institution-detail')
                    <!-- PAGE CONTENT BEGINS -->
                        @include($view_path.'.detail.includes.table')
                    </div>
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection


@section('js')
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.datepicker_script')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        /*Change Field Value on Capital Letter When Keyup*/
        $(function() {
            $('.upper').keyup(function() {
                this.value = this.value.toUpperCase();
            });
        });

        $('#filter-btn').click(function () {

            var url = '{{ $data['url'] }}';
            var flag = false;

            var tr_head = $('select[name="tr_head"]').val();

            if (tr_head >0) {
                if (flag) {
                    url += '&tr_head=' + tr_head;
                } else {
                    url += '?tr_head=' + tr_head;
                    flag = true;
                }
            }

            var tr_start_date = $('input[name="tr_start_date"]').val();
            var tr_end_date = $('input[name="tr_end_date"]').val();

            if (tr_start_date !== '') {

                if (flag) {

                    url += '&tr_start_date=' + tr_start_date;

                } else {

                    url += '?tr_start_date=' + tr_start_date;
                    flag = true;

                }
            }

            if (tr_end_date !== '') {

                if (flag) {

                    url += '&tr_end_date=' + tr_end_date;

                } else {

                    url += '?tr_end_date=' + tr_end_date;
                    flag = true;

                }
            }

            location.href = url;

        });
    </script>
    @include('includes.scripts.inputMask_script')
    {{--@include('includes.scripts.dataTable_scripts')--}}
    @include('includes.scripts.datepicker_script')

@endsection