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
                    @include('transport.includes.buttons')
                    <div class="col-xs-12 ">
                     @include($view_path.'.includes.buttons')
                        <hr class="hr-6">
                        @include('includes.flash_messages')
                        <div class="form-horizontal">
                        {!! Form::open(['route' => $base_route.'.history', 'method' => 'GET', 'class' => 'form-horizontal',
                'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
                        @include($view_path.'.history.includes.form')
                        {!! Form::close() !!}
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
                var year = $('select[name="year"]').val();
                var history_type = $('select[name="history_type"]').val();
                var route = $('select[name="route"]').val();
                var vehicle = $('select[name="vehicle_select"]').val();
                var status = $('select[name="status"]').val();
                /*alert(history_type + "ok");
                return false;*/

                if (user_type !== '' & user_type >0) {
                    flag = true;
                }

                if (reg_no !== '') {
                    flag = true;
                }

                if (year !== '' && year > 0 ) {
                    flag = true;
                }

                if (history_type !== 0) {
                    flag = true;
                }

                if (route !== '' && route > 0 ) {
                    flag = true;
                }

                if (vehicle !== '' && vehicle > 0 ) {
                    flag = true;
                }


                if (status !== '' && status > 0 ) {
                    flag = true;
                }

                if(flag){
                    return true;
                }else{
                    toastr.warning('No any Target to Search', 'Warning:');
                    return false;
                }
            });

        });

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

    @include('includes.scripts.dataTable_scripts')

@endsection