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
                            List
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
                var reg_no = $('input[name="reg_no"]').val();
                var name = $('input[name="name"]').val();
                var email = $('input[name="email"]').val();
                var tel = $('input[name="tel"]').val();
                var mobile = $('input[name="mobile"]').val();

                var status = $('select[name="status"]').val();

                if (name !== '') {
                    url += '?name=' + name;
                    flag = true;
                }

                if (reg_no !== '') {

                    if (flag) {

                        url += '&reg_no=' + reg_no;

                    } else {

                        url += '?reg_no=' + reg_no;
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

                if (tel !== '') {

                    if (flag) {

                        url += '&tel=' + tel;

                    } else {

                        url += '?tel=' + tel;
                        flag = true;

                    }
                }

                if (mobile !== '') {

                    if (flag) {

                        url += '&mobile=' + mobile;

                    } else {

                        url += '?mobile=' + mobile;
                        flag = true;

                    }
                }


                if (status !== '' ) {

                    if (status !== 'all') {

                        if (flag) {

                            url += '&status=' + status;

                        } else {

                            url += '?status=' + status;

                        }

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
 {{--   @include('includes.scripts.datepicker_script')--}}

    @endsection