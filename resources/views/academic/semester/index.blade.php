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
            /*end capital function*/

            $('select[name="subject_id"]').select2({
                placeholder: 'Search Course...',
                ajax: {
                    url: '{{ route('subject-name-autocomplete') }}',
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

                var subject_id = $('select[name="subject_id"]').val();
                if (!subject_id)
                    toastr.warning("Please, Choose Subject.", "Warning");
                else {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('semester.subject-html') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: subject_id
                        },
                        success: function (response) {
                            var data = $.parseJSON(response);
                            if (data.error) {
                                toastr.warning(data.message, "warning");
                            } else {

                                $('#subject_wrapper').append(data.html);
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