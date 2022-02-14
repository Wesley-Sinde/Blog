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
                            Edit
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                <div class="col-md-12 col-xs-12">
                    @include('certificate.includes.buttons')
                    @include($view_path.'.includes.buttons')
                @include('includes.validation_error_messages')
                    <div class="space-8"></div>
                <!-- PAGE CONTENT BEGINS -->
                    {!! Form::model($data['row'], ['route' => [$base_route.'.update', $data['row']->certificate_id], 'method' => 'POST', 'class' => 'form-horizontal',
                                    'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
                    {!! Form::hidden('id', $data['row']->certificate_id) !!}
                    @include($view_path.'.includes.form')
                    <div class="clearfix form-actions">
                        <div class="col-md-12 align-right">
                            {{--<button class="btn" type="reset">
                                <i class="fa fa-undo bigger-110"></i>
                                Reset
                            </button>--}}
                            <button class="btn btn-info" type="submit" id="filter-btn">
                                <i class="fa fa-save bigger-110"></i>
                                Update
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
    @include('includes.scripts.inputMask_script')
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


    </script>
@endsection