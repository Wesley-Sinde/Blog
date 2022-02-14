@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
    <!-- page specific plugin styles -->
    <link href="https://fonts.googleapis.com/css?family=Lobster|Righteous" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fugaz+One|Lobster|Merienda|Righteous" rel="stylesheet">
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
                    <div class="col-xs-12 hidden-print ">
                    @include('includes.flash_messages')

                    @include($view_path.'.includes.buttons')

                    <div class="hr hr-18 dotted hr-double"></div>

                    @include($view_path.'.detail.includes.form')
                    </div>
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            @include($view_path.'.detail.includes.table')
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->

            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    @include('includes.scripts.jquery_validation_scripts')
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
            var tr_start_date = $('input[name="tr_start_date"]').val();
            var tr_end_date = $('input[name="tr_end_date"]').val();

            if (tr_start_date !== '') {

                if (flag) {

                    url += '&tr-start-date=' + tr_start_date;

                } else {

                    url += '?tr-start-date=' + tr_start_date;
                    flag = true;

                }
            }

            if (tr_end_date !== '') {

                if (flag) {

                    url += '&tr-end-date=' + tr_end_date;

                } else {

                    url += '?tr-end-date=' + tr_end_date;
                    flag = true;

                }
            }

            location.href = url;

        });
    </script>
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.datepicker_script')

    @endsection