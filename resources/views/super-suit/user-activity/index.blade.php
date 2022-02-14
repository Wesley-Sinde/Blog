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
                    <div class="col-xs-12 ">
                        @include($view_path.'.includes.buttons')
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        @include('includes.validation_error_messages')
                        <div class="form-horizontal ">
                            @include($view_path.'.includes.form')
                            <div class="hr hr-18 dotted hr-double"></div>
                        </div>
                    </div><!-- /.col -->
                    @include($view_path.'.includes.table')
                </div><!-- /.row -->

            </div>
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    @include('includes.scripts.jquery_validation_scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/chosen.jquery.min.js') }}"></script>
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        /*Change Field Value on Capital Letter When Keyup*/
        $(function() {
            $('.upper').keyup(function() {
                this.value = this.value.toUpperCase();
            });
        });

        $(document).ready(function () {

            $('#filter-btn').click(function () {

                var url = '{{ $data['url'] }}';
                var flag = false;
                var ip = $('input[name="ip"]').val();
                var user_agent = $('input[name="user_agent"]').val();
                var link_url = $('input[name="url"]').val();
                var user = $('select[name="user"]').val();
                var event = $('select[name="event"]').val();
                var created_at_start_date = $('input[name="created_at_start_date"]').val();
                var created_at_end_date = $('input[name="created_at_end_date"]').val();
                var updated_at_start_date = $('input[name="updated_at_start_date"]').val();
                var updated_at_end_date = $('input[name="updated_at_end_date"]').val();

                if (ip !== '') {
                    url += '?ip=' + ip;
                    flag = true;
                }

                if (user_agent !== '') {

                    if (flag) {

                        url += '&user_agent=' + user_agent;

                    } else {

                        url += '?user_agent=' + user_agent;
                        flag = true;

                    }
                }



                if (user !== '' & user >0) {

                    if (flag) {

                        url += '&user=' + user;

                    } else {

                        url += '?user=' + user;
                        flag = true;

                    }
                }

                if (event !== '') {

                    if (flag) {

                        url += '&event=' + event;

                    } else {

                        url += '?event=' + event;
                        flag = true;

                    }
                }

                if (link_url !== '') {

                    if (flag) {

                        url += '&link_url=' + link_url;

                    } else {

                        url += '?link_url=' + link_url;
                        flag = true;

                    }
                }

                if (created_at_start_date !== '') {

                    if (flag) {

                        url += '&created_at_start_date=' + created_at_start_date;

                    } else {

                        url += '?created_at_start_date=' + created_at_start_date;
                        flag = true;

                    }
                }

                if (created_at_end_date !== '') {

                    if (flag) {

                        url += '&created_at_end_date=' + created_at_end_date;

                    } else {

                        url += '?created_at_end_date=' + created_at_end_date;
                        flag = true;

                    }
                }

                if (updated_at_start_date !== '') {

                    if (flag) {

                        url += '&updated_at_start_date=' + updated_at_start_date;

                    } else {

                        url += '?updated_at_start_date=' + updated_at_start_date;
                        flag = true;

                    }
                }

                if (updated_at_end_date !== '') {

                    if (flag) {

                        url += '&updated_at_end_date=' + updated_at_end_date;

                    } else {

                        url += '?updated_at_end_date=' + updated_at_end_date;
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
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.datepicker_script')

    @endsection