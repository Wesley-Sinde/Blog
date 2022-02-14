@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
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
                            History
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('hostel.includes.buttons')
                    <div class="col-xs-12 ">
                     @include($view_path.'.includes.buttons')
                        <hr class="hr-6">
                        @include('includes.flash_messages')
                        <div class="form-horizontal">
                        @include($view_path.'.history.includes.form')
                        <!-- PAGE CONTENT BEGINS -->
                            @include($view_path.'.history.includes.table')
                        </div>
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

                if (status > 0) {
                    if (flag) {
                        url += '&status=' + status;
                    } else {
                        url += '?status=' + status;
                        flag = true;
                    }
                }

                if (hostel > 0) {
                    if (flag) {
                        url += '&hostel=' + hostel;
                    } else {
                        url += '?hostel=' + hostel;
                        flag = true;
                    }
                }

                if (room > 0) {
                    if (flag) {
                        url += '&room=' + room;
                    } else {
                        url += '?room=' + room;
                        flag = true;
                    }
                }


                if (bed > 0) {
                    if (flag) {
                        url += '&bed=' + bed;
                    } else {
                        url += '?bed=' + bed;
                        flag = true;
                    }
                }

                var year = $('select[name="year"]').val();
                var history_type = $('select[name="history_type"]').val();


                if (year > 0) {
                    if (flag) {
                        url += '&year=' + year;
                    } else {
                        url += '?year=' + year;
                        flag = true;
                    }
                }

                if (history_type !=="" && history_type !== '0') {
                    if (flag) {
                        url += '&history_type=' + history_type;
                    } else {
                        url += '?history_type=' + history_type;
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
    </script>


    @include('includes.scripts.dataTable_scripts')

@endsection