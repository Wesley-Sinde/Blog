@extends('layouts.master')

@section('css')

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
                            {{ $panel }} Detail
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('product.includes.buttons')
                    @include('includes.flash_messages')
                    @include('includes.validation_error_messages')

                    @if (isset($data['row']) && $data['row']->count() > 0)
                        @include($view_path.'.edit')
                    @else
                        @include($view_path.'.add')
                    @endif

                    <div class="col-md-7 col-xs-12">
                        @include($view_path.'.includes.table')
                    </div>
                </div><!-- /.row -->

            </div><!-- /.page-content -->
    </div><!-- /.main-content -->



@endsection

@section('js')
    <!-- page specific plugin scripts -->
    <script>
        $(document).ready(function () {
            /*Change Field Value on Capital Letter When Keyup*/
            $(function() {
                $('.upper').keyup(function() {
                    this.value = this.value.toUpperCase();
                });
            });
            /*end capital function*/


            $('#load-cat-html').click(function () {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('product.category.subCat-html') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    error:function (xhr, status, error) {
                        toastr.warning(error, "warning");
                    },
                    success: function (response) {
                        var data = $.parseJSON(response);
                        if (data.error) {
                            toastr.warning(error, "warning");
                        } else {
                            $('#grade_wrapper').append(data.html);
                        }
                    }
                });

            });
        });
    </script>

    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.table_tr_sort')
@endsection