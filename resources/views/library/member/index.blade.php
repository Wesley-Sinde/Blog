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
                    @include('library.includes.buttons')
                    <div class="col-xs-12 ">
                     @include($view_path.'.includes.buttons')
                        <hr class="hr-6">
                        @include('includes.flash_messages')
                        @include('includes.validation_error_messages')
                        @include($view_path.'.includes.search_form')
                        <!-- PAGE CONTENT BEGINS -->
                            @include($view_path.'.includes.table')
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {

            /*Change Field Value on Capital Letter When Keyup*/
            $(function() {
                $('.upper').keyup(function() {
                    this.value = this.value.toUpperCase();
                });
            });
            /*end capital function*/

            $('#filter-btn').click(function () {

                var url = '{{ $data['url'] }}';
                var flag = false;
                var user_type = $('select[name="user_type"]').val();
                var reg_no = $('input[name="reg_no"]').val();
                var status = $('select[name="status"]').val();

                if (user_type !== '' & user_type >0) {
                    url += '?user_type=' + user_type;
                    flag = true;
                }else{
                    toastr.warning('Please Select Type', 'Warning:');
                    return false;
                }

                if (reg_no !== '') {

                    if (flag) {

                        url += '&reg_no=' + reg_no;

                    } else {

                        url += '?reg_no=' + reg_no;
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
@endsection