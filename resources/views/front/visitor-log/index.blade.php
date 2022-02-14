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
                        @include($view_path.'.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Detail
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                <div class="row">
                    @include('front.includes.buttons')
                    <div class="col-xs-12 ">
                     @include($view_path.'.includes.buttons')
                        <hr class="hr-6">
                        @include('includes.flash_messages')
                        @include('includes.validation_error_messages')

                        @include($view_path.'.includes.search_form')

                        <!-- PAGE CONTENT BEGINS -->
                        @include($view_path.'.includes.table')
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
/*'name', 'phone', 'email', 'id_doc', 'id_num', 'in_time', 'out_time', 'status'*/

                var purpose = $('select[name="purpose"]').val();
                var start_date = $('input[name="start_date"]').val();
                var end_date = $('input[name="end_date"]').val();
                var token = $('input[name="token"]').val();
                var name = $('input[name="name"]').val();
                var phone = $('input[name="phone"]').val();
                var email = $('input[name="email"]').val();
                var id_doc = $('input[name="id_doc"]').val();
                var id_num = $('input[name="id_num"]').val();

                var status = $('select[name="status"]').val();

                var in_time = $('input[name="in_time"]').val();
                var out_time = $('input[name="out_time"]').val();


                if (token !== '') {
                    url += '?token=' + token;
                    flag = true;
                }

                if (purpose > 0 || purpose !=='') {
                    if (flag) {
                        url += '&purpose=' + purpose;
                    } else {
                        url += '?purpose=' + purpose;
                        flag = true;
                    }
                }

                if (name !== '') {
                    if (flag) {
                        url += '&name=' + name;
                    } else {
                        url += '?name=' + name;
                        flag = true;
                    }
                }

                if (phone !== '') {
                    if (flag) {
                        url += '&phone=' + phone;
                    } else {
                        url += '?phone=' + phone;
                        flag = true;
                    }
                }

                if (email !== '') {
                    if (flag) {
                        url += '&email=' + email;
                    } else {
                        url += '?email=' + email;
                        flag = true;
                    }
                }

                if (id_doc !== '') {
                    if (flag) {
                        url += '&id_doc=' + id_doc;
                    } else {
                        url += '?id_doc=' + id_doc;
                        flag = true;
                    }
                }

                if (id_num !== '') {
                    if (flag) {
                        url += '&id_num=' + id_num;
                    } else {
                        url += '?id_num=' + id_num;
                        flag = true;
                    }
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

                if (in_time !== '') {
                    if (flag) {
                        url += '&in_time=' + in_time;
                    } else {
                        url += '?in_time=' + in_time;
                        flag = true;
                    }
                }

                if (out_time !== '') {
                    if (flag) {
                        url += '&out_time=' + out_time;
                    } else {
                        url += '?out_time=' + out_time;
                        flag = true;
                    }
                }

                if (status !== 'all') {
                    if (flag) {
                        url += '&status=' + status;
                    } else {
                        url += '?status=' + status;
                        flag = true;
                    }
                }

                if(flag){
                    location.href = url;
                }else{
                    toastr.warning('No any Target to Filter Record.', 'Warning:');
                    return false;
                }

            });


        });

    </script>

    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.datepicker_script')
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.inputMask_script')
@endsection