@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />
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
                    <hr class="hr-4">
                    @include('hostel.food.includes.buttons')

                    @include('includes.flash_messages')
                    @if (isset($data['row']) && $data['row']->count() > 0)
                        @include($view_path.'.edit')
                    @else
                        @include($view_path.'.add')
                    @endif
                    <div class="col-md-8 col-xs-12">
                        @include($view_path.'.includes.table')
                    </div>
                </div><!-- /.row -->
            </div><!-- /.page-content -->
    </div><!-- /.main-content -->



@endsection

@section('js')
    <!-- page specific plugin scripts -->
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function () {

            $('select[name="food_items"]').select2({
                placeholder: 'Select Food...',
                ajax: {
                    url: '{{ route('hostel.food-name-autocomplete') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data
                        };

                    },
                    cache: true
                }

            });

            $('#load-html-btn').click(function () {
                var food_item = $('select[name="food_items"]').val();

                if (!food_item)
                    toastr.warning("Please, Choose Food Item First.", "Warning");
                else {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('hostel.food.food-html') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: food_item
                        },
                        success: function (response) {
                            var data = $.parseJSON(response);
                            if (data.error) {
                                toastr.warning(data.message, "warning");
                            } else {
                                $('#food_wrapper').append(data.html);
                                //toastr.success(data.message, "success");
                            }
                        }
                    });
                }
            });

            $('.schedule-btn').click(function () {
                var flag = false;
                var hostels_id = $('select[name="hostels_id"]').val();
                var days_id = $('select[name="days_id"]').val();
                var eating_times_id = $('select[name="eating_times_id"]').val();
                var eating_times_id = $('select[name="eating_times_id"]').val();

                if(hostels_id > 0){
                    flag =  true;
                }else{
                    toastr.info("Please, Choose Schedule Hostel","Info:");
                    return false;
                }

                if(days_id > 0){
                    flag =  true;
                }else{
                    toastr.info("Please, Choose Schedule Day","Info:");
                    return false;
                }

                if(eating_times_id > 0){
                    flag =  true;
                }else{
                    toastr.info("Please, Choose Eating Time","Info:");
                    return false;
                }

                if(flag =  true){
                    return true;
                }else{
                    return false;
                }

            });


        });
    </script>
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')
@endsection