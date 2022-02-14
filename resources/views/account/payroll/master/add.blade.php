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
                            {{ $panel }} Add
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('account.includes.buttons')
                    <div class="col-xs-12 ">
                    @include('account.payroll.includes.buttons')
                    @include('includes.flash_messages')

                    @if (isset($data['row']) && $data['row']->count() > 0)
                        @include($base_route.'.includes.edit')
                        @else
                        <!-- PAGE CONTENT BEGINS -->
                            <div class="form-horizontal">
                                @include($view_path.'.includes.form')
                                <div class="hr hr-18 dotted hr-double"></div>
                            </div>
                        </div><!-- /.col -->
                        @include($base_route.'.includes.add')
                        @include($view_path.'.includes.table')
                    @endif
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
                    @include('staff.includes.common.staff_filter_common_script')
                location.href = url;
            });


            /*Add Payroll */
            $('#payroll-add-btn').click(function () {
                var payroll_head = $('select[name="payroll_head[]"]').val();

                if(payroll_head !== undefined) {
                    $chkIds = document.getElementsByName('chkIds[]');
                    var $chkCount = 0;
                    $length = $chkIds.length;

                    for(var $i = 0; $i < $length; $i++){
                        if($chkIds[$i].type == 'checkbox' && $chkIds[$i].checked){
                            $chkCount++;
                        }
                    }

                    if($chkCount <= 0){
                        toastr.warning("Please, Select At Least One Staff Record.");
                        return false;
                    }

                    var form = $('#salary_add_form');

                }else{
                    toastr.warning('Please, Add At Least One Payroll Head With Amount Detail.');
                    return false;
                }


            });
            /*Add Payroll End*/

            $('#load-payroll-html').click(function () {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('account.payroll.master.payroll-html') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        var data = $.parseJSON(response);

                        if (data.error) {
                            //$.notify(data.message, "warning");
                        } else {

                            $('#payroll_wrapper').append(data.html);
                            $(document).find('option[value="0"]').attr("value", "");
                            //$(document).find('option[value="0"]').attr("disabled", "disabled");
                            //$.notify(data.message, "success");
                        }
                    }
                });
            });
        });
    </script>
    @include('includes.scripts.jquery_validation_scripts')
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.table_tr_sort')
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.datepicker_script')
@endsection