@extends('layouts.master')

@section('css')
    <style type="text/css">
        element.style {
            width: auto !important;
        }
    </style>
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
                        @include('account.fees.includes.buttons')
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            {{--@include($view_path.'.includes.form')
                            <div class="hr hr-18 dotted hr-double"></div>--}}
                            @include($view_path.'.collect.includes.profile')
                            @include($view_path.'.collect.includes.fee_master_add_model')
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                @include($view_path.'.collect.includes.table')
            </div>
                @include($view_path.'.collect.includes.add_model')
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection

@section('js')
    @include('includes.scripts.jquery_validation_scripts')
    @include('includes.scripts.inputMask_script')
    @include('account.fees.collection.collect.includes.modal_values_script')
    @include('includes.scripts.alert_confirm')
    @include('includes.scripts.delete_confirm')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        /*Change Field Value on Capital Letter When Keyup*/
        $(function() {
            $('.upper').keyup(function() {
                this.value = this.value.toUpperCase();
            });
        });


        $(document).ready(function () {
            $('.chosen-container-single').css({'width': '380px'});


        });

    </script>
    <script>

        $('.bulk-action-btn').click(function () {
            $chkIds = document.getElementsByName('chkIds[]');
            var $chkCount = 0;
            $length = $chkIds.length;
            for (var $i = 0; $i < $length; $i++) {
                if ($chkIds[$i].type == 'checkbox' && $chkIds[$i].checked) {
                    $chkCount++;
                }
            }

            if ($chkCount <= 0) {
                toastr.info("Please, Select At Least One Record.", "Info:");
                return false;
            }

            var $this = $(this);
            var bulk_action = $this.attr('attr-action-type');
            var form = $('#bulk_action_form');
            $('#bulk_action_form').submit();

        });
    </script>

    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.datepicker_script')
@endsection