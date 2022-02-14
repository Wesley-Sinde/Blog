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
                    @include($view_path.'.includes.buttons')
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            @include($view_path.'.includes.search_form')
                            <div class="hr hr-18 dotted hr-double"></div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                @include($view_path.'.includes.table')
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {

            $('#filter-btn').click(function () {

                var url = '{{ $data['url'] }}';
                var flag = false;
                var tr_head = $('select[name="tr_head"]').val();
                var tr_start_date = $('input[name="tr_start_date"]').val();
                var tr_end_date = $('input[name="tr_end_date"]').val();

                if (tr_head !== '') {
                    url += '?tr_head=' + tr_head;
                    flag = true;
                }

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

        });

    </script>
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.datepicker_script')
    @include('includes.scripts.dataTable_scripts')
@endsection