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
                            Add
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('attendance.includes.buttons')
                    <div class="col-xs-12 ">
                        @include('attendance.master.includes.buttons')
                        @include('includes.flash_messages')
                        @if (isset($data['row']) && $data['row']->count() > 0)
                            @include($base_route.'.includes.edit')
                        @else
                        <!-- PAGE CONTENT BEGINS -->
                            <div class="form-horizontal">
                                <div class="hr hr-18 dotted hr-double"></div>
                            </div>
                            @include($base_route.'.includes.add')
                        @endif
                    </div><!-- /.col -->
                </div><!-- /.row -->

            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    @include('includes.scripts.jquery_validation_scripts')
    @include('includes.scripts.table_tr_sort')
    <script src="{{ asset('assets/js/notify.min.js') }}"></script>
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

            $('#month-tr-html').click(function () {

                var year = $('select[name="year"]').val();
                if (year == 0)
                    toastr.warning("Please, Choose Your Target Year.", "warning");
                else {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('attendance.master.month-html') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function (response) {
                            var data = $.parseJSON(response);

                            if (data.error) {
                                //$.notify(data.message, "warning");
                            } else {
                                $('#month_wrapper').empty();
                                $('#month_wrapper').append(data.html);
                                $(document).find('option[value="0"]').attr("value", "");
                            }
                        }
                    });
                }

            });

        });


    </script>

@endsection