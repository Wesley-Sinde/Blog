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
                    @include('transport.includes.buttons')
                    @include('includes.flash_messages')
                    @include('includes.validation_error_messages')
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
        </div>
    </div><!-- /.main-content -->



@endsection

@section('js')
    <!-- page specific plugin scripts -->
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            /*Change Field Value on Capital Letter When Keyup*/
            $(function() {
                $('.upper').keyup(function() {
                    this.value = this.value.toUpperCase();
                });
            });


            $('select[name="find_staffs"]').select2({
                placeholder: 'Select Staffs...',
                ajax: {
                    url: '{{ route('transport.staff-autocomplete') }}',
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
                //$chkIds = document.getElementsByName('food_items_id[]');
                var staff_id = $('select[name="find_staffs"]').val();

                if (!staff_id)
                    toastr.warning("Please, Choose Staff.", "Warning");
                else {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('transport.vehicle.staff-html') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: staff_id
                        },
                        success: function (response) {
                            var data = $.parseJSON(response);
                            if (data.error) {
                                toastr.warning(data.message, "warning");
                            } else {
                                $('#staff_wrapper').append(data.html);
                                //toastr.success(data.message, "success");
                            }
                        }
                    });
                }
            });

        });
    </script>
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')
@endsection