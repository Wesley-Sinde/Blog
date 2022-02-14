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
                            Books Edit
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                <div class="col-md-12 col-xs-12">
                @include('setting.includes.buttons')
                @include('includes.flash_messages')
                <!-- PAGE CONTENT BEGINS -->
                    {!! Form::model($data['row'], ['route' => [$base_route.'.update', $data['row']->id], 'method' => 'POST', 'class' => 'form-horizontal',
                                    'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
                    {!! Form::hidden('id', $data['row']->id) !!}
                    @include($view_path.'.includes.form')
                    <div class="clearfix form-actions">
                        <div class="col-md-12 align-right">
                            <button class="btn" type="reset">
                                <i class="fa fa-undo bigger-110"></i>
                                Reset
                            </button>
                            <button class="btn btn-info" type="submit" id="filter-btn">
                                <i class="fa fa-save bigger-110"></i>
                                Save
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                    <div class="hr hr-18 dotted hr-double"></div>
                </div><!-- /.col -->

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
        });

        function onToggle() {
            // check if checkbox is checked
            if (document.querySelector('#status-button').checked) {
                // if checked
                console.log('checked');
                $status = 'active';

            } else {
                // if unchecked
                console.log('unchecked');
                $status = 'in-active';
            }

            $id = $('input[name="id"]').val();

            $.ajax({
                type: 'POST',
                url: '{{ route('setting.email.change-status') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: $id,
                    status: $status
                },
                success: function (response) {
                    var data = $.parseJSON(response);

                    if (data.error) {
                        toastr.success('Setting Save');
                    } else {
                        toastr.success('Setting Save');
                    }
                }
            });
        }

    </script>
@endsection