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
                    @include('hostel.includes.buttons')
                    <div class="col-xs-12 ">
                     @include($view_path.'.includes.buttons')
                        <hr class="hr-6">
                        @include('includes.flash_messages')
                        @include('includes.validation_error_messages')

                        @include($view_path.'.includes.search_form')

                        <!-- PAGE CONTENT BEGINS -->
                        @include($view_path.'.includes.table')
                        @include($view_path.'.includes.renew_model')
                        @include($view_path.'.includes.shift_model')
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
                var user_type = $('select[name="user_type"]').val();
                var reg_no = $('input[name="reg_no"]').val();
                var status = $('select[name="status"]').val();
                var hostel = $('select[name="hostel"]').val();
                var room = $('select[name="room_select"]').val();
                var bed = $('select[name="bed_select"]').val();

                if (reg_no !== '') {
                    url += '?reg_no=' + reg_no;
                    flag = true;
                }


                if (user_type > 0) {
                    if (flag) {
                        url += '&user_type=' + user_type;
                    } else {
                        url += '?user_type=' + user_type;
                        flag = true;
                    }
                }else{
                    toastr.warning('Please Select user Type', 'Warning:');
                    return false;
                }

                if (status !== ''  && status > 0) {
                    if (flag) {
                        url += '&status=' + status;
                    } else {
                        url += '?status=' + status;
                        flag = true;
                    }
                }

                if (hostel !== ''  && hostel > 0) {
                    if (flag) {
                        url += '&hostel=' + hostel;
                    } else {
                        url += '?hostel=' + hostel;
                        flag = true;
                    }
                }

                if (room !== ''  && room > 0) {
                    if (flag) {
                        url += '&room=' + room;
                    } else {
                        url += '?room=' + room;
                        flag = true;
                    }
                }


                if (bed !== ''  && bed > 0) {
                    if (flag) {
                        url += '&bed=' + bed;
                    } else {
                        url += '?bed=' + bed;
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

            $('#shift-btn').click(function () {
                var flag = false;
                var hostel = $('select[name="hostel_bulk"]').val();
                if (hostel > 0 ) {
                    return true;
                }else{
                    toastr.info('Please Select Hostel', 'Info:');
                    return false;
                }
            });

        });

        function loadAllRooms($this) {
            $.ajax({
                type: 'POST',
                url: '{{ route('hostel.resident.find-rooms') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    hostel_id: $this.value
                },
                success: function (response) {
                    var data = $.parseJSON(response);
                    if (data.error) {
                        $.notify(data.message, "warning");
                    } else {
                        $('.room_select').html('').append('<option value="0">Select Room...</option>');
                        $.each(data.rooms, function(key,valueObj){
                            $('.room_select').append('<option value="'+valueObj.id+'">'+valueObj.room_number+'</option>');
                        });
                    }
                }
            });

        }

        function loadAllBeds($this) {
            $.ajax({
                type: 'POST',
                url: '{{ route('hostel.resident.find-beds') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    room_id: $this.value
                },
                success: function (response) {
                    var data = $.parseJSON(response);
                    if (data.error) {
                        $.notify(data.message, "warning");
                    } else {
                        $('.bed_select').html('').append('<option value="0">Select Beds...</option>');
                        $.each(data.beds, function(key,valueObj){
                            $('.bed_select').append('<option value="'+valueObj.id+'">'+valueObj.bed_number+'</option>');
                        });
                    }
                }
            });

        }

        function loadRooms($this) {
            $.ajax({
                type: 'POST',
                url: '{{ route('hostel.find-rooms') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    hostel_id: $this.value
                },
                success: function (response) {
                    var data = $.parseJSON(response);
                    if (data.error) {
                        $.notify(data.message, "warning");
                    } else {
                        $('.room_select').html('').append('<option value="0">Select Room...</option>');
                        $.each(data.rooms, function(key,valueObj){
                            $('.room_select').append('<option value="'+valueObj.id+'">'+valueObj.room_number+'</option>');
                        });
                    }
                }
            });

        }

        function loadBeds($this) {
            $.ajax({
                type: 'POST',
                url: '{{ route('hostel.find-beds') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    room_id: $this.value
                },
                success: function (response) {
                    var data = $.parseJSON(response);
                    if (data.error) {
                        $.notify(data.message, "warning");
                    } else {
                        $('.bed_select').html('').append('<option value="0">Select Beds...</option>');
                        $.each(data.beds, function(key,valueObj){
                            $('.bed_select').append('<option value="'+valueObj.id+'">'+valueObj.bed_number+'</option>');
                        });
                    }
                }
            });

        }
    </script>
    <script type="text/javascript">
        jQuery(function($) {
            $(".resident-confirm").on('click', function() {
                var $this = $(this);
                bootbox.confirm({
                        title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon fa fa-exclamation-triangle red'></i> Leave Confirmation</h4></div>",
                        message: "<div class='ui-dialog-content ui-widget-content' style='width: auto; min-height: 30px; max-height: none; height: auto;'><div class='alert alert-info bigger-110'>" +
                        "This Resident Leave When You Click on Yes Leave Now.<br>Don't Be Afraid, You Will Able To ReActive in Future</div>" +
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