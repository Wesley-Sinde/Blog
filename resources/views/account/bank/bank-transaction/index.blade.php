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
                        @include('includes.flash_messages')

                        @include($view_path.'.includes.buttons')

                        @include($view_path.'.includes.search_form')
                        <!-- PAGE CONTENT BEGINS -->
                            <div class="form-horizontal">
                                @include($view_path.'.includes.table')
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

                var url = '{{ $data['url'] }}';
                var flag = false;
                var banks_id = $('select[name="banks_id"]').val();
                var tr_start_date = $('input[name="tr_start_date"]').val();
                var tr_end_date = $('input[name="tr_end_date"]').val();

                if (banks_id !== '') {
                    url += '?banks_id=' + banks_id;
                    flag = true;
                }

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


        });

    </script>
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.datepicker_script')
    @include('includes.scripts.dataTable_scripts')
@endsection