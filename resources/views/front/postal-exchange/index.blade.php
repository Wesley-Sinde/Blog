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
                var ref_no = $('input[name="ref_no"]').val();
                var start_date = $('input[name="start_date"]').val();
                var end_date = $('input[name="end_date"]').val();
                var type = $('select[name="type"]').val();
                var subject = $('input[name="subject"]').val();
                var to = $('input[name="to"]').val();
                var from = $('input[name="from"]').val();



                if (ref_no !== '') {
                    url += '?ref_no=' + ref_no;
                    flag = true;
                }

                if (type > 0 || type !=='') {
                    if (flag) {
                        url += '&type=' + type;
                    } else {
                        url += '?type=' + type;
                        flag = true;
                    }
                }else{
                    toastr.warning('Please Select Postal Exchange Type', 'Warning:');
                    return false;
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

                if (subject !== '') {
                    if (flag) {
                        url += '&subject=' + subject;
                    } else {
                        url += '?subject=' + subject;
                        flag = true;
                    }
                }

                if (to !== '') {
                    if (flag) {
                        url += '&to=' + to;
                    } else {
                        url += '?to=' + to;
                        flag = true;
                    }
                }

                if (from !== '') {
                    if (flag) {
                        url += '&from=' + from;
                    } else {
                        url += '?from=' + from;
                        flag = true;
                    }
                }

                if(flag){
                    location.href = url;
                }else{
                    toastr.warning('No any Target to Search', 'Warning:');
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