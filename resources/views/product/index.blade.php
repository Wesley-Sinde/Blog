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
                var category_id = $('select[name="category_id"]').val();
                var sub_category_id = $('select[name="sub_category_id"]').val();
                var warranty = $('input[name="warranty"]').val();
                var code = $('input[name="code"]').val();
                var name = $('input[name="name"]').val();
                /*var stock_from = $('input[name="stock_from"]').val();
                var stock_to = $('input[name="stock_to"]').val();*/
                var sale_price_from = $('input[name="sale_price_from"]').val();
                var sale_price_to = $('input[name="sale_price_to"]').val();

                var status = $('select[name="status"]').val();

                if (category_id !== '' && category_id > 0) {
                    url += '?category_id=' + category_id;
                    flag = true;
                }

                if (sub_category_id !== '' && sub_category_id > 0) {

                    if (flag) {

                        url += '&sub_category_id=' + sub_category_id;

                    } else {

                        url += '?sub_category_id=' + sub_category_id;
                        flag = true;

                    }
                }

                if (warranty !== '') {

                    if (flag) {

                        url += '&warranty=' + warranty;

                    } else {

                        url += '?warranty=' + warranty;
                        flag = true;

                    }
                }

                if (code !== '') {

                    if (flag) {

                        url += '&code=' + code;

                    } else {

                        url += '?code=' + code;
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

                /*if (stock_from !== '') {

                    if (flag) {

                        url += '&stock_from=' + stock_from;

                    } else {

                        url += '?stock_from=' + stock_from;
                        flag = true;

                    }
                }

                if (stock_to !== '') {

                    if (flag) {

                        url += '&stock_to=' + stock_to;

                    } else {

                        url += '?stock_to=' + stock_to;
                        flag = true;

                    }
                }*/

                if (sale_price_from !== '') {

                    if (flag) {

                        url += '&sale_price_from=' + sale_price_from;

                    } else {

                        url += '?sale_price_from=' + sale_price_from;
                        flag = true;

                    }
                }

                if (sale_price_to !== '') {

                    if (flag) {

                        url += '&sale_price_to=' + sale_price_to;

                    } else {

                        url += '?sale_price_to=' + sale_price_to;
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
    @include('product.registration.includes.product-comman-script')
 {{--   @include('includes.scripts.datepicker_script')--}}

    @endsection