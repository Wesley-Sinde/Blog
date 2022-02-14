@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css') }}" />
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
                    @include('transport.includes.buttons')
                    <div class="col-xs-12 ">
                     @include($view_path.'.includes.buttons')
                        <hr class="hr-6">
                        @include('includes.flash_messages')
                        @include('includes.validation_error_messages')
                        {!! Form::open(['route' => $base_route, 'method' => 'GET', 'class' => 'form-horizontal',
                                        'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
                        @include($view_path.'.includes.search_form')
                        {!! Form::close() !!}
                        <!-- PAGE CONTENT BEGINS -->
                            @include($view_path.'.includes.table')
                            @include($view_path.'.includes.renew_model')
                            @include($view_path.'.includes.shift_model')
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

            /*Change Field Value on Capital Letter When Keyup*/
            $(function() {
                $('.upper').keyup(function() {
                    this.value = this.value.toUpperCase();
                });
            });
            /*end capital function*/

            $('#filter-btn').click(function () {
                var flag = false;
                var user_type = $('select[name="user_type"]').val();
                var reg_no = $('input[name="reg_no"]').val();
                var status = $('select[name="status"]').val();
                var route = $('select[name="route"]').val();
                var vehicle = $('select[name="vehicle_select"]').val();

                if (user_type !== '' & user_type >0) {
                    flag = true;
                }else{
                    toastr.warning('Please Select Type', 'Warning:')
                    return false;
                }

                if (reg_no !== '') {
                    flag = true;
                }


                if (status !== ''  && status > 0) {
                    flag = true;
                }

                if (route !== '' && route > 0 ) {
                    flag = true;
                }

                if (vehicle !== '' && vehicle > 0 ) {
                    flag = true;
                }

                if(flag){
                    return true;
                }else{
                    toastr.warning('No any Target to Search', 'Warning:')
                    return false;
                }
            });

            $('#renew-btn').click(function () {
                var flag = false;
                var route = $('select[name="route_assign"]').val();
                var vehicle = $('select[name="vehicle_assign"]').val();
                if (route > 0 && vehicle >0 ) {
                    return true;
                }else{
                    toastr.info('Please Select Route & Vehicle Correctly', 'Info:');
                    return false;
                }
            });

            $('#shift-btn').click(function () {
                var flag = false;
                var route = $('select[name="route_shift"]').val();
                var vehicle = $('select[name="vehicle_shift"]').val();
                if (route > 0 && vehicle >0 ) {
                    return true;
                }else{
                    toastr.info('Please Select Route & Vehicle Correctly', 'Info:');
                    return false;
                }
            });

            $('#bulk-shift-btn').click(function () {
                var flag = false;
                var route = $('select[name="route_bulk"]').val();
                var vehicle = $('select[name="vehicle_bulk"]').val();
                if (route > 0 && vehicle > 0 ) {
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

                    bootbox.confirm("Are you sure, You Want To "+bulk_action+" Using Bulk Action?<br>Please, Be Sure When You Use Bulk Action. It Effects All The Selected Data.", function(result) {
                        if(result) {
                            $(form).prepend('<input type="hidden" name="bulk_action" value="'+bulk_action+'">')
                            $('#bulk_action_form').submit();
                        }
                    });
                }else{
                    toastr.info('Please Select Route & Vehicle Correctly', 'Info:');
                    return false;
                }
            });

            $('#bulk-active-btn').click(function () {
                var flag = false;
                var route = $('select[name="route_bulk"]').val();
                var vehicle = $('select[name="vehicle_bulk"]').val();
                if (route > 0 && vehicle > 0 ) {
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

                    bootbox.confirm("Are you sure, You Want To "+bulk_action+" Using Bulk Action?<br>Please, Be Sure When You Use Bulk Action. It Effects All The Selected Data.", function(result) {
                        if(result) {
                            $(form).prepend('<input type="hidden" name="bulk_action" value="'+bulk_action+'">')
                            $('#bulk_action_form').submit();
                        }
                    });
                }else{
                    toastr.info('Please Select Route & Vehicle Correctly', 'Info:');
                    return false;
                }
            });


        });


        function loadAllVehicles($this) {
            $.ajax({
                type: 'POST',
                url: '{{ route('transport.find-vehicles') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    route_id: $this.value
                },
                success: function (response) {
                    var data = $.parseJSON(response);
                    if (data.error) {
                        $.notify(data.message, "warning");
                    } else {
                        $('.vehicle_select').html('').append('<option value="0">Select Vehicle...</option>');
                        $.each(data.vehicles, function(key,valueObj){
                            $('.vehicle_select').append('<option value="'+valueObj.id+'">'+valueObj.number+' | '+valueObj.type+'</option>');
                        });
                    }
                }
            });

        }


        function loadVehicle($this) {
            $.ajax({
                type: 'POST',
                url: '{{ route('transport.find-vehicles') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    route_id: $this.value
                },
                success: function (response) {
                    var data = $.parseJSON(response);
                    if (data.error) {
                        $.notify(data.message, "warning");
                    } else {
                        $('.vehicle_select').html('').append('<option value="0">Select Vehicle...</option>');
                        $.each(data.vehicles, function(key,valueObj){
                            $('.vehicle_select').append('<option value="'+valueObj.id+'">'+valueObj.number+' | '+valueObj.type+'</option>');
                        });
                    }
                }
            });

        }

    </script>
    <script type="text/javascript">
        jQuery(function($) {
            $(".user-confirm").on('click', function() {
                var $this = $(this);
                bootbox.confirm({
                        title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon fa fa-exclamation-triangle red'></i> Leave Confirmation</h4></div>",
                        message: "<div class='ui-dialog-content ui-widget-content' style='width: auto; min-height: 30px; max-height: none; height: auto;'><div class='alert alert-info bigger-110'>" +
                        "This Transport User Leave When You Click on Yes Leave Now.<br>Don't Be Afraid, You Will Able To ReActive in Future</div>" +
                        "<p class='bigger-110 bolder center grey'><i class='ace-icon fa fa-hand-o-right blue bigger-120'></i>Are you sure?</p>",
                        size: 'small',
                        buttons: {
                            confirm: {
                                label : "<i class='ace-icon fa fa-history'></i> Yes, Leave Now!",
                                className: "btn-danger btn-sm",
                            },
                            cancel: {
                                label: "<i class='ace-icon fa fa-remove'></i> Cancel",
                                className: "btn-primary btn-sm",
                            }
                        },
                        callback: function(result) {
                            if(result) {
                                location.href = $this.attr('href');
                            }
                        }
                    }
                );
                return false;
            });
        })
    </script>

    @include($view_path.'.includes.modal_values_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')
@endsection